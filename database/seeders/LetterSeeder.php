<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $letters = [
            [
                'letter_number' => '001/UND/2026',
                'subject' => 'Undangan Rapat Divisi',
                'date' => '2026-01-20',
                'urgency' => 'penting',
                'classification_id' => 1,
                'department_id' => 1,
            ],
            [
                'letter_number' => '002/PENG/2026',
                'subject' => 'Pengumuman Libur Nasional',
                'date' => '2026-01-21',
                'urgency' => 'biasa',
                'classification_id' => 2,
                'department_id' => 1,
            ],
            [
                'letter_number' => '003/TGS/2026',
                'subject' => 'Surat Tugas Perjalanan Dinas',
                'date' => '2026-01-22',
                'urgency' => 'rahasia',
                'classification_id' => 3,
                'department_id' => 2,
            ],
            [
                'letter_number' => '004/UND/2026',
                'subject' => 'Undangan Rapat Anggaran',
                'date' => '2026-01-23',
                'urgency' => 'penting',
                'classification_id' => 1,
                'department_id' => 2,
            ],
            [
                'letter_number' => '005/PENG/2026',
                'subject' => 'Pengumuman Penerimaan Karyawan',
                'date' => '2026-01-24',
                'urgency' => 'biasa',
                'classification_id' => 2,
                'department_id' => 3,
            ],
        ];

        foreach ($letters as $letter) {
            \App\Models\Letter::create($letter);
        }
    }
}
