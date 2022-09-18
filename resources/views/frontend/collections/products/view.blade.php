@extends('layouts.app')
@section('title', $product->meta_title)
@section('meta_keyword', $product->meta_keyword)
@section('meta_description', $product->meta_description)
@section('content')


    <div>
        <livewire:frontend.product.view :category="$category" :product="$product"/>
    </div>

@endsection