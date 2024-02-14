<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = Laporan::all();
        $title = "Admin";

        return view('admin.index', compact('title', 'laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Laporan::findOrFail($id);

        return redirect()->back()->with(['success' => 'Data ditemukan!', 'result' => $result]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        $title = "Edit ". $laporan->nama_laporan;

        return view('admin.edit', compact('laporan', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $this->validate($request,[
            'status' => 'nullable|string',
            'umpan_balik' => 'nullable|string'
        ]);

        $laporan = Laporan::findOrFail($id);

        $laporan->update([
            'status' => $request->status,
            'umpan_balik' => $request->umpan_balik
        ]);

        return redirect()->back()->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporan = Laporan::findOrFail($id);

        Storage::delete('public/images/'.$laporan->foto);

        $laporan->delete();

        return redirect()->back()->with(['success' => 'Data berhasil dihapus.']);
    }
}
