<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lab;

class LabSeeder extends Seeder
{
    public function run()
    {
        Lab::insert([
            ['name' => 'Lab CBT 1', 'kapasitas' => 30, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab CBT 2', 'kapasitas' => 30, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab CBT 3', 'kapasitas' => 30, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab CBT 4', 'kapasitas' => 30, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab CBT 5', 'kapasitas' => 30, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab CBT 6', 'kapasitas' => 30, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab CBT 7', 'kapasitas' => 30, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab CBT 8', 'kapasitas' => 30, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab CBT 9', 'kapasitas' => 30, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab Komputer 1', 'kapasitas' => 25, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab Komputer 2', 'kapasitas' => 25, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab Komputer 3', 'kapasitas' => 25, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab Jaringan 1', 'kapasitas' => 25, 'lokasi' => 'Lantai 8 Gedung C'],
            ['name' => 'Lab Jaringan 2', 'kapasitas' => 25, 'lokasi' => 'Lantai 6 Gedung A'],
            ['name' => 'Lab Jaringan 3', 'kapasitas' => 25, 'lokasi' => 'Lantai 6 Gedung A'],
            ['name' => 'Lab Multimedia', 'kapasitas' => 20, 'lokasi' => 'Lantai 3 Gedung C'],
        ]);
    }
}
