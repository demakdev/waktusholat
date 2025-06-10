<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumen = Pengumuman::latest()->get();

        return Inertia::render('pengumuman/Index', [
            'pengumumen' => $pengumumen
        ]);
    }

    public function show(Pengumuman $pengumuman)
    {
        return Inertia::render('pengumuman/Show', [
            'pengumuman' => $pengumuman
        ]);
    }

    public function create()
    {
        return Inertia::render('pengumuman/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        Pengumuman::create($request->only('title', 'content'));

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return Inertia::render('pengumuman/Edit', [
            'pengumuman' => $pengumuman
        ]);
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        $pengumuman->update($request->only('title', 'content'));

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
?>