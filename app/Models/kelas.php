<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;
    protected $table='kelas';

    public function studi()
    {
        return $this->belongsTo(studi::class);
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(guru::class);
    }
}
