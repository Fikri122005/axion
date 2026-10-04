<?php

namespace App\Http\Controllers;

use App\Models\KategoriHewan;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PenyakitController extends Controller
{
    /**
     * Display a listing of penyakit.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $kategoriId = $request->query('kategori_id');

        $penyakit = Penyakit::with('kategori')
            ->withCount('gejala')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama_penyakit', 'like', "%{$search}%")
                        ->orWhere('kode_penyakit', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->when($kategoriId, function ($query, $kategoriId) {
                return $query->where('kategori_id', $kategoriId);
            })
            ->orderBy('kode_penyakit')
            ->paginate(10)
            ->withQueryString();

        $kategoriList = KategoriHewan::all();
        $totalPenyakit = Penyakit::count();

        return view('admin.penyakit.index', compact('penyakit', 'kategoriList', 'totalPenyakit', 'search', 'kategoriId'));
    }
}
