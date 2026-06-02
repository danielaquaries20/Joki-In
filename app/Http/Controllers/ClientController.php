<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        // Mock Data Pesanan Aktif (Simulasi jika Klien punya pesanan yang sedang jalan)
        $activeOrder = [
            'order_id' => 'ORD-88291A',
            'game' => 'Genshin Impact',
            'status' => 'Sedang Dikerjakan',
            // Kita simulasikan status dari session Mitra tadi
            'session_locked' => session('session_status', 'unlocked') === 'locked',
        ];

        // Mock Data Katalog Jasa Mitra
        $services = [
            [
                'id' => 1,
                'mitra_name' => 'Fahmi "Carry" R.',
                'game' => 'Mobile Legends',
                'title' => 'Jasa Teman Mabar (Party) - Jaminan Win Rate',
                'category' => 'Kompetitif',
                'price' => 25000,
                'rating' => 4.9,
                'reviews' => 124
            ],
            [
                'id' => 2,
                'mitra_name' => 'Sarah Gaming',
                'game' => 'Genshin Impact',
                'title' => 'Eksplorasi Map 100% (Fontaine & Sumeru)',
                'category' => 'Single-Player',
                'price' => 150000,
                'rating' => 5.0,
                'reviews' => 89
            ],
            [
                'id' => 3,
                'mitra_name' => 'Budi "Radiant"',
                'game' => 'Valorant',
                'title' => 'Mabar Push Rank - Role Controller/Initiator',
                'category' => 'Kompetitif',
                'price' => 35000,
                'rating' => 4.8,
                'reviews' => 56
            ],
            [
                'id' => 4,
                'mitra_name' => 'Limbus Master',
                'game' => 'Limbus Company',
                'title' => 'Farming Thread & Egoshard Mingguan',
                'category' => 'Single-Player',
                'price' => 75000,
                'rating' => 4.9,
                'reviews' => 42
            ],
        ];

        $category = $request->category;

        if ($category) {
            $services = array_filter($services, function ($service) use ($category) {
                return $service['category'] === $category;
            });
        }

        return view('client.dashboard', compact('activeOrder', 'services'));
    }

    public function checkout($id)
    {
        // Mock Data Detail Pesanan yang akan dibayar
        $orderDetail = [
            'mitra_name' => 'Sarah Gaming',
            'game' => 'Genshin Impact',
            'service_title' => 'Eksplorasi Map 100% (Fontaine & Sumeru)',
            'base_price' => 150000,
            'platform_fee' => 5000, // Biaya layanan Joki In
            'total_price' => 155000,
        ];

        return view('client.checkout', compact('orderDetail'));
    }

    public function processCheckout(Request $request)
    {
        // Simulasi proses upload resi
        return redirect()->route('client.dashboard')->with('success', 'Pembayaran berhasil diunggah! Menunggu verifikasi Admin.');
    }
}
