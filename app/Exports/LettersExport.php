<?php

namespace App\Exports;

use App\Models\Letter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LettersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Letter::with(['classification', 'department'])->get();
    }

    public function headings(): array
    {
        return [
            'No Surat',
            'Perihal',
            'Klasifikasi',
            'Bagian',
            'Tanggal',
            'Sifat',
        ];
    }

    public function map($letter): array
    {
        return [
            $letter->letter_number,
            $letter->subject,
            $letter->classification->name,
            $letter->department->name,
            \Carbon\Carbon::parse($letter->date)->format('d-m-Y'),
            ucfirst($letter->urgency),
        ];
    }
}
