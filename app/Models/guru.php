<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class guru extends Model
{
    use HasFactory;
    protected $table='guru';

    
    protected $fillable =[
        'id_guru',
        'name',
        'no_hp',
        'jenis_kelamin',
        'agama',
        'alamat',
        'email',
        'tgl_lahir',
        'tempat_lahir',
        'image',
        'guru_id',
    ];

    public function user()
    {
        return $this->hasOne(user::class);
    }
}
