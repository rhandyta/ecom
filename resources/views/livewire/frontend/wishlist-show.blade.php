<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-4">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($wishlists as $wishlist)
                            @if ($wishlist->Product)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a href="{{ route('productView.slug', [
                                            'category' => $wishlist->product->category->slug,
                                            'product' => $wishlist->product->slug,
                                        ]) }}">
                                            <label class="product-name">
                                                <img src="{{ asset($wishlist->product->ProductImages[0]->image) }}" style="width: 50px; height: 50px" alt="{{ $wishlist->product->name }}">
                                                {{ $wishlist->product->name }}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label class="price">${{ $wishlist->product->original_price }} </label>
                                    </div>
                                    
                                    <div class="col-md-4 col-12 my-auto">
                                        <div class="remove">
                                            <button type="button" class="btn btn-danger btn-sm" wire:click="deleteWishlistItem({{ $wishlist->id }})">
                                                <span wire:loading.remove wire:target='deleteWishlistItem'>
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading wire:target='deleteWishlistItem'>
                                                    <i class="fa fa-trash"></i> Removing
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty
                            <h4>No wishlists added</h4>
                        @endforelse
                                
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
