<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'order_code',
        'client',
        'game',
        'service_name',
        'price',
        'status',
        'session_status',
        'stream_url',
        'game_id',
        'game_password',
        'game_server',
        'payment_receipt',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
