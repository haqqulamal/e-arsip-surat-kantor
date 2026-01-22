<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_number',
        'subject',
        'date',
        'urgency',
        'classification_id',
        'department_id',
        'file_path'
    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
