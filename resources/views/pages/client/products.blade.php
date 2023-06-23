@extends('layout.master')

@section('content')
<main class="shop-page">
    <div class="container">
        <div class="page-header wow fadeInUp">
            
            @if (request()->has('categorie'))
                <h2 class="page-title">Products  categorie id : {{ request()->query('categorie') }}</h2>
            @else
                <h2 class="page-title">All Products</h2>
            @endif
        </div>
        <div class="row">
            @foreach ($products->items() as $product)
                <div class="col-md-4 product-card wow fadeInUp">
                    <a href="{{ route('client.product',['id' => $product->id]) }}" style="text-decoration:none;color:inherit;">
                        <div class="product-thumbnail-wrapper">
                            <img src="{{ ($product->img_path == null) ? asset('assets/question.png') : asset('storage/' . $product->img_path) }}" alt="product" class="product-thumbnail">
                        </div>
                        <h5 class="product-title">{{ $product->name }}</h5>
                    </a>
                    <p class="product-price">{{ $product->price }} DH</p>
                    <div class="btn-wrapper">
                        @auth
                            <button class="btn btn-add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
                        @else
                            <a class="btn btn-add-to-cart" href="{{ route('client.login.form') }}" data-id="{{ $product->id }}">Add to Cart</a>
                        @endauth
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 d-flex justify-content-center wow fadeInDown">
                {{ $products->links('pages.components.pagination_custom') }}
            </div>
        </div>
    </div>
</main>
@endsection