@extends('layout.master')

@section('content')
<main>
    <div class="container px-4 px-lg-5 my-5 wow slideInLeft">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="{{ ($resource_info->img_path == null) ? asset('assets/question.png') : asset('storage/' . $resource_info->img_path) }}" alt="..." style="width: 600; height: auto;max-height: 700;">
            </div>
            <div class="col-md-6">
                <div class="small mb-1">{{ $resource_info->name }}</div>
                <h1 class="display-5 fw-bolder">Shop item template</h1>
                <div class="fs-5 mb-5">
                    <span>{{ $resource_info->price }} DH</span>
                </div>
                <p class="lead">{{ $resource_info->description }}</p>
                <div class="d-flex">
                    <input class="form-control text-center me-3 count-input" id="inputQuantity" type="num" value="1" style="max-width: 3rem">
                    @auth
                    <button class="btn btn-outline-dark flex-shrink-0 btn-add-to-cart" type="button" data-id="{{ $resource_info->id }}">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                    @else
                    <a class="btn btn-outline-dark flex-shrink-0 btn-add-to-cart" type="button" href="{{ route('client.login.form') }}">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</main>
@endsection