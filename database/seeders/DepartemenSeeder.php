<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Departemen::insert([
            ['nama_departemen' => 'Keuangan'],
            ['nama_departemen' => 'Perbankan'],
            ['nama_departemen' => 'Pemasaran'],
            ['nama_departemen' => 'Penjualan'],
        ]);
    }

}
