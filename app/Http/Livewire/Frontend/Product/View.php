<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Livewire\Component;

class View extends Component
{

    public $category, $product, $productColorSelectedQuantity, $quantityCount = 1, $productColorId;

    public function addToWishlist($productId)
    {
        if (auth()->check()) {
            if (Wishlist::where('user_id', '=', auth()->user()->id)->where('product_id', '=', $productId)->exists()) {
                session()->flash('message', 'Already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added to wishlist',
                    'type' => 'warning',
                    'status' => 200
                ]);
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                ]);
                $this->emit('wishlistAddedOrUpdated');
                session()->flash('message', 'Wishlist added successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist added successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            session()->flash('message', 'Please login to be continue. <a class="btn btn-success btn-sm" href="' . route('login') . '">Login</a>');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please login to be continue.',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
        $productColor = $this->product->ProductColors->where('id', '=', $productColorId)->first();
        $this->productColorSelectedQuantity = $productColor->quantity;
        if ($this->productColorSelectedQuantity == 0) {
            $this->productColorSelectedQuantity = "OutofStock";
        }
    }

    public function incrementQuantity()
    {


        $this->quantityCount++;
    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
        return false;
    }

    public function addToCart(int $productId)
    {
        if (auth()->check()) {
            if ($this->product->where('id', '=', $productId)->where('status', '=', 0)->exists()) {
                if ($this->product->productColors->count() > 0) {
                    if ($this->productColorSelectedQuantity != NULL) {

                        if (Cart::where('user_id', '=', auth()->user()->id)->where('product_id', '=', $productId)->where('product_color_id', '=', $this->productColorId)->exists()) {
                            $this->dispatchBrowserEvent('message', [
                                'text' => "Product already exists",
                                'type' => "warning",
                                'status' => 200,
                            ]);
                        } else {
                            $productColor = $this->product->ProductColors()->where('id', '=', $this->productColorId)->first();
                            if ($productColor->quantity > 0) {
                                if ($productColor->quantity >= $this->quantityCount) {
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount,
                                    ]);
                                    $this->emit("CartAddedOrUpdated");
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => "Product added to cart",
                                        'type' => "success",
                                        'status' => 200,
                                    ]);
                                } else {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => "Only " . $productColor->quantity . " quantity available",
                                        'type' => "warning",
                                        'status' => 404,
                                    ]);
                                }
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => "Product color out of stock",
                                    'type' => "warning",
                                    'status' => 404,
                                ]);
                            }
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => "Select product your color",
                            'type' => "info",
                            'status' => 404,
                        ]);
                    }
                } else {
                    if (Cart::where('user_id', '=', auth()->user()->id)->where('product_id', '=', $productId)->exists()) {
                        $this->dispatchBrowserEvent('message', [
                            'text' => "Product already exists",
                            'type' => "warning",
                            'status' => 200,
                        ]);
                    } else {
                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity >= $this->quantityCount) {
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount,
                                ]);
                                $this->emit("CartAddedOrUpdated");
                                $this->dispatchBrowserEvent('message', [
                                    'text' => "Product added to cart",
                                    'type' => "success",
                                    'status' => 200,
                                ]);
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => "Only " . $this->product->quantity . " quantity available",
                                    'type' => "warning",
                                    'status' => 404,
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => "Product out of stock",
                                'type' => "warning",
                                'status' => 404,
                            ]);
                        }
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => "Product does not exist",
                    'type' => "warning",
                    'status' => 404,
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => "Please login to add cart",
                'type' => "info",
                'status' => 401,
            ]);
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
