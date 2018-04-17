@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-orders-new">
  <div class="container-sm">
    <form method="POST" action="{{ $form->getOnPostActionString() }}">
      @csrf

      @include('fields/text', ['field' => $form->getField('whatsapp')])

      <fieldset class="form-group text-right">
        <button type="submit" class="btn btn-primary btn-lg">Crear Orden</button>
      </fieldset>

    </form>

    @include('components.section-error-alert')
  </div>
</section>

@endsection
