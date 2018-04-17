@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-orders-new">
  <div class="container-sm">
    <form action="POST">
      @csrf

      <fieldset class="form-group">
        <label for="whatsapp" class="sr-only">WA Number</label>
        <input type="text" name="whatsapp" class="form-control form-control-lg" placeholder="whatsapp: 502 123 45 67">
      </fieldset>
    </form>
  </div>
</section>

@endsection
