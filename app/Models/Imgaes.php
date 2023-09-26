<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imgaes extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

}
