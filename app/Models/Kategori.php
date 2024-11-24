<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'name'
    ];
    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class);
    }
}
