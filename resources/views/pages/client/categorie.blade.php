@extends('layout.master')

@section('content')
<main class="portfolio-grid-page">
    <div class="container">
        <h1 class="oleez-page-title">All Categories</h1>
        <div class="row">
            @foreach ($all_categories as $categorie)
                    <div class="col-md-4 portfolio-card wow fadeInUp">
                        <a href="{{ route('client.products',['categorie' => $categorie->id]) }}" style="text-decoration:none;color:inherit;">
                        <div class="project-thumbnail-wrapper">
                            <img src="{{ asset('assets/client/images/Standard_list_blog/Standard_9@2x.jpg') }}" alt="portffolio" class="project-thumbnail">
                        </div>
                        <h5 class="project-name">{{ $categorie->name }}</h5>
                        <p class="project-category">{{ $categorie->description }}</p>
                        </a>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</main>
@endsection