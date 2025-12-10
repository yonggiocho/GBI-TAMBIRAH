<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renungan extends Model
{
    protected $fillable = ['judul','slug','kategori','isi','penulis','status', 'gambar'];
}
