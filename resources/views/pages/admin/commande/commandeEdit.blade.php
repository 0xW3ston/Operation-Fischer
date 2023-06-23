@extends('layout.admin')

@section('content')
<div class="pagetitle">
    <h1>Profile</h1>
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

                <!-- Profile Edit Form -->
                <form action="{{ route('admin.categorie.update',[ 'id' => request()->id ]) }}" method="POST">
                  <div class="row mb-3">
                    <label for="image" class="col-md-4 col-lg-3 col-form-label">Category Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="{{ asset('assets/question.png') }}" width="150px" height="150px" alt="Profile">
                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name of the Category</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="name" value="{{ $resource_info->name }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">description</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="description" class="form-control" id="description" style="height: 100px">{{ $resource_info->description }}</textarea>
                    </div>
                  </div>

                  @csrf
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection