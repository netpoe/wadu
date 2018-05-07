@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@push('header-left')
  <span class="business-name">{{ $business->name }}</span>
@endpush

@push('sub-header-left')
  <h1 class="page-title">{{ __('New order') }}</h1>
@endpush

@section('content')

<section class="section hero" id="admin-orders-new">
  <div class="container-sm">
    <form method="POST" action="{{ $form->getOnPostActionString() }}">
      @csrf

      @include('fields/text', [
        'field' => $form->getField('whatsapp'),
        'autofocus' => true
        ])

      <fieldset class="form-group text-right">
        <button type="submit" class="btn btn-primary btn-lg">{{ __('Create order') }}</button>
      </fieldset>

    </form>

    @include('components.section-error-alert')
  </div>
</section>

@endsection
