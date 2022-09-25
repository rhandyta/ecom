<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{

    public $cart;

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('user_id', '=', auth()->user()->id)->where('id', '=', $cartId)->first();
        if ($cartData) {
            if ($cartData->quantity > 1) {
                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => "Quantity updated",
                    'type' => "success",
                    'status' => 200
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => "Quantity cannot be less than 1",
                    'type' => 'info',
                    "status" => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => "Something went wrong",
                'type' => "error",
                'status' => 404
            ]);
        }
    }

    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('user_id', '=', auth()->user()->id)->where('id', '=', $cartId)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', '=', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', '=', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => "Quantity updated",
                        'type' => "success",
                        'status' => 200
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => "Product color only " . $productColor->quantity . " quantity available",
                        'type' => "warning",
                        'status' => 200
                    ]);
                }
            } else {
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => "Quantity updated",
                        'type' => "success",
                        'status' => 200
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => "Product only " . $cartData->product->quantity . " quantity available",
                        'type' => "warning",
                        'status' => 200
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => "Something went wrong",
                'type' => "error",
                'status' => 404
            ]);
        }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', '=', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'carts' => $this->cart
        ]);
    }
}
