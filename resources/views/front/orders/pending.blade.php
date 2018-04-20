@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="front-orders-checkout">
  <div class="container">
    <h1>Todo listo</h1>
    <p>Enviaremos tu pedido a:
      {{ $order->address->street }}, {{ $order->address->interior_number }}.<br>
      {{ $order->address->city }}, {{ $order->address->state->name }} - {{ $order->address->country->name }}<br>
      CP: {{ $order->address->zip_code }}<br>
      Referencias: {{ $order->address->references }}
    </p>

    <p>Con este medio de pago: {{ __($order->paymentType->description) }}</p>
    <p>Status: {{ __($order->status->description) }}</p>

    @foreach($order->products as $orderProduct)
      <article class="product">
        <h5>{{ $orderProduct->amount }} {{ $orderProduct->product->info->name }}</h5>
        <p>{{ $orderProduct->product->info->description }}</p>
        <small>{{ $orderProduct->getPrice() }}</small>
      </article>
    @endforeach
  </div>

</section>

@endsection
