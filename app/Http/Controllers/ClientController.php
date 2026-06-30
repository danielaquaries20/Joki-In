<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index()
    {
        $activeOrder = Order::where('client', auth()->user()->name)
            ->whereIn('status', ['Menunggu Dikerjakan', 'Sedang Dikerjakan'])
            ->first();

        $services = Service::all();

        return view('client.dashboard', compact('activeOrder', 'services'));
    }

    public function checkout($id)
    {

        $service = Service::findOrFail($id);

        return view('client.checkout', compact('service'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'game' => 'required|string',
            'mitra_name' => 'required|string',
            'service_name' => 'required|string',
            'price' => 'required|numeric',
            'game_id' => 'required|string',
            'game_password' => 'required|string',
            'game_server' => 'required|string',
            'payment_receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $orderCode = 'JK-' . date('ymd') . '-' . strtoupper(Str::random(5));

        $receiptPath = null;
        if ($request->hasFile('payment_receipt')) {
            $receiptPath = $request->file('payment_receipt')->store('receipts', 'public');
        }

        Order::create([
            'order_code' => $orderCode,
            'service_id' => $request->service_id,
            'game' => $request->game,
            'service_name' => $request->service_name,
            'client' => auth()->user()->name,
            'mitra' => $request->mitra_name,
            'price' => $request->price,
            'status' => 'Menunggu Dikerjakan',
            'session_status' => 'unlocked',
            'game_id' => $request->game_id,
            'game_password' => $request->game_password,
            'game_server' => $request->game_server,
            'payment_receipt' => $receiptPath,
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Pembayaran berhasil diunggah! Kode Pesanan Anda: ' . $orderCode);
    }

    public function completeOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id'
        ]);

        $order = Order::findOrFail($request->order_id);

        if ($order->client !== auth()->user()->name) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $order->update([
            'status' => 'Selesai',
            'session_status' => 'unlocked'
        ]);

        return redirect()->back()->with('success', 'Pesanan telah berhasil diselesaikan! Terima kasih telah menggunakan Joki In.');
    }
}
