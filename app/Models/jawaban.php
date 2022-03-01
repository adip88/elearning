<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    use HasFactory;
    protected $table='jawaban';

    
    public function siswa()
    {
        return $this->belongsTo(siswa::class);
    }
}
