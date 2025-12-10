<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    protected $table = 'identitas';
    protected $fillable = [
        'nama_website',
        'logo',
        'favicon',
        'alamat',
        'telepon',
        'email',
        'facebook',
        'instagram',
        'youtube',
        'map'
    ];
}
