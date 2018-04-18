@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-orders-new">
  <div class="container-sm">

    <nav>
      <a href="{{ $greet }}" class="btn btn-lg btn-primary btn-block" target="_blank">Enviar menú al cliente</a>
    </nav>
    <a href="{{ route('admin.orders.new') }}">Crear nueva orden</a>

  </div>
</section>

@endsection
