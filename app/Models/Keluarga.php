<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jemaat;
use App\Models\AnggotaKeluarga;

class Keluarga extends Model
{
    protected $table = 'keluarga';
    protected $fillable = [
        'kepala_keluarga',
        'jemaat_id'
    ];

    public function jemaatKeluarga()
    {
        return $this->belongsTo(Jemaat::class,'jemaat_id')->withDefault([
            'nama' => 'Data sudah dihapus'
        ]);
    }

    public function anggota()
    {
        return $this->hasMany(AnggotaKeluarga::class,'keluarga_id');
    }
}
