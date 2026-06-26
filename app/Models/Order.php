<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang diizinkan untuk diisi secara massal (Mass Assignment).
     * Sesuaikan dengan kolom yang telah kita buat di file migration.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_code',
        'client',
        'game',
        'service_name',
        'price',
        'status',
        'session_status',
        'stream_url',
    ];
}
