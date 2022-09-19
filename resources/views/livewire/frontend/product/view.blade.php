<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border">
                        @if ($product->ProductImages)
                        <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img">
                        @else
                            No Image
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                            
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->Category->name }} / Product / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">${{ $product->selling_price }}</span>
                            <span class="original-price">${{ $product->original_price }}</span>
                        </div>
                        <div>
                            @if ($product->productcolors->count() > 0)
                                @if ($product->productcolors)
                                    @foreach ($product->productcolors as $productcolor)
                                        {{-- <input type="radio" class="form-check-input" name="colorSelection" value="{{ $productColor->id }}" /> {{ $productColor->color->name }} --}}
                                        <label class="colorSelectionLabel" style="background-color: {{ $productcolor->color->code }}" wire:click="colorSelected({{ $productcolor->id }})"
                                            >
                                            {{ $productcolor->color->name }}
                                        </label>
                                    @endforeach
                                    
                                @endif
                            @else
                                @if ($product->quantity)
                                    <label class="btn btn-sm text-white py-1 mt-2 bg-success">In Stock</label>
                                @else
                                    <label class="btn btn-sm text-white py-1 mt-2 bg-danger">Out of Stock</label>
                                @endif
                            @endif
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1"><i class="fa fa-minus"></i></span>
                                <input type="text" value="1" class="input-quantity" />
                                <span class="btn btn1"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="" class="btn btn1"> <i class="fa fa-shopping-cart"></i> Add To Cart</a>
                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> Add To Wishlist </a>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {!! $product->small_description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!! $product->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
