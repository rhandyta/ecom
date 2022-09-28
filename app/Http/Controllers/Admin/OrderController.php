<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::query()
            ->when($request->date != null, function ($q) use ($request) {
                $q->whereDate('created_at', $request->date);
            }, function ($q) use ($todayDate) {
                $q->whereDate('created_at', $todayDate);
            })
            ->when($request->status != null, function ($q) use ($request) {
                $q->where('status_message', $request->status);
            })
            ->paginate(25);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            return view('admin.orders.show', compact('order'));
        }
        return redirect()->back()->with('message', 'No order found');
    }

    public function update(Request $request, int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            $order->update([
                'status_message' => $request->order_status
            ]);
            return redirect()->route('admin.showorders', $order->id)->with('message', 'Order status updated');
        } else {
            return redirect()->route('admin.showorders', $order->id)->with('message', 'Order not found');
        }
    }
}
