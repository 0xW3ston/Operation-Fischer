@extends('layout.master')

@section('extra-head')
    <link href="{{ asset('assets/client/css/register.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="card bg-light py-3">
    <article class="card-body mx-auto" style="width: 400px;">
        <h4 class="card-title mt-3 text-center">Log in</h4>
        <p class="text-center">Glad to see you here again !</p>
        <form action="{{ route('client.login') }}" method="POST">
            <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="bi bi-person"></i> </span>
                </div>
                <input name="username" class="form-control" placeholder="Type your username" type="text"/>
            </div>
            <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="bi bi-lock"></i> </span>
                </div>
                <input name="password" class="form-control" placeholder="Create password" type="password">
            </div> <!-- form-group// -->
            {{-- <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="bi bi-lock"></i> </span>
                </div>
                <input class="form-control" placeholder="Repeat password" type="password">
            </div> <!-- form-group// --> --}}
            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Log in </button>
            </div> <!-- form-group// -->
            <p class="text-center">Want to register ? <a href="{{ route('client.register.form') }}">Sign up</a> </p>
        </form>
    </article>
</div>
@endsection