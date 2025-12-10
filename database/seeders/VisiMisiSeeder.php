<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('visi_misi')->insert([
            'teks_visi' => 'Menjadi seperti Yesus Kristus dengan menjadi murid, dewasa rohani, hidup Kudus, bersaksi dan memberitakan Injil.',
            'teks_misi' => 'Untuk mencapai visi, Gereja melaksanakan misi: Memberitakan kabar keselamatan Menjadikan orang percaya murid Kristus Melengkapi orang percaya untuk pekerjaan pelayanan bagi pembangunan Tubuh Kristus Meningkatkan persatuan dan kesatuan Tubuh Kristus',
        ]);
    }
}
