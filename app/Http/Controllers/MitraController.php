<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Pastikan model Order di-import

class MitraController extends Controller
{
    public function dashboard()
    {
        // Mengambil seluruh data order riil dari database
        $orders = Order::all();

        return view('mitra.dashboard', [
            'orders'        => $orders,
            'totalOrders'   => $orders->count(),
            'activeOrders'  => $orders->where('status', 'Sedang Dikerjakan')->count(),
            'pendingOrders' => $orders->where('status', 'Menunggu Dikerjakan')->count(),
        ]);
    }

    public function orderDetail($id)
    {
        // Mengambil satu data order berdasarkan ID dari database, otomatis 404 jika tidak ada
        $order = Order::findOrFail($id);

        return view('mitra.detail', compact('order'));
    }

    public function toggleSession(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'stream_url' => 'nullable|url',
        ]);

        $order = Order::findOrFail($request->order_id);

        if ($order->session_status == 'unlocked') {

            $order->update([
                'session_status' => 'locked',
                'stream_url' => $request->stream_url,
            ]);
        } else {

            $order->update([
                'session_status' => 'unlocked',
                'stream_url' => null,
            ]);
        }

        return back()->with('success', 'Status sesi berhasil diperbarui.');
    }
}
