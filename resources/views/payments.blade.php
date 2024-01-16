@extends('layout')
@section('title')
    Zay - Payments
@endsection
@section('content')
  <div class="container mt-3 mt-md-5">
    <h5 class="text-charcoal hidden-md-up">All Payments</h5>
    <div class="row">
      <div class="col-12">
        <div class="list-group mb-5">
          <div class="list-group-item p-3 bg-snow" style="position: relative;">
            <div class="d-flex w-100 no-gutters justify-contents-around">
              <div class="col-6 col-md"> 
                <h6 class="text-charcoal mb-0 w-100">Total Amount</h6>
                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">${{ $payments['total']  }}</p> 
              </div>
              <div class="col-6 col-md"> 
                <h6 class="text-charcoal mb-0 w-100">Transaction Volume</h6>
                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{ $payments['volume']  }}</p> 
              </div>
            </div>
          </div>
          <div class="list-group-item p-3 bg-white">
            <div class="row no-gutters">
              <table class="table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Order ID</th>
                        <th>Payment Reference</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody id="orderItemsTableBody">
                  @foreach($payments['records'] as $record)
                  <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->order_id }}</td>
                    <td>{{ $record->reference}}</td>
                    <td>${{ $record->amount }}</td>
                    <td class="{{ $record->status == 'success' ? 'text-success' : 'text-secondary' }}">{{ $record->status }}</td>
                    <td>{{ explode(' ',$record->created_at)[0] }}</td>
                    <td>{{ explode(' ',$record->created_at)[1] }}</td>
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