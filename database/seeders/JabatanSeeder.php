<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Position::insert([
            [
                'nama_jabatan' => 'Supervisor',
                'gaji_pokok' => 7000000,
            ],
            [
                'nama_jabatan' => 'Manager',
                'gaji_pokok' => 5000000,
            ],
            [
                'nama_jabatan' => 'Staff Ahli',
                'gaji_pokok' => 4500000,
            ],
            [
                'nama_jabatan' => 'Staff Muda',
                'gaji_pokok' => 4000000,
            ],
            [
                'nama_jabatan' => 'Intern',
                'gaji_pokok' => 500000,
            ],
        ]);
    }

}
