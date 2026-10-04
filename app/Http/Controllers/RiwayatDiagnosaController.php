<?php

namespace App\Http\Controllers;

use App\Models\KategoriHewan;
use App\Models\RiwayatDiagnosa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiwayatDiagnosaController extends Controller
{
    /**
     * Display a listing of riwayat diagnosa.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $kategoriId = $request->query('kategori_id');

        $riwayatList = RiwayatDiagnosa::with(['user', 'kategori', 'penyakitTerpilih', 'hasilDiagnosa.penyakit', 'detailDiagnosa.gejala'])
            ->when($search, function ($query, $search) {
                return $query->where('nama_hewan', 'like', "%{$search}%")
                    ->orWhereHas('penyakitTerpilih', function ($q) use ($search) {
                        $q->where('nama_penyakit', 'like', "%{$search}%");
                    })
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($kategoriId, function ($query, $kategoriId) {
                return $query->where('kategori_id', $kategoriId);
            })
            ->latest('tanggal_diagnosa')
            ->paginate(10)
            ->withQueryString();

        $kategoriList = KategoriHewan::all();
        $totalRiwayat = RiwayatDiagnosa::count();

        return view('admin.riwayat-diagnosa.index', compact('riwayatList', 'kategoriList', 'totalRiwayat', 'search', 'kategoriId'));
    }
}
