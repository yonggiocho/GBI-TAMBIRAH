<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KasTahun;
use App\Models\KasTransaksi;

class KasBulan extends Model
{
    protected $table = 'kas_bulan';
    protected $fillable = ['tahun_id', 'bulan','saldo_awal','saldo_akhir','status'];

    public function kasTahun()
    {
        return $this->belongsTo(KasTahun::class, 'tahun_id');
    }

    public function kasTransaksi()
    {
        return $this->hasMany(KasTransaksi::class, 'bulan_id');
    }

    public function berjalan()
    {
        return $this->status === 'berjalan';
    }
}
