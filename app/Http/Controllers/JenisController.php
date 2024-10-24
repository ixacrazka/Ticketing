<?php
namespace App\Http\Controllers;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    // MENAMPILKAN DATA YANG SUDAH ADA DI DATABASE
    public function index()
    {
        $jenis = Jenis::all();
        return view('jenis', compact('jenis'));
    }
    //END SHOW DATA


    // MENAMPILKAN FORM TAMBAH DAN MENAMBAH DATA BARU
    public function create()
    {
        return view('jnsreate');
    }
    public function store(Request $request)
    {
        $request->validate([
            'jenis_pengaduan' => 'required|string|max:255',
        ]);
        Jenis::create([
            'jenis_pengaduan' => $request->input('jenis_pengaduan'),
        ]);
        return redirect()->route('jenis.index')->with('success', 'Jenis pengaduan berhasil ditambahkan!');
    }
    //END TAMBAH DATA



    //MENAMPILKAN FORM EDIT DAN MENGUBAH DATANYA
    public function edit($id)
    {
        $jenis = Jenis::findOrFail($id);
        return view('edit', compact('jenis'));
    }
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'jenis_pengaduan' => 'required|string|max:255',
        // ]);
        $jenis = Jenis::findOrFail($id);
        // Update data
        $jenis->update([
            'jenis_pengaduan' => $request->jenis_pengaduan,
        ]);
        return redirect()->route('jenis.index')->with('success', 'Jenis pengaduan berhasil diupdate!');
    }
    //END UPDATE DATA


    // MENGHAPUS DATA BERDASARKAN ID
    public function destroy($id)
    {
        $jenis = Jenis::findOrFail($id);
        $jenis->delete();
        return redirect()->route('jenis.index')->with('success', 'Jenis pengaduan berhasil dihapus!');
    }
}
    //END DELETE DATA