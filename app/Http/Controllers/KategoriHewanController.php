<?php

namespace App\Http\Controllers;

use App\Models\KategoriHewan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class KategoriHewanController extends Controller
{
    /**
     * Display a listing of kategori hewan.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $kategori = KategoriHewan::withCount(['penyakit', 'gejala', 'riwayatDiagnosa'])
            ->when($search, function ($query, $search) {
                return $query->where('nama_kategori', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalKategori = KategoriHewan::count();

        return view('admin.kategori.index', compact('kategori', 'totalKategori', 'search'));
    }

    /**
     * Store a newly created kategori hewan in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:50', 'unique:kategori_hewan,nama_kategori'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
        ], [
            'nama_kategori.required' => 'Nama kategori hewan wajib diisi.',
            'nama_kategori.max' => 'Nama kategori maksimal 50 karakter.',
            'nama_kategori.unique' => 'Kategori hewan ini sudah terdaftar.',
            'deskripsi.max' => 'Deskripsi maksimal 255 karakter.',
        ]);

        $slug = Str::slug($validated['nama_kategori']);
        $originalSlug = $slug;
        $counter = 1;
        while (KategoriHewan::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        KategoriHewan::create([
            'nama_kategori' => $validated['nama_kategori'],
            'slug' => $slug,
            'deskripsi' => $validated['deskripsi'] ?? null,
        ]);

        return redirect()->route('admin.kategori')
            ->with('success', 'Kategori hewan "'.$validated['nama_kategori'].'" berhasil ditambahkan!');
    }

    /**
     * Update the specified kategori hewan in storage.
     */
    public function update(Request $request, KategoriHewan $kategori): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:50', 'unique:kategori_hewan,nama_kategori,'.$kategori->id],
            'deskripsi' => ['nullable', 'string', 'max:255'],
        ], [
            'nama_kategori.required' => 'Nama kategori hewan wajib diisi.',
            'nama_kategori.max' => 'Nama kategori maksimal 50 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan oleh kategori lain.',
            'deskripsi.max' => 'Deskripsi maksimal 255 karakter.',
        ]);

        $slug = Str::slug($validated['nama_kategori']);
        if ($slug !== $kategori->slug) {
            $originalSlug = $slug;
            $counter = 1;
            while (KategoriHewan::where('slug', $slug)->where('id', '!=', $kategori->id)->exists()) {
                $slug = "{$originalSlug}-{$counter}";
                $counter++;
            }
        }

        $kategori->update([
            'nama_kategori' => $validated['nama_kategori'],
            'slug' => $slug,
            'deskripsi' => $validated['deskripsi'] ?? null,
        ]);

        return redirect()->route('admin.kategori')
            ->with('success', 'Kategori hewan "'.$kategori->nama_kategori.'" berhasil diperbarui!');
    }

    /**
     * Remove the specified kategori hewan from storage.
     */
    public function destroy(KategoriHewan $kategori): RedirectResponse
    {
        $totalPenyakit = $kategori->penyakit()->count();
        $totalGejala = $kategori->gejala()->count();

        if ($totalPenyakit > 0 || $totalGejala > 0) {
            return back()->with('error', 'Kategori "'.$kategori->nama_kategori.'" tidak dapat dihapus karena masih memiliki '.$totalPenyakit.' penyakit dan '.$totalGejala.' gejala terkait.');
        }

        $nama = $kategori->nama_kategori;
        $kategori->delete();

        return redirect()->route('admin.kategori')
            ->with('success', 'Kategori hewan "'.$nama.'" berhasil dihapus.');
    }
}
