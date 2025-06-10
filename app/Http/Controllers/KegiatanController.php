<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::latest()->get();

        return Inertia::render('kegiatan/Index', [
            'kegiatans' => $kegiatans
        ]);
    }

    public function show(kegiatan $kegiatan)
    {
        return Inertia::render('kegiatan/Show', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function create()
    {
        return Inertia::render('kegiatan/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        kegiatan::create($request->only('title', 'content'));

        return redirect()->route('kegiatan.index')->with('success', 'kegiatan berhasil ditambahkan.');
    }

    public function edit(kegiatan $kegiatan)
    {
        return Inertia::render('kegiatan/Edit', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function update(Request $request, kegiatan $kegiatan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        $kegiatan->update($request->only('title', 'content'));

        return redirect()->route('kegiatan.index')->with('success', 'kegiatan berhasil diperbarui.');
    }

    public function destroy(kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'kegiatan berhasil dihapus.');
    }
}
?>