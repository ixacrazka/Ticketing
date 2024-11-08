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


    public function create()
    {
        $instansis = Instansi::get();
        // dd($instansis[0]->kode);
        $kode = 'nilai_default';
        $countInstansi = Instansi::where('kode', $kode)->count();
        $jenis = Jenis::all();
        return view('tambah', compact('instansis', 'jenis', 'countInstansi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $attr1 = [
            'npelapor' => $request->npelapor,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'instansi_id' => $request->instansi_id,
        ];


        $savePelapor = Pelapor::create($attr1);

        //GENERATE KODE ANTRIAN
        $hitungPengaduan = Pengaduan::count() + 1;
        $kodePengaduan = 'KDE-' . str_pad($hitungPengaduan, 3, '0', STR_PAD_LEFT);

        //upload foto KE file /uploads DI /storage
        if ($request->hasFile('file_foto')) {
            $file = $request->file('file_foto');
            $ext = $file->getClientOriginalExtension();
            $newName =  date('dmY') . Str::random(10) . '.' . $ext;
            $file->move('uploads/file_foto', $newName);
            $filename = $newName;
        }
        //UNTUK INPUT KE TABEL PENGADUAN
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



    public function destroy($id)
    {
        $pelapor = Pelapor::findOrFail($id);

        $pelapor->pengaduan()->delete();
        $pelapor->delete();

        return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus');
    }

    // Mengubah status
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


    public function halamanStatusAntrian()
    {
        return view('ceksts');
    }
        //untuk cek kode status antrian
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


    public function rekaphari()
{
    $jenises = Jenis::all();

    $statuesJenis = [];

    // Loop untuk setiap jenis
    foreach ($jenises as $jenis) {
        $statuesJenis[$jenis->id] = [
            'jenis_pengaduan' => $jenis->jenis_pengaduan,
            'Dikonfirmasi' => Pelapor::whereHas('pengaduan', function ($query) use ($jenis) {
                $query->where('jenis_id', $jenis->id)->whereHas('status', function ($q) {
                    $q->where('name', 'Dikonfirmasi');
                });
            })->count(),
            'Ditolak' => Pelapor::whereHas('pengaduan', function ($query) use ($jenis) {
                $query->where('jenis_id', $jenis->id)->whereHas('status', function ($q) {
                    $q->where('name', 'Ditolak');
                });
            })->count(),
            'Diproses' => Pelapor::whereHas('pengaduan', function ($query) use ($jenis) {
                $query->where('jenis_id', $jenis->id)->whereHas('status', function ($q) {
                    $q->where('name', 'Diproses');
                });
            })->count(),
            'Menunggu Konfirmasi' => Pelapor::whereHas('pengaduan', function ($query) use ($jenis) {
                $query->where('jenis_id', $jenis->id)->whereHas('status', function ($q) {
                    $q->where('name', 'Menunggu Konfirmasi');
                });
            })->count(),
            'Selesai' => Pelapor::whereHas('pengaduan', function ($query) use ($jenis) {
                $query->where('jenis_id', $jenis->id)->whereHas('status', function ($q) {
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
