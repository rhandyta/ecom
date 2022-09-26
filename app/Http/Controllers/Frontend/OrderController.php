<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', '=', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('frontend.orders.index', compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::where('user_id', '=', auth()->user()->id)->where('id', $orderId)->first();
        if ($order) {
            return view('frontend.orders.show', compact('order'));
        }
        return redirect()->back()->with('message', 'No order found');
    }
}
