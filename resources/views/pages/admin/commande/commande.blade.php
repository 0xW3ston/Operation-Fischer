@extends('layout.admin')

@section('content')
<div class="pagetitle">
    <h1>Commandes</h1>
    {{-- <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav> --}}
</div><!-- End Page Title -->

<script>
    const cartData = {};
    let cartArticles = [];
    @foreach ($paginator->items() as $cart)
        cartArticles = [];
        @foreach ($cart->cartArticles as $cartArticle)
            cartArticles.push({
                "id": {{ $loop->parent->index * $loop->count + $loop->index }},
                "name": "{{ $cartArticle->article->name }}",
                "price": "{{ $cartArticle->article->price }}",
                "quantity": "{{ $cartArticle->quantity }}",
                "total_price": "{{ $cartArticle->quantity * $cartArticle->article->price }}" 
            });
        @endforeach
        cartData[{{ $cart->id }}] = cartArticles;
    @endforeach
</script>

<section class="section profile">
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body pt-3">
                    <h5 class="card-title">List of Commandes:</h5>
                    <div class="container mt-4">
                        {{-- <div class="input-group mb-3">
                            <form action="{{ route('admin.commande.all') }}" method="GET" class="d-flex">
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
                        </div> --}}
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Le</th>
                                    <th scope="col">by User</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paginator->items() as $cart)
                                <tr>
                                    <th scope="row">{{ $cart->id }}</th>
                                    <td>{{ $cart->created_at }}</td>
                                    <td>{{ $cart->user->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-item="{{ $cart->id }}">
                                            View Details
                                        </button>
                                    </td>
                                    <td>
                                        <h4><span class="badge bg-{{ ($cart->status == 'validated') ? 'success': 'warning'}}">{{ $cart->status }}</span></h4>
                                    </td>
                                </tr>
                                <!-- End Modal -->
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            {{ $paginator->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cart Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="itemDetails">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Article</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Content will be dynamically added here with JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-success btn-sm" id="validateButton">
                    <i class="bi bi-check-circle-fill"></i> Validate
                </a>
                <a href="" class="btn btn-danger btn-sm" id="invalidateButton">
                    <i class="bi bi-x-circle-fill"></i> Invalidate
                </a>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        var validateButton = document.getElementById('validateButton');
        var invalidateButton = document.getElementById('invalidateButton')

        var popoverTriggers = document.querySelectorAll('.btn-primary');
        popoverTriggers.forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                var cartID = this.getAttribute('data-item');
                var cartArticles = JSON.parse(JSON.stringify(cartData[cartID]));
                console.log(cartArticles);
                var tableBody = document.getElementById('itemDetails').querySelector('tbody');
                tableBody.innerHTML = '';

                cartArticles.forEach(function (cartArticle) {
                    var row = document.createElement('tr');

                    var articleCell = document.createElement('td');
                    articleCell.textContent = cartArticle.name;
                    row.appendChild(articleCell);

                    var quantityCell = document.createElement('td');
                    quantityCell.textContent = cartArticle.quantity;
                    row.appendChild(quantityCell);

                    var totalPriceCell = document.createElement('td');
                    totalPriceCell.textContent = cartArticle.total_price + " DH";
                    row.appendChild(totalPriceCell);

                    tableBody.appendChild(row);
                });

                validateButton.href = "/admin/commande/validate/" + cartID;
                invalidateButton.href = "/admin/commande/delete/" + cartID;

                myModal.show();
            });
        });

        validateButton.addEventListener('click', function () {
            myModal.hide();
        });
    });
</script>



@endsection
