<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;

class ClientController extends Controller
{
    public function index()
    {
        // Ambil pesanan aktif milik klien yang login
        $activeOrder = Order::where('client', auth()->user()->name)
            ->whereIn('status', ['Menunggu Dikerjakan', 'Sedang Dikerjakan'])
            ->first();

        // SEKARANG SUDAH DINAMIS: Mengambil seluruh data dari tabel services database
        $services = Service::all();

        return view('client.dashboard', compact('activeOrder', 'services'));
    }

    public function checkout($id)
    {
        // Cari detail layanan berdasarkan ID asli dari database
        $service = Service::findOrFail($id);

        $orderDetail = [
            'mitra_name'    => $service->mitra_name,
            'game'          => $service->game,
            'service_title' => $service->title,
            'base_price'    => $service->price,
            'platform_fee'  => 5000,
            'total_price'   => $service->price + 5000,
        ];

        return view('client.checkout', compact('orderDetail'));
    }

    public function processCheckout(Request $request)
    {
        return redirect()->route('client.dashboard')->with('success', 'Pembayaran berhasil diunggah! Menunggu verifikasi Admin.');
    }
}
