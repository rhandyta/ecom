@extends('layouts.app')
@section('title', 'Thank you for Shopping')
@section('content')
    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="p-4 shadow bg-white">
                        <h4>You Logo</h4>
                        <h4>Thank you for shopping with ....</h4>
                        <a href="{{ route('categories') }}" class="btn btn-primary">Shopping Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection