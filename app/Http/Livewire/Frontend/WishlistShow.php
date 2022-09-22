<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
    public function render()
    {
        $wishlists = Wishlist::with(['product'])->where('user_id', '=', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlists' => $wishlists
        ]);
    }
}
