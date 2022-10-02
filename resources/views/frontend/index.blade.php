@extends('layouts.app')
@section('title', 'Landing Page')
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $key => $slider)
                <div class="carousel-item {{ $key == 0 ? 'active' : '0' }}">
                    @if ($slider->image)
                    <img src="{{ asset("$slider->image") }}" class="d-block w-100" alt="{{ $slider->title }}">
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1>
                                {!! $slider->title !!}
                            </h1>
                            <p>
                                {!! $slider->description !!}
                            </p>
                            <div>
                                <a href="#" class="btn btn-slider">
                                    Get Now
                                </a>
                            </div>
                        </div>
                    </div>
    
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Welcome to {{ env('APP_NAME') }} E-Commerce</h4>
                    <div class="underline mx-auto"></div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam veniam ducimus, consectetur quia adipisci blanditiis esse et illum molestiae dolorem officia sapiente porro, incidunt magnam, deleniti culpa? Deleniti quibusdam nobis delectus ut dolorum ab, repellat, aspernatur nam vero necessitatibus iste, aliquam at nihil? Illo amet maxime quisquam quas odio tempora possimus, nemo cum iste pariatur cumque ab, impedit dolorem dignissimos atque consequatur quam, incidunt eum illum porro. Odit exercitationem commodi nobis iusto expedita, voluptas sequi saepe corrupti earum vel, molestias amet sit explicabo atque quia quisquam reprehenderit. Non, dolorem quisquam? Repellat labore qui nam quam mollitia. Asperiores commodi voluptas et.</p>
            </div>
        </div>
    </div>
    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Trending Products</h4>
                    <div class="underline mb-4"></div>
                </div>
                @if($trendingProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme trending-product">
                            @foreach ($trendingProducts as $product)
                            <div class="item">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <label class="stock bg-danger">New</label>
                                        @if ($product->ProductImages->count() > 0)
                                            <a href="{{ route('productView.slug', [
                                                'category' => $product->Category->slug,
                                                    'product' => $product->slug]
                                                ) }}">
                                                <img src="{{ asset($product->ProductImages[0]->image) }}" alt="{{ $product->name }}">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $product->brand }}</p>
                                        <h5 class="product-name">
                                        <a href="{{ route('productView.slug', [
                                            'category' => $product->Category->slug,
                                                'product' => $product->slug]
                                            ) }}">
                                                {{ $product->name }}
                                        </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">${{ $product->selling_price }}</span>
                                            <span class="original-price">${{ $product->original_price }}</span>
                                        </div>
                                        {{-- <div class="mt-2">
                                            <a href="" class="btn btn1">Add To Cart</a>
                                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                            <a href="" class="btn btn1"> View </a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div> 
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No products available </h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
    $('.trending-product').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })
    </script>
@endsection