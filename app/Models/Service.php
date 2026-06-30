<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'game',
        'category',
        'mitra_name',
        'rating',
        'reviews',
        'title',
        'price',
    ];
}
