<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;
    protected $table='jawaban';

    public function jawaban()
    {
        return $this->hasOne(jawabban::class);
    }
}
