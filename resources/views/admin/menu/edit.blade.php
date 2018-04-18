@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-menu-edit">
  <div class="container">

    <h1>Editar Menú</h1>

  </div>

  <div class="container-fluid">
    <h2>Productos</h2>

    <form action="" method="POST" class="row no-gutters">
      <fieldset class="form-group col-2">
        <label for="name" class="sr-only">{{ __('Name') }}</label>
        <input type="text" name="name" class="form-control form-control-sm" placeholder="{{ __('Name') }}">
      </fieldset>
      <fieldset class="form-group col-2">
        <label for="price" class="sr-only">{{ __('Price') }}</label>
        <input type="text" name="price" class="form-control form-control-sm" placeholder="{{ __('Price') }}">
      </fieldset>
      <fieldset class="form-group col-2">
        <label for="discount" class="sr-only">{{ __('Discount') }}</label>
        <input type="text" name="discount" class="form-control form-control-sm" placeholder="{{ __('Discount') }}">
      </fieldset>
      <input type="submit" class="d-none">
    </form>

  </div>
</section>

@endsection
