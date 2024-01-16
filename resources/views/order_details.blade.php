@extends('layout')
@section('title')
    Zay - Order Details
@endsection
@section('content')
  <div class="container mt-3 mt-md-5">
    <h5 class="text-charcoal hidden-md-up">Order - {{ $order->order_id }}</h5>
    <div class="row">
      <div class="col-12">
        <div class="list-group mb-5">
          <div class="list-group-item p-3 bg-snow" style="position: relative;">
            <div class="row w-100 no-gutters">
              <div class="col-6 col-md">
                <h6 class="text-charcoal mb-0 w-100">Date</h6>
                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{ $order->created_at }}</p>  
              </div>
              <div class="col-6 col-md"> 
                <h6 class="text-charcoal mb-0 w-100">Total</h6>
                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">${{ $order->total_amount }}</p> 
              </div>
              <div class="col-6 col-md"> 
                <h6 class="text-charcoal mb-0 w-100">Status</h6>
                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{ $order->status }}</p> 
              </div>
            </div>
          </div>
          <h6 class="mt-3">Order Items</h6>
          <div class="list-group-item p-3 bg-white">
            <div class="row no-gutters">
              <table class="table">
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Sub-total</th>
                    </tr>
                </thead>
                <tbody id="orderItemsTableBody">
                  @foreach($order->orderItems as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price }}</td>
                    <td>${{ $item->quantity * $item->price }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection