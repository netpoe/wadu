@extends('layouts.front')

@push('head-links')
  <link rel="stylesheet" href="{{ asset('css/front/orders/pending.css') }}">
@endpush

@push('header-left')
  <span class="business-name">{{ $order->business->name }}</span>
@endpush

@section('content')

<section class="section hero" id="front-orders-pending">
  <div class="checkmark-title">
    <div class="container">
      <span class="checkmark"><i class="icon-checkmark-circle"></i></span>
      <h1>{{ __('Your order is in progress!') }}</h1>
    </div>
  </div>
  <div class="details">
    <div class="container">
      <article class="card">
        <div class="card-body">
          <p>{{ __('Please have the total ready') }}: <strong>{{ $order->getTotal()->toCurrency($order->defaultCurrencySymbol) }}</strong>, in <span class="text-uppercase">{{ __($order->paymentType->description) }}</span> {{ __('when your order arrives at your location.') }}</p>
          <a href="{{ route('front.orders.checkout', ['order' => $order->id]) }}" class="btn btn-block btn-secondary">{{ __('Review my order') }}</a>
        </div>
      </article>
    </div>
  </div>

</section>

@endsection
