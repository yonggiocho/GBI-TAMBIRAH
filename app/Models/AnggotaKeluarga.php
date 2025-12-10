<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jemaat;
use App\Models\Keluarga;

class AnggotaKeluarga extends Model
{

    protected $table = 'anggota_keluarga';
    protected $fillable = [
             'keluarga_id',
             'jemaat_id',
             'hubungan'
    ];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'keluarga_id');
    }

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class, 'jemaat_id');
    }
}
