<?php

namespace App\Http\Controllers;

use App\Models\BasisPengetahuan;
use App\Models\BobotKeyakinan;
use App\Models\Gejala;
use App\Models\KategoriHewan;
use App\Models\Penyakit;
use App\Models\RiwayatDiagnosa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with real statistics from database.
     */
    public function index(): View
    {
        $stats = [
            'totalKategori' => KategoriHewan::count(),
            'totalPenyakit' => Penyakit::count(),
            'totalGejala' => Gejala::count(),
            'totalBasisPengetahuan' => BasisPengetahuan::count(),
            'totalRiwayat' => RiwayatDiagnosa::count(),
            'totalBobotKeyakinan' => BobotKeyakinan::count(),
            'totalUsers' => User::count(),
            'totalPakar' => User::where('role', 'pakar')->count(),
        ];

        $kategoriList = KategoriHewan::withCount(['penyakit', 'gejala'])->get();
        $penyakitList = Penyakit::with('kategori')->withCount('gejala')->latest()->take(6)->get();
        $gejalaList = Gejala::with('kategori')->latest()->take(6)->get();
        $basisPengetahuanList = DB::table('v_basis_pengetahuan')->take(6)->get();
        $recentUsers = User::latest()->take(4)->get();
        $recentRiwayat = RiwayatDiagnosa::with(['kategori', 'penyakitTerpilih', 'user'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'kategoriList',
            'penyakitList',
            'gejalaList',
            'basisPengetahuanList',
            'recentUsers',
            'recentRiwayat'
        ));
    }
}
