<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data fasilitas ditemukan',
            'data' => Fasilitas::all()
        ]);
    }

    public function store(Request \)
    {
        \->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|string|max:255',
        ]);

        \ = Fasilitas::create(\->only(['nama_fasilitas', 'stok', 'deskripsi', 'foto']));

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil ditambahkan',
            'data' => \
        ], 201);
    }

    public function update(Request \, \)
    {
        \ = Fasilitas::find(\);
        if (!\) {
            return response()->json(['success' => false, 'message' => 'Fasilitas tidak ditemukan'], 404);
        }

        \->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|string|max:255',
        ]);

        \->update(\->only(['nama_fasilitas', 'stok', 'deskripsi', 'foto']));

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil diupdate',
            'data' => \
        ]);
    }

    public function destroy(\)
    {
        \ = Fasilitas::find(\);
        if (!\) {
            return response()->json(['success' => false, 'message' => 'Fasilitas tidak ditemukan'], 404);
        }

        \->delete();
        return response()->json(['success' => true, 'message' => 'Fasilitas berhasil dihapus']);
    }
}
