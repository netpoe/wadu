@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-menu-index">
  <div class="container">

    <h1>Menú</h1>
    <a href="{{ route('admin.menu.edit') }}" class="btn btn-primary">Editar menú</a>

  </div>
</section>

@endsection
