@extends('layouts.front')

@push('head-links')
  <link rel="stylesheet" href="{{ asset('css/front/orders/checkout.css') }}">
@endpush

@push('header-left')
  <span class="business-name">{{ $order->business->name }}</span>
@endpush

@section('content')

<section class="section hero" id="front-orders-checkout">
  <div class="follow-me-bar">
    <div class="container">
      <span>{{ __('Confirm your order') }}</span>
    </div>
  </div>
  <div class="container">
    <div class="address">
      <article class="card">
        <div class="card-body">
          <h5 class="card-title">{{ __("We'll send your order to") }}</h5>
          <p class="card-text">{{ $order->address->asString() }}</p>
          @isset($order->address->references)
            <h6 class="card-subtitle text-muted">Cómo llegar</h6>
            <p class="m-0">{{ $order->address->references }}</p>
          @endisset
        </div>
      </article>
    </div>
  </div>

  <div class="follow-me-bar">
    <div class="container">
      <span>{{ __('Products') }}</span>
    </div>
  </div>

  <div class="products">
    @foreach($orderProducts as $orderProduct)
      <article class="product">
        <div class="container">
          <div class="top">
            <div class="left">
              <h6 class="category">{{ $orderProduct->product->category->value }}</h6>
              <h5 class="name">{{ $orderProduct->product->info->name }}</h5>
              <div class="price-count">
                <span class="price">{{ $orderProduct->getPrice() }}</span>
                <span class="times"> x </span>
                <span class="count">{{ $orderProduct->amount }}</span>
              </div>
            </div>
          </div>
          <div class="bottom d-none">
            <p class="description">{{ $orderProduct->product->info->description }}</p>
          </div>
        </div>
      </article>
    @endforeach
  </div>

  <div class="follow-me-bar">
    <div class="container">
      <span>{{ __('Total') }}</span>
    </div>
  </div>

  <div class="container">
    <div class="total">
      <article class="card">
        <div class="card-body">
          <h6 class="category">{{ __('Subtotal') }}</h6>
          <p class="concept">{{ $order->getSubtotal()->toCurrency($order->defaultCurrencySymbol) }}</p>
          <h6 class="category">{{ __('Shipping') }}</h6>
          <p class="concept">{{ $order->getShippingCost()->toCurrency($order->defaultCurrencySymbol) }}</p>
          <h6 class="category">{{ __('Taxes') }}</h6>
          <p class="concept">{{ $order->getTaxes()->toCurrency($order->defaultCurrencySymbol) }}</p>
          <h6 class="category">{{ __('Total') }}</h6>
          <p class="concept">{{ $order->getTotal()->toCurrency($order->defaultCurrencySymbol) }}</p>
        </div>
      </article>
    </div>
  </div>

  <div class="follow-me-bar">
    <div class="container">
      <span>{{ __('Choose your payment type') }}</span>
    </div>
  </div>

  <div class="container">
    <div class="details">
      <article class="card">
        <div class="card-body">
          <form action="{{ route('front.orders.payment-type', ['order' => $order->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="payment_type_id" value="{{ $orderPaymentType::CASH }}">
            <input type="hidden" name="payment_status_id" value="{{ $orderPaymentStatus::PENDING }}">
            <button class="btn btn-lg btn-dark btn-block">Efectivo</button>
          </form>
          <hr>
          <button class="btn btn-lg btn-block btn-primary">Tarjeta</button>
          <div id="card-details">
            <form action="" method="POST">

            </form>
          </div>
        </div>
      </article>
    </div>
  </div>

</section>

@endsection
