<?php

namespace App\Http\Controllers;

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
        $laporans = Laporan::all();
        $title = "Beranda";
        $id_laporan = $this->generateLaporanId();
        $categories = Category::all();


        // dd($laporans);
        return view('index', compact('laporans', 'title', 'id_laporan', 'categories'));
    }

    public function store(Request $request)
    {
        $validateData = $this->validate(
            $request,
            [
                'id_laporan' => 'required|string|regex:/^LAPOR_\d{10}_[A-Za-z0-9]{5}$/',
                'kategori'   => 'required|string',
                'laporan'    => 'required|string',
                'detail'     => 'required|string',
                'alamat'     => 'required|string',
                'foto'       => 'image'
            ],
            [
                'id_laporan.regex' => 'ID Laporan tidak valid',
                'kategori.required' => 'Kategori tidak boleh kosong',
                'laporan.required' => 'Judul laporan tidak boleh kosong',
                'detail.required' => 'Detail tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
            ]
        );

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

        if (!$validateData) {
            return redirect('/#form')->with(['gagal' => 'Ada error sikit']);
        }
        
        return redirect('/#form')->with(['success' => 'Laporan berhasil diajukan', 'rIdLaporan' => $request->id_laporan]);
    }

    public function find(Request $request)
    {
        $title = "Pencarian Laporan";
        $query = $request->input('lapor_id');
        // $result = DB::table('laporans')->where('id_laporan', $query)->first();
        $result = Laporan::where('id_laporan', $query)->first();
        // dd($result);

        return view('result', compact('title', 'result'));
    }

    public function gallery()
    {
        $title = "Galeri";
        $photos = Laporan::select('foto')->get();

        return view('gallery', compact('title', 'photos'));
    }
}
