@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-orders-index">
  <div class="container">
    <h1>Órdenes</h1>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>{{ __('User') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Payment type') }}</th>
            <th>{{ __('Address') }}</th>
            <th>{{ __('Products') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td>{{ $order->user->contact->whatsapp }}</td>
              <td>{{ __($order->status->description) }}</td>
              <td>{{ __($order->paymentType->description) }}</td>
              <td>{{ __($order->address->asString()) }}</td>
              <td>
                @foreach($order->products as $orderProduct)
                  <p>{{ $orderProduct->product->info->name }}</p>
                @endforeach
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

@endsection
