<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $todayDate = Carbon::now();
        $orders = Order::whereDate('created_at', $todayDate)->paginate(25);
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
}
