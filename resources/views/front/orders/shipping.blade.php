@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="front-orders-shipping">
  <div class="container">

    <div class="row">
      <div class="col-6">
        <h1>Envío</h1>
      </div>
      <div class="col-6">
        <a href="{{ route('front.orders.shipping', ['order' => $order->id]) }}" class="btn btn-primary">Continuar</a>
      </div>
    </div>

  </div>

  <div class="container-md">
    <h2>¿A dónde enviamos tu orden?</h2>

  </div>

</section>

@endsection
