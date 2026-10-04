<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\KategoriHewan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GejalaController extends Controller
{
    /**
     * Display a listing of gejala.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $kategoriId = $request->query('kategori_id');

        $gejala = Gejala::with('kategori')
            ->withCount('penyakit')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama_gejala', 'like', "%{$search}%")
                        ->orWhere('kode_gejala', 'like', "%{$search}%");
                });
            })
            ->when($kategoriId, function ($query, $kategoriId) {
                return $query->where('kategori_id', $kategoriId);
            })
            ->orderBy('kode_gejala')
            ->paginate(10)
            ->withQueryString();

        $kategoriList = KategoriHewan::all();
        $totalGejala = Gejala::count();

        return view('admin.gejala.index', compact('gejala', 'kategoriList', 'totalGejala', 'search', 'kategoriId'));
    }
}
