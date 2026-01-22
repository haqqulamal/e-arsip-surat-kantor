<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }
}
