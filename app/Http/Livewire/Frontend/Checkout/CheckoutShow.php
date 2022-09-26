<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\Orderitem;
use Illuminate\Support\Facades\DB;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;
    public $fullname, $email, $phone, $address, $pincode, $payment_mode = NULL, $payment_id = NULL;

    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];

    public function paidOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this->payment_mode = "Paid by Paypal";
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'tracking_no' => \Str::slug(env('APP_NAME', 'WebStore')) . '-' . \Str::random(4),
                'fullname' => $this->fullname,
                'email' => $this->email,
                'phone' => $this->phone,
                'pincode' => $this->pincode,
                'address' => $this->address,
                'status_message' => 'In Progress',
                'payment_mode' => $this->payment_mode,
                'payment_id' => $this->payment_id,
            ]);

            foreach ($this->carts as $cartItem) {
                $orderItems = Orderitem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_color_id' => $cartItem->product_color_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->selling_price,
                ]);
                if ($cartItem->product_color_id != NULL) {
                    $cartItem->ProductColor()->where('id', '=', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
                    $cartItem->Product()->where('id', '=', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
                } else {
                    Cart::where('user_id', '=', auth()->user()->id)->delete();
                    $cartItem->Product()->where('id', '=', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
                }
            }
            DB::commit();
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order placed successfully',
                'type' => 'success',
                'status' => 200,
            ]);
            return redirect()->route('thank-you');
        } catch (\Exception $exception) {
            DB::rollback();
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500,
            ]);
            return false;
        }
    }

    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:35',
            'email' => 'required|string|email|max:150',
            'phone' => 'required|string|max:13|min:8',
            'pincode' => 'required|string|min:1|max:6',
            'address' => 'required|max:500'
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'tracking_no' => \Str::slug(env('APP_NAME', 'WebStore')) . '-' . \Str::random(4),
                'fullname' => $this->fullname,
                'email' => $this->email,
                'phone' => $this->phone,
                'pincode' => $this->pincode,
                'address' => $this->address,
                'status_message' => 'In Progress',
                'payment_mode' => $this->payment_mode,
                'payment_id' => $this->payment_id,
            ]);

            foreach ($this->carts as $cartItem) {
                $orderItems = Orderitem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_color_id' => $cartItem->product_color_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->selling_price,
                ]);
                if ($cartItem->product_color_id != NULL) {
                    $cartItem->ProductColor()->where('id', '=', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
                    $cartItem->Product()->where('id', '=', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
                } else {
                    $cartItem->Product()->where('id', '=', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollback();
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500,
            ]);
            return false;
        }
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if ($codOrder) {
            Cart::where('user_id', '=', auth()->user()->id)->delete();
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order placed successfully',
                'type' => 'success',
                'status' => 200,
            ]);
            return redirect()->route('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500,
            ]);
        }
    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::with('product')->where('user_id', '=', auth()->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
