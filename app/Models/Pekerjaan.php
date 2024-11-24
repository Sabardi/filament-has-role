<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Pekerjaan extends Model
{
    protected $fillable = [
        'company',
        'title',
        'email',
        'thumbnail',
        'description',
        'location',
        'kategori_id',
    ];


    public function kategoris(){

       return $this->belongsTo(Kategori::class, 'kategori_id');
    }

}
