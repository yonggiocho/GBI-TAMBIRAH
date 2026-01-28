<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriRenungan extends Model
{
    protected $table = 'kategori_renungan';
    protected $fillable = [
        'kategori',
        'slug',
        'deskripsi',
        'thumbnail'
    ];
}
