<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jam;

class JamSeeder extends Seeder
{
    public function run()
    {
        Jam::insert([
            ['waktu_mulai' => '07:10', 'waktu_selesai' => '08:50', 'jenis' => 'Reguler A'], // Reguler A
            ['waktu_mulai' => '08:50', 'waktu_selesai' => '10:30', 'jenis' => 'Reguler A'], // Reguler A
            ['waktu_mulai' => '10:30', 'waktu_selesai' => '12:10', 'jenis' => 'Reguler A'], // Reguler A
            ['waktu_mulai' => '13:00', 'waktu_selesai' => '14:40', 'jenis' => 'Reguler A'], // Reguler A
            ['waktu_mulai' => '14:40', 'waktu_selesai' => '16:20', 'jenis' => 'Reguler A'], // Reguler A
            ['waktu_mulai' => '18:20', 'waktu_selesai' => '19:00', 'jenis' => 'Reguler B'], // Reguler B
            ['waktu_mulai' => '19:00', 'waktu_selesai' => '21:40', 'jenis' => 'Reguler B'], // Reguler B
            ['waktu_mulai' => '07:40', 'waktu_selesai' => '09:20', 'jenis' => 'Reguler CK/CS'], // Reguler CK/CS
            ['waktu_mulai' => '09:20', 'waktu_selesai' => '11:00', 'jenis' => 'Reguler CK/CS'], // Reguler CK/CS
            ['waktu_mulai' => '11:00', 'waktu_selesai' => '13:50', 'jenis' => 'Reguler CK/CS'], // Reguler CK/CS
            ['waktu_mulai' => '13:50', 'waktu_selesai' => '15:30', 'jenis' => 'Reguler CK/CS'], // Reguler CK/CS
            ['waktu_mulai' => '16:00', 'waktu_selesai' => '17:40', 'jenis' => 'Reguler CK/CS'], // Reguler CK/CS
        ]);
    }
}
