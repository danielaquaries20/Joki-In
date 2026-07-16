<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Menentukan apakah pengguna boleh melihat detail order dan kredensial.
     */
    public function view(User $user, Order $order): bool
    {
        // Hanya Client pemilik order ATAU Mitra yang mengerjakan order yang boleh masuk
        return $user->id === $order->client_id || $user->id === $order->mitra_id;
    }
}
