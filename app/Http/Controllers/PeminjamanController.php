<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Fasilitas;
use App\Models\User;

class PeminjamanController extends Controller
{
    public function index(Request \)
    {
        \->validate([
            'role' => 'required|string|in:warga,admin,petugas',
            'id_user' => 'required|integer',
        ]);

        \ = Peminjaman::with(['user', 'fasilitas'])
            ->where('id_user', \->id_user)
            ->get()
            ->map(function (\) {
                return [
                    'id' => \->id,
                    'fasilitas' => \->fasilitas ? \->fasilitas->nama_fasilitas : 'Tidak diketahui',
                    'peminjam' => \->user ? \->user->nama_lengkap : 'Tidak diketahui',
                    'status_approval' => \->status_approval,
                    'status_pengembalian' => \->status_pengembalian,
                    'tanggal_pinjam' => \->tanggal_pinjam,
                    'tanggal_kembali' => \->tanggal_kembali,
                    'keterangan' => \->keterangan,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Data peminjaman ditemukan',
            'data' => \
        ]);
    }

    public function store(Request \)
    {
        \->validate([
            'id_user' => 'required|integer|exists:users,id',
            'id_fasilitas' => 'required|integer|exists:fasilitas,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'keterangan' => 'nullable|string',
        ]);

        \ = Peminjaman::create([
            'id_user' => \->id_user,
            'id_fasilitas' => \->id_fasilitas,
            'tanggal_pinjam' => \->tanggal_pinjam,
            'tanggal_kembali' => \->tanggal_kembali,
            'status_approval' => 'Menunggu Persetujuan',
            'status_pengembalian' => 'Belum',
            'keterangan' => \->keterangan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil ditambahkan',
            'data' => \
        ], 201);
    }

    public function approve(\)
    {
        \ = Peminjaman::find(\);
        if (!\) {
            return response()->json(['success' => false, 'message' => 'Peminjaman tidak ditemukan'], 404);
        }

        \->update(['status_approval' => 'Disetujui']);

        return response()->json([
            'success' => true,
            'message' => 'Status peminjaman disetujui',
            'data' => \
        ]);
    }

    public function reject(\)
    {
        \ = Peminjaman::find(\);
        if (!\) {
            return response()->json(['success' => false, 'message' => 'Peminjaman tidak ditemukan'], 404);
        }

        \->update(['status_approval' => 'Ditolak']);

        return response()->json([
            'success' => true,
            'message' => 'Status peminjaman ditolak',
            'data' => \
        ]);
    }

    public function kembalikan(\)
    {
        \ = Peminjaman::find(\);
        if (!\) {
            return response()->json(['success' => false, 'message' => 'Peminjaman tidak ditemukan'], 404);
        }

        \->update(['status_pengembalian' => 'Sudah']);

        return response()->json([
            'success' => true,
            'message' => 'Status pengembalian diupdate menjadi Sudah',
            'data' => \
        ]);
    }
}
