<?php

namespace App\Http\Controllers;
// use App\Models\Pelapor;
use App\Models\Pengaduan;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::all();
        return view('dashboard', compact('pengaduans'));
    }

    // public function create()
    // {
    //     return view('tambah');
    // }

    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'pelapor_id' => 'required|integer',
    //         'naplikasi' => 'required|string|max:255',
    //         'laporan' => 'required|string',
    //         'status_id' => 'required|integer',
    //         'jenis_id' => 'required|integer',
    //         'file_foto' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'jenis_id' => 'required|integer',
    //     ]);

    //     // Simpan file jika ada
    //     // $filePath = null;
    //     // if ($request->hasFile('file_foto')) {
    //     //     $filePath = $request->file('file_foto')->store('public/storage');
    //     //     $filePath = str_replace('public/storage', '', $filePath);
    //     // }
    //     Pengaduan::create([
    //         'pelapor_id' => $request->pelapor_id,
    //         'naplikasi' => $request->naplikasi,
    //         'laporan' => $request->laporan,
    //         'status_id' => $request->status_id,
    //         'jenis_id' => $request->jenis_id,
    //         'file_foto' => $filename ?? '',
    //         'kode'=>$request->kode,
    //     ]);

    //     return redirect()->route('dashboard')->with('success', 'Data berhasil ditambahkan');
    // }

    // public function destroy($id,$pelapor_id,$jenis_id)
    // {
    //     $pengaduans = Pengaduan::findOrFail($id);
    //     if ($pengaduans->file_foto) {
    //         Storage::delete('public/' . $pengaduans->file_foto);
    //     }
    //     $pengaduans->delete();
    //     return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus');
    // }


}
