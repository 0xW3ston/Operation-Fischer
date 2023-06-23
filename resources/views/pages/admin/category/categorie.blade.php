@extends('layout.admin')

@section('content')
<div class="pagetitle">
    {{-- <h1>Profile</h1> --}}
    {{-- <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav> --}}
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">

      <div class="col-xl-12">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="card-title">List of Categories:</h5>
                <div class="container mt-4">
                    <div class="input-group mb-3">
                        <form action="{{ route('admin.categorie.all') }}" method="GET" class="d-flex">
                            <input name="search" type="text" class="form-control me-2" placeholder="Search...">
                            <button class="btn btn-outline-secondary" type="submit" id="searchButton">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                        <div class="input-group-append mx-2">
                            <a href="{{ url()->current() }}?page=1" class="btn btn-outline-danger" id="deleteButton">
                                <i class="bi bi-x"></i>
                            </a>
                        </div>
                        <div class="input-group-append mx-6">
                            <a href="{{ route('admin.categorie.add') }}" class="btn btn-success"
                                id="addProductButton">
                                Add a Category
                            </a>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paginator->items() as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('admin.categorie.edit',['id' => $item->id])}}"><i class="bi bi-gear-wide-connected"></i></a>
                                    <a class="btn btn-danger" href="{{ route('admin.categorie.delete',['id' => $item->id])}}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        {{ $paginator->appends(['search' => request()->search ])->links('pagination::bootstrap-5') }}
                    </div>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection