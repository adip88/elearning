<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwalsiswa extends Model
{
    use HasFactory;
    protected $table='jadwal2';
  
    protected $fillable =[
        'hari',
        'matkulkelas_id'
    ];

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
}
