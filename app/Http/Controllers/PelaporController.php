<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelapor;
use App\Models\Instansi;
use App\Models\Jenis;
use App\Models\Pengaduan;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;


class PelaporController extends Controller
{
    public function pelapor()
    {
        $pelapors = Pelapor::with('instansi')->get();
        $instansis = Instansi::all();
        return view('pelapor',compact('pelapors'));
    }

    public function aduan()
    {
        $pelapors = Pelapor::with('pengaduan')->get();
        $jenisis = Jenis::all();
        return view('aduan', compact('pelapors','jenisis'));
    }

    public function index()
{
    $pelapors = Pelapor::with('instansi', 'pengaduan')->get();
    $statues = Status::all();

    // Total pelapor count
    $totalPelapor = Pelapor::count();

    // Count of 'pelapor' based on 'status'
    $totalStatusDitolak = Pelapor::whereHas('pengaduan.status', function ($query) {
        $query->where('name', 'Ditolak');
    })->count();

    $totalStatusDikonfirmasi = Pelapor::whereHas('pengaduan.status', function ($query) {
        $query->where('name', 'Dikonfirmasi');
    })->count();

    $totalStatusDiproses = Pelapor::whereHas('pengaduan.status', function ($query) {
        $query->where('name', 'Diproses');
    })->count();

    $totalStatusSelesai = Pelapor::whereHas('pengaduan.status', function ($query) {
        $query->where('name', 'Selesai');
    })->count();

    $totalStatusMenungguKonfirmasi = Pelapor::whereHas('pengaduan.status', function ($query) {
        $query->where('name', 'Menunggu Konfirmasi');
    })->count();

    return view('dashboard', compact(
        'pelapors',
        'statues',
        'totalPelapor',
        'totalStatusDitolak',
        'totalStatusDikonfirmasi',
        'totalStatusDiproses',
        'totalStatusSelesai',
        'totalStatusMenungguKonfirmasi'
    ));
}



    public function rekaplaporan()
    {
        $pelapors = Pelapor::with('instansi', 'pengaduan', 'user')->get();
        $statues = Status::all();
        $users = User::all();
        return view('rekaplaporan', compact('pelapors','statues','users'));
    }


    // FNCT:FUNGSI UNTUK HALAMAN TAMBAH
    public function create()
    {
        $instansis = Instansi::get();
        // dd($instansis[0]->kode);
        $kode = 'nilai_default';
        $countInstansi = Instansi::where('kode', $kode)->count();
        $jenis = Jenis::all();
        return view('tambah', compact('instansis', 'jenis', 'countInstansi'));
    }


    // FNCT:FUNGSI UNTUK HALAMAN ADUAN LAPORAN YANG BERFUNGSIN UNTUK STORE LAPORAN DAN LOGIKANYA ADALAH MENAMBAH KE TABLE PENGADUAN DAN PELAPOR DALAM 1 CONTROLLER SAJA
    public function store(Request $request)
            {
                // Validate inputs, allowing `file_foto` to be an image or a PDF
                $request->validate([
                    'file_foto' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048',
                    'npelapor' => 'required|string|max:100',
                    'email' => 'required|email',
                    'nohp' => 'required|string|max:15',
                    'naplikasi' => 'required|string|max:100',
                    'laporan' => 'required|string|max:200',
                    'keterangan' => 'nullable|string',
                    // Foreign keys can be nullable if not required
                    'instansi_id' => 'nullable|exists:instansi,kode',
                    'jenis_id' => 'nullable|exists:jenis,id',
                ]);

                $attr1 = [
                    'npelapor' => $request->npelapor,
                    'email' => $request->email,
                    'nohp' => $request->nohp,
                    'instansi_id' => $request->instansi_id,
                ];

                $savePelapor = Pelapor::create($attr1);

                // Generate queue code (Kode Antrian)
                $hitungPengaduan = Pengaduan::count() + 1;
                $kodePengaduan = 'KDE-' . str_pad($hitungPengaduan, 3, '0', STR_PAD_LEFT);

                // Upload file to /uploads/file_foto
                if ($request->hasFile('file_foto')) {
                    $file = $request->file('file_foto');
                    $ext = $file->getClientOriginalExtension();
                    $newName = date('dmY') . Str::random(10) . '.' . $ext;
                    $file->move('uploads/file_foto', $newName);
                    $filename = $newName;
                }

                // Insert data into Pengaduan table
                $attr2 = [
                    'pelapor_id' => $savePelapor->id,
                    'naplikasi' => $request->naplikasi,
                    'laporan' => $request->laporan,
                    'jenis_id' => $request->jenis_id,
                    'status_id' => 5,
                    'file_foto' => $filename ?? '',
                    'kode' => $kodePengaduan,
                    'keterangan' => $request->keterangan,
                ];

                $savePengaduan = Pengaduan::create($attr2);

                // Pass the generated code to the view
                return view('kodeantrian', ['kode' => $kodePengaduan]);
            }


    //FNCT:FUNGSI UNTUK HALAMAN DASHBOARD UNTUK MENGHAPUS TABEL PADA DASHBOARD
    public function destroy($id)
    {
        $pelapor = Pelapor::findOrFail($id);

        $pelapor->pengaduan()->delete();
        $pelapor->delete();

        return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus');
    }

    // FNCT:FUNGSI UNTUK HALAMAN DASHBOARD BERFUNGSI UNTUK MENGUBAH STATUS DAN KETERANGAN DAN MENAMPILKAN KE HALAMAN CEKSTS
    public function updateStatusAndKeterangan(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'keterangan' => 'required|string|max:255',
    ]);

    // Find the pelapor by ID
    $pelapor = Pelapor::findOrFail($id);
    $pengaduan = $pelapor->pengaduan;

    // Check if the pengaduan exists
    if ($pengaduan) {
        // Update the status and keterangan
        $pengaduan->status_id = $request->input('status');
        $pengaduan->keterangan = $request->input('keterangan');
        $pengaduan->save(); // Save the updated status and keterangan
    }

    // Redirect back to the dashboard with a success message
    return redirect()->route('dashboard')->with('success', 'Status dan keterangan berhasil diubah');
}



// FNCT:FUNGSI UNTUK HALAMAN CEKSTS YANG BERFUNGSI UNTUK MENGAMBIL KODE  PADA TABLE PENGADUAN LALU MENAMPILKAN DATA YANG ADA DI TABLE PENGADUAN
    public function halamanStatusAntrian()
    {
        return view('ceksts');
    }
    public function cekStatus(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
        ]);

        $pengaduan = Pengaduan::where('kode', $request->kode)->with('pelapor', 'status')->first();

        if (!$pengaduan) {
            return redirect()->back()->with('error', 'Kode antrian tidak ditemukan.');
        }

        $pelapors = $pengaduan->pelapor()->with('pengaduan.status')->get();

        return view('ceksts', [
            'pengaduan' => $pengaduan,
            'pelapors' => $pelapors,
        ]);
    }

    // FNCT: FUNGSI UNTUK HALAMAN REKAPLAPORAN YANG BERFUNGSI UNTUK MEMFILTER DATA PADA TABLE PER TANGGAL UNTUK DI EXPORT KE PDF
    public function filter(Request $request)
    {
        $query = Pelapor::with('pengaduan.status');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereHas('pengaduan', function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            });
        }

        $pelapors = $query->get();

        return view('rekaplaporan', compact('pelapors'));
    }


    //FNCT:FUNGSI UNTUK HALAMAN HALAMAN REKAPLAPORAN YANG BERFUNGSI UNTUK MENGRXPORT DATA PADA TABLE KE PDF
    public function exportPdf(Request $request)
    {
        $query = Pelapor::whereHas('pengaduan', function ($q) use ($request) {
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            }
        })->with('pengaduan.status');

        $pelapors = $query->get();

        if ($pelapors->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data ditemukan untuk tanggal tersebut.');
        }

        $pdf = PDF::loadView('rekappdf', compact('pelapors'))->setPaper('a4', 'landscape');
        return $pdf->download('rekaplaporan.pdf');
    }



    // FNCT:FUNGSI UNTUK HALAMAN REKAPHARIAN YANG BERFUNGSI UNTUK MELIHAT JUMLAH STATUS/PERSTATUS PERJENIS PENGADUAN
    public function rekaphari(Request $request)
    {
        $query = Jenis::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('jenis_pengaduan', 'like', '%' . $request->search . '%');
        } else {
            $query->limit(1);
        }

        $jenises = $query->get();
        $statuesJenis = [];

        foreach ($jenises as $jenis) {
            $statuesJenis[$jenis->id] = [
                'jenis_pengaduan' => $jenis->jenis_pengaduan,
                'Dikonfirmasi' => Pelapor::whereHas('pengaduan', function ($q) use ($jenis) {
                    $q->where('jenis_id', $jenis->id)->whereHas('status', function ($q) {
                        $q->where('name', 'Dikonfirmasi');
                    });
                })->count(),
                'Ditolak' => Pelapor::whereHas('pengaduan', function ($q) use ($jenis) {
                    $q->where('jenis_id', $jenis->id)->whereHas('status', function ($q) {
                        $q->where('name', 'Ditolak');
                    });
                })->count(),
                'Diproses' => Pelapor::whereHas('pengaduan', function ($q) use ($jenis) {
                    $q->where('jenis_id', $jenis->id)->whereHas('status', function ($q) {
                        $q->where('name', 'Diproses');
                    });
                })->count(),
                'Menunggu Konfirmasi' => Pelapor::whereHas('pengaduan', function ($q) use ($jenis) {
                    $q->where('jenis_id', $jenis->id)->whereHas('status', function ($q) {
                        $q->where('name', 'Menunggu Konfirmasi');
                    });
                })->count(),
                'Selesai' => Pelapor::whereHas('pengaduan', function ($q) use ($jenis) {
                    $q->where('jenis_id', $jenis->id)->whereHas('status', function ($q) {
                        $q->where('name', 'Selesai');
                    });
                })->count(),
            ];
        }

        return view('rekaphari', [
            'statuesJenis' => $statuesJenis,
        ]);
    }


}
