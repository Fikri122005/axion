<?php

namespace App\Http\Controllers;

use App\Models\BasisPengetahuan;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BasisPengetahuanController extends Controller
{
    /**
     * Display a listing of basis pengetahuan rules.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $penyakitId = $request->query('penyakit_id');

        $rules = BasisPengetahuan::with(['penyakit.kategori', 'gejala'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('penyakit', function ($q) use ($search) {
                    $q->where('nama_penyakit', 'like', "%{$search}%")
                        ->orWhere('kode_penyakit', 'like', "%{$search}%");
                })->orWhereHas('gejala', function ($q) use ($search) {
                    $q->where('nama_gejala', 'like', "%{$search}%")
                        ->orWhere('kode_gejala', 'like', "%{$search}%");
                });
            })
            ->when($penyakitId, function ($query, $penyakitId) {
                return $query->where('penyakit_id', $penyakitId);
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        $penyakitList = Penyakit::with('kategori')->orderBy('kode_penyakit')->get();
        $totalRules = BasisPengetahuan::count();
        $avgCf = (float) (BasisPengetahuan::avg('cf_pakar') ?? 0);

        return view('admin.basis-pengetahuan.index', compact('rules', 'penyakitList', 'totalRules', 'avgCf', 'search', 'penyakitId'));
    }
}
