<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class MitraController extends Controller
{
    public function index()
    {
        $currentMitraName = Auth::user()->name;
        $orders = Order::whereHas('service', function ($query) use ($currentMitraName) {
            $query->where('mitra_name', $currentMitraName);
        })->latest()->get();

        $totalOrders = $orders->count();
        $activeOrders = $orders->whereIn('status', ['Sedang Dikerjakan', 'processing'])->count();
        $pendingOrders = $orders->whereIn('status', ['Menunggu Dikerjakan', 'pending_payment'])->count();

        return view('mitra.dashboard', compact('orders', 'totalOrders', 'activeOrders', 'pendingOrders'));
    }

    public function orderDetail($id)
    {
        // Ambil data order beserta relasi servicenya (Eager Loading)
        $order = Order::with('service')->where('id', $id)->firstOrFail();

        // Kirim $order dan $service sekaligus ke view
        return view('mitra.detail', [
            'order' => $order,
            'service' => $order->service // Mengambil object service dari relasi
        ]);
    }

    public function toggleSession(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'stream_url' => 'nullable|url'
        ]);

        $order = Order::findOrFail($request->order_id);

        if ($order->session_status == 'unlocked') {
            $order->update([
                'session_status' => 'locked',
                'stream_url' => $request->stream_url,
                'status' => 'Sedang Dikerjakan'
            ]);

            return redirect()->back()->with('success', 'Sesi pengerjaan dimulai, status order diubah menjadi Sedang Dikerjakan!');
        } else {
            $order->update([
                'session_status' => 'unlocked',
            ]);

            return redirect()->back()->with('success', 'Sesi diakhiri, akun client kembali terbuka.');
        }
    }

    public function createService()
    {
        return view('mitra.create-service');
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'game' => 'required|string|max:255',
            'category' => 'required|string',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:1000',
        ]);

        Service::create([
            'game' => $request->game,
            'category' => $request->category,
            'title' => $request->title,
            'price' => $request->price,
            'mitra_name' => Auth::user()->name,
            'rating' => 5.0,
            'reviews' => 0,
        ]);

        return redirect()->route('mitra.dashboard')->with('success', 'Jasa joki baru berhasil ditambahkan!');
    }

    public function finishOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id'
        ]);

        $order = Order::findOrFail($request->order_id);

        if ($order->mitra !== auth()->user()->name) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $order->update([
            'status' => 'Menunggu Konfirmasi Client',
            'session_status' => 'unlocked',
            'stream_url' => null,
        ]);

        return back()->with(
            'success',
            'Pekerjaan selesai. Menunggu konfirmasi client.'
        );
    }
}
