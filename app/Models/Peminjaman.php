<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected  = [
        'id_user',
        'id_fasilitas',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status_approval',
        'status_pengembalian',
        'keterangan',
    ];

    public  = true;

    public function user()
    {
        return ->belongsTo(User::class, 'id_user');
    }

    public function fasilitas()
    {
        return ->belongsTo(Fasilitas::class, 'id_fasilitas');
    }
}
