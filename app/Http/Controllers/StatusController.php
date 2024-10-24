<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    // Menampilkan semua status
    public function index()
    {
        $status = Status::all();
        return view('status', compact('status'));
    }

    // Menampilkan form untuk membuat status baru
    public function create()
    {
        return view('stscreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Status::create([
            'name' => $request->name,
        ]);

        return redirect()->route('status.index')->with('success', 'Status created successfully!');
    }

    // In StatusController.php

public function edit($id)
{
    $status = Status::findOrFail($id);
    return view('editsts', compact('status'));
}
public function update(Request $request, $id)
{
    // $request->validate([
    //     'status' => 'required|string',
    // ]);
    $status = Status::findOrFail($id);
    $status->update([
        'name' => $request->status,
    ]);

    return redirect()->route('status.index')->with('success', 'Status updated successfully');
}

    // Menghapus status berdasarkan id
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $status->delete();

        return redirect()->route('status.index')->with('success', 'Status deleted successfully!');
    }
}
