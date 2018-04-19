@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="front-orders-checkout">
  <div class="container">
    <h1>Checkout</h1>
    <p>Enviaremos tu pedido a:
      {{ $order->address->street }}, {{ $order->address->interior_number }}.<br>
      {{ $order->address->city }}, {{ $order->address->state->name }} - {{ $order->address->country->name }}<br>
      CP: {{ $order->address->zip_code }}<br>
      Referencias: {{ $order->address->references }}
    </p>

    @foreach($order->products as $product)
      <article class="product">
        <h5>{{ $product->info->name }}</h5>
        <p>{{ $product->info->description }}</p>
        <small>{{ $product->price->value }}</small>
      </article>
    @endforeach
  </div>

  <div class="container-sm">
    <h2>Elige tu medio de pago</h2>
    <a href="#" class="btn btn-lg btn-dark btn-block">Efectivo</a>
    <hr>
    <button class="btn btn-lg btn-block btn-primary">Tarjeta</button>
    <div id="card-details">
      <form action="" method="POST">

      </form>
    </div>
  </div>

</section>

@endsection
