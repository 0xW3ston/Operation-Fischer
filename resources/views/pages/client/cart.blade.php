@extends('layout.master')

@section('extra-head')
    <link href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="pt-5 pb-5">
    <div class="container">
      <div class="row w-100">
          <div class="col-lg-12 col-md-12 col-12">
              <h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
              <p class="mb-5 text-center">
                  <i class="text-info font-weight-bold">{{ count(request()->session()->get('cart',[])) }}</i> items in your cart</p>
              <table id="shoppingCart" class="table table-condensed table-responsive">
                  <thead>
                      <tr style="text-align:center;">
                          <th style="width:40%">Product</th>
                          <th style="width:17%">Price (Unit)</th>
                          <th style="width:10%">Quantity</th>
                          <th style="width:15%">Price * Qte</th>
                          <th style="width:16%"></th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach (request()->session()->get('cart',[]) as $cart_item)
                      <tr style="text-align:center;">
                          <td data-th="Product">
                              <div class="row">
                                  <div class="col-md-3 text-left">
                                      <img src="{{ ($cart_item['article']->img_path == null) ? asset('assets/question.png') : asset('storage/' . $cart_item['article']->img_path) }}" alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow ">
                                  </div>
                                  <div class="col-md-9 text-left mt-sm-2">
                                      <h4>{{ $cart_item['article']->name }}</h4>
                                      <p class="font-weight-light">{{ $cart_item['article']->description }}</p>
                                  </div>
                              </div>
                          </td>
                          <td data-th="Price">{{ $cart_item['article']->price }} DH</td>
                          <td data-th="Quantity">
                              <input disabled type="number" class="form-control form-control-sm text-center" value="{{ $cart_item['qte'] }}">
                          </td>
                          <td data-th="Quantity * Price">
                            <input disabled type="number" class="form-control form-control-sm text-center" value="{{ $cart_item['qte'] * $cart_item['article']->price }}">
                          </td>
                          <td class="actions" data-th="">
                            <div class="text-right">
                                <a href="{{ route('client.product',['id' => $cart_item['article']->id ]) }}"class="btn btn-white border-secondary bg-warning btn-md mb-2">
                                    <i class="bi bi-info-circle"></i>
                                </a>
                                <a href="{{ route('client.cart.remove',['id' => $cart_item['article']->id ]) }}" class="btn btn-white border-secondary bg-danger btn-md mb-2">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                          </td>
                      </tr>
                      @php
                          $total += $cart_item['qte'] * $cart_item['article']->price
                      @endphp
                    @endforeach
                  </tbody>
              </table>
              <div class="float-right text-right">
                  <h4>Subtotal:</h4>
                  <h1>{{ $total }} DH</h1>
              </div>
          </div>
      </div>
      <div class="row mt-4 d-flex align-items-center">
          <div class="col-sm-6 order-md-2 text-right">
              <a href="{{ route('client.commande.ajouter') }}" class="btn btn-primary mb-4 btn-lg pl-5 pr-5">Checkout</a>
              <a href="{{ route('client.cart.clear') }}" class="btn btn-outline-danger mb-4 btn-lg ml-2">Clear Cart</a>
          </div>
          <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
              <a href="{{ route('client.categories') }}">
                  <i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
          </div>
      </div>
  </div>
</section>
@endsection