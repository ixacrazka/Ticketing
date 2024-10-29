<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelapor;
use App\Models\Instansi;
use App\Models\Jenis;
use App\Models\Pengaduan;
use App\Models\Status;
use Illuminate\Support\Str;

class PelaporController extends Controller
{
    public function pelapor()
    {
        $pelapors = Pelapor::with('instansi')->get();
        $instansis = Instansi::all();
        return view('pelapor',compact('pelapors'));
    }

    public function index()
    {
        $pelapors = Pelapor::with('instansi', 'pengaduan')->get();
        $statues = Status::all();
        return view('dashboard', compact('pelapors','statues'));
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
    public function updateStatus(Request $request, $id)
{
    $pelapor = Pelapor::findOrFail($id);
    $pengaduan = $pelapor->pengaduan;

    if ($pengaduan) {
        $pengaduan->status_id = $request->input('status');
        $pengaduan->save();
    }

    return redirect()->route('dashboard')->with('success', 'Status berhasil diubah');
}
    }
