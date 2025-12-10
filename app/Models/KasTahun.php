<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KasBulan;

class KasTahun extends Model
{
    protected $table = 'kas_tahun';
    protected $fillable = ['tahun','status'];

    public function kasBulan()
    {
        return $this->hasMany(KasBulan::class, 'tahun_id');
    }
}
