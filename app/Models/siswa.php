<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class siswa extends Model
{
    use HasFactory;
    protected $table='siswa';

    protected $fillable =[
        'name',
        'no_hp',
        'jenis_kelamin',
        'agama',
        'alamat',
        'email',
        'tgl_lahir',
        'tempat_lahir',
        'image',
        'siswa_id',
        'kelas_id'
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function user()
    {
        return $this->hasOne(user::class);
    }
}
