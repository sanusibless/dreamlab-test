@extends('layout')
   @section('title')
   Carts - Zay
   @endsection
   @section('content')
   	<section class="h-100" style="background-color: #eee;">
  	<div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
          @if(count($carts) > 0)
          <form action="{{ route('cart-clear', ['user' => auth()->user()->id ]) }}" method="POST" >
                  @csrf
                  @method('DELETE')
                  <button title="Clear Your Cart" type="submit" name="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
          </form>
          @endif
        </div>
        @forelse($carts as $cart)
        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="{{ url('assets/img/'. $cart['image'] .'.jpg') }}"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">{{ $cart['product_name'] }}</p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <form action="{{ route('cart-decrease', ['cart' => $cart['id']]) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <button title="" type="submit" name="submit">
                  <i class="fas fa-minus"></i>
                  </button>
                </form>
                <input id="form1" min="1" name="quantity" value="{{ $cart['quantity'] }}" type="number"
                  class="form-control form-control-sm" />

                <form action="{{ route('cart-increase', ['cart' => $cart['id']]) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <button title="" type="submit" name="submit">
                    <i class="fas fa-plus"></i>
                  </button>
                </form>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">${{ $cart['price'] }}</h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end text-small">
                <a href="{{ route('remove-item', ['cart' => $cart['id'] ]) }}" class="btn-sm btn-danger" data-confirm-delete="true" method="POST">
                 <i class="fas fa-trash fa-sm"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        @empty
           <div class="card rounded-3 mb-4">
            <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <p class="card-text text-center">No items yet</p>
            </div>
          </div>
        </div>
        @endforelse
        @if(count($carts) > 0)
          <div class="card">
            <div class="card-body mx-auto">
              <a href="{{ route('checkout') }}" class="btn btn-warning btn-block btn-lg">Proceed to Pay</a>
            </div>
          </div>
        @endif

      </div>
    </div>
  </div>
</section>
   @endsection