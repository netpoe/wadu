@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/index.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-business-users">
  <div class="container">
    <h1>Usuarios</h1>

    <form action="{{ route('admin.business.users.create') }}" method="POST" class="row no-gutters">
      @csrf
      <fieldset class="form-group col-4">
        <label for="email" class="sr-only">{{ __('Email') }}</label>
        <input type="text" name="email" class="form-control form-control-sm" placeholder="{{ __('Email') }}">
      </fieldset>
      <input type="submit" class="d-none">
    </form>
  </div>
</section>

@endsection
