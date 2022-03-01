<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class profile extends Model
{
    use HasFactory;

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
    public function matkulkelas()
    {
        return $this->belongsTo(matkulkelas::class);
    }
    
    public function siswa()
    {
        return $this->belongsTo(siswa::class);
    }
    
}
