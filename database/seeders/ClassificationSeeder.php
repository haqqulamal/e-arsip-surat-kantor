<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classifications = [
            ['code' => 'UND', 'name' => 'Undangan Rapat'],
            ['code' => 'PENG', 'name' => 'Pengumuman'],
            ['code' => 'TGS', 'name' => 'Surat Tugas'],
        ];

        foreach ($classifications as $classification) {
            \App\Models\Classification::create($classification);
        }
    }
}
