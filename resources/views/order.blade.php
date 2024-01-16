@extends('layout')
@section('title')
    Zay - Order
@endsection
@section('content')
  <div class="container mt-3 mt-md-5">
    <h5 class="text-charcoal hidden-md-up">Your Orders</h5>
    <div class="row">
      <div class="col-12">
        <div class="list-group mb-5">
          <div class="list-group-item p-3 bg-snow" style="position: relative;">
            @forelse ($orders as $order)
            <div class="row w-100 no-gutters mb-3">
                <div class="col-6 col-md">
                  <h6 class="text-charcoal mb-0 w-100">Order Number</h6>
                  <a href="{{ route('view-order', ['order' => $order->order_id ]) }}" class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{ $order->order_id }}</a>
                </div>
                <div class="col-6 col-md">
                  <h6 class="text-charcoal mb-0 w-100">Date</h6>
                  <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{ explode(' ',$order->created_at)[0] }}</p>  
                </div>
                <div class="col-6 col-md">
                    <h6 class="text-charcoal mb-0 w-100">Time</h6>
                    <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{ explode(' ',$order->created_at)[1] }}</p>  
                  </div>
                <div class="col-6 col-md"> 
                  <h6 class="text-charcoal mb-0 w-100">Total</h6>
                  <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">&dollar;{{ $order->total_amount }}</p> 
                </div>
                <div class="col-6 col-md"> 
                  <h6 class="text-charcoal mb-0 w-100">Status</h6>
                  <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{ $order->status }}</p> 
                </div>
              </div>
            @empty
            <div class="row w-100 no-gutters">
                <p class="text-center">No Orders</p>
            </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection