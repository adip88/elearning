<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matkulkelas extends Model
{
    use HasFactory;
    protected $table='matkulkelas';
    protected $fillable =[
        'id',
        'kelas_id'
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }
    public function studi()
    {
        return $this->belongsTo(studi::class);
    }
    public function jadwal()
    {
        return $this->hasOne(jadwal::class);
    }


}
