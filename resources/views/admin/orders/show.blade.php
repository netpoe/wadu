@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/index.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-orders-index">
  <div class="container">
    <h1><a href="{{ route('admin.orders.index') }}"><i class="icon-chevron-left"></i></a> Orden {{ $order->id }}</h1>
  </div>
</section>

@endsection
