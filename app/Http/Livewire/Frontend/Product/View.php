<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{

    public $category, $product, $productColorSelectedQuantity;

    public function addToWishlist($productId)
    {
        if (auth()->check()) {
            if (Wishlist::where('user_id', '=', auth()->user()->id)->where('product_id', '=', $productId)->exists()) {
                session()->flash('message', 'Already added to wishlist');
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                ]);
                session()->flash('message', 'Wishlist added successfully');
            }
        } else {
            session()->flash('message', 'Please login to be continue. <a class="btn btn-success btn-sm" href="' . route('login') . '">Login</a>');
            return false;
        }
    }

    public function colorSelected($productColorId)
    {
        $productColor = $this->product->ProductColors->where('id', '=', $productColorId)->first();
        $this->productColorSelectedQuantity = $productColor->quantity;
        if ($this->productColorSelectedQuantity == 0) {
            $this->productColorSelectedQuantity = "OutofStock";
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
