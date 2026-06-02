<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function index()
    {
        // Simulasi ngambil data dari Database.
        // Kita simpan status di Session Laravel agar tombolnya bisa interaktif.
        // Default-nya adalah 'unlocked' jika session belum diset.
        $sessionStatus = session('session_status', 'locked');

        $mockOrder = [
            'order_id' => 'ORD-88291A',
            'game' => 'Genshin Impact',
            'service_name' => 'Farming Material Karakter & Eksplorasi',
            'client_name' => 'Ahmad K.',
            'earnings' => 120000,
            'session_status' => $sessionStatus,
        ];

        return view('mitra.dashboard', compact('mockOrder'));
    }

    public function toggleSession(Request $request)
    {
        // Ambil status saat ini
        $currentStatus = session('session_status', 'unlocked');

        // Balikkan statusnya (Toggle): Jika unlocked jadi locked, jika locked jadi unlocked
        $newStatus = ($currentStatus === 'unlocked') ? 'locked' : 'unlocked';

        // Simpan status baru ke session
        session(['session_status' => $newStatus]);

        // Redirect kembali ke halaman dashboard dengan pesan sukses
        return redirect()->route('mitra.dashboard')->with('success', 'Status keamanan sesi berhasil diperbarui!');
    }
}
