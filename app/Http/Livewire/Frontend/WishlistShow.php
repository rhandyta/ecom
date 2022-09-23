<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{



    public function deleteWishlistItem(int $wishlistsId)
    {
        Wishlist::where('user_id', '=', auth()->user()->id)->where('id', '=', $wishlistsId)->delete();
        $this->emit('wishlistAddedOrUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Wishlist item removed successfully',
            'type' => 'success',
            'status' => 200
        ]);
    }

    public function render()
    {
        $wishlists = Wishlist::with(['product'])->where('user_id', '=', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlists' => $wishlists
        ]);
    }
}
