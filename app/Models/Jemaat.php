<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Keluarga;

class Jemaat extends Model
{
    protected $table = 'jemaat';
    protected $fillable = [
         'nama',
         'tempat_lahir',
         'tanggal_lahir',
         'email',
         'no_hp',
         'alamat',
         'jenis_kelamin',
         'status_baptis',
         'keterangan'
        ];

     public function kepalaKeluarga()
     {
        return $this->hasOne(Keluarga::class, 'jemaat_id');
     }
}
