<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studi extends Model
{
    use HasFactory;
    protected $table = 'studi';

    protected $fillable = ['studi'];

    // public function scopeSearch($query,$studi)
    // {
    //      return $query->where('studi','LIKE',"%{$studi}%");
    // }

    // public function scopeOnlyParent($query)
    // {
    //    return $query->whereNull('parent_id');
    // }

    // public function children()
    // {
    //      return $this->hasMany(self::class,'parent_id');
    // }

    // public function descendant()
    // {
    //     return $this->children()->with('descendant');
    // }

}
