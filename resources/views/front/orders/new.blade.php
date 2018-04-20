@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="front-orders-new">
  <div class="container">
    <h1>Lo sentimos</h1>
    <h2>Ese menú ya no está disponible.</h2>
    <a href="#" class="btn btn-block btn-lg btn-primary">Ver nuevo menú</a>
  </div>
</section>

@endsection
