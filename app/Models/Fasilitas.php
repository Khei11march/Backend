<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected  = [
        'nama_fasilitas',
        'stok',
        'deskripsi',
        'foto',
    ];

    public  = true;
}
