<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


use App\Models\Category;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    private function generateLaporanId()
    {
        return 'LAPOR_' . now()->timestamp . '_' . Str::random(5);
    }
    public function index()
    {
        $laporans = Laporan::latest()->take(5)->get();
        $title = "Beranda";
        $id_laporan = $this->generateLaporanId();
        $categories = Category::all();


        // dd($laporans);
        return view('index', compact('laporans', 'title', 'id_laporan', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_laporan' => 'required|string',
            'kategori'   => 'required|string',
            'laporan'    => 'required|string',
            'detail'     => 'required|string',
            'alamat'     => 'required|string',
            'foto'       => 'image'
        ]);

        $image = $request->file('foto');
        $imageName = $image->hashName();
        $image->storeAs('public/images', $imageName);

        Laporan::create([
            'id_laporan' => $request->id_laporan,
            'category_id' => $request->kategori,
            'nama_laporan' => $request->laporan,
            'detail' => $request->detail,
            'alamat' => $request->alamat,
            'foto' => $imageName
        ]);

        return redirect()->route('index')->with(['success' => 'Laporan berhasil diajukan']);
    }

    public function find(Request $request)
    {
        $title = "Pencarian Laporan";
        $query = $request->input('lapor_id');
        // $result = DB::table('laporans')->where('id_laporan', $query)->first();
        $result = Laporan::where('id_laporan', $query)->first();
        // dd($result);

        return view('result', compact('result', 'title'));
    }
}
