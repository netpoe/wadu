@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/index.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-orders-index">
  <div class="container">
    <h1><a href="{{ route('admin.orders.index') }}"><i class="icon-chevron-left"></i></a> Orden {{ $order->id }}</h1>
    @if ($order->processor->info->first_name)
      <h2>{{ __('This order is being processed by') }}: {{ $order->processor->info->fullName() }}</h2>
    @else
      <h2>{{ __('This order is being processed by') }}: {{ $order->processor->email }}</h2>
    @endif

    <div class="row">
      <div class="col-sm-9"></div>
      <div class="col-sm-3">
        <a href="{{ route('admin.orders.process', ['order' => $order]) }}" class="btn btn-block btn-primary">{{ __('Process order') }}</a>
        <a href="{{ route('admin.orders.ship', ['order' => $order]) }}" class="btn btn-block btn-success">{{ __('Ship order') }}</a>
      </div>
    </div>
  </div>
</section>

@endsection
