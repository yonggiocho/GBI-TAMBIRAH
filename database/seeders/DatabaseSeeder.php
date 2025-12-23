<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Identitas;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            [
                'name' => 'Yonggi Kawoco',
                'email' => 'jajiut@gmail.com',
                'password' => 'Gbisehati2025',
                'pass_hint' => Crypt::encrypt('Gbisehati2025'),
                'role' => 'admin'
            ],
            [
                'name' => 'Jefri Holmes Mandey',
                'email' => 'pleasecall.jeje@gmail.com',
                'password' => 'Gbisehati2025',
                'pass_hint' => Crypt::encrypt('Gbisehati2025'),
                'role' => 'admin'
            ]
        ];

         $identitas = [
            'nama_website' => 'Gereja Bethel Indonesia Tumbang Tambirah',
            'alamat' => 'Jalan Perjuangan Desa Tumbang Tambirah',
            'telepon' => '-',
            'email' => 'test@gmail.com',
            'logo' => '',
            'favicon' => '',
            'facebook' => '-',
            'instagram' => '-',
            'youtube' => '-',
            'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4217.675958789164!2d113.8228246!3d-1.0627945!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfea1f7d01f0055%3A0xc3996fe4a6b8816e!2sGBI%20tbg%20tambirah!5e1!3m2!1sid!2sid!4v1763366741007!5m2!1sid!2sid'
        ];

        foreach($users as $user) {
             User::create($user);
        }

        Identitas::create($identitas);

        DB::table('visi_misi')->insert([
            'teks_visi' => 'Menjadi seperti Yesus Kristus dengan menjadi murid, dewasa rohani, hidup Kudus, bersaksi dan memberitakan Injil.',
            'teks_misi' => 'Untuk mencapai visi, Gereja melaksanakan misi: Memberitakan kabar keselamatan Menjadikan orang percaya murid Kristus Melengkapi orang percaya untuk pekerjaan pelayanan bagi pembangunan Tubuh Kristus Meningkatkan persatuan dan kesatuan Tubuh Kristus',
        ]);



    }
}
