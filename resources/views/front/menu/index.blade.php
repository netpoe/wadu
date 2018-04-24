@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/front/menu/index.css') }}">
@endpush

@section('content')

<section class="section hero" id="front-menu-index">
  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col header-left">

        </div>
        <div class="col header-center">
          <span class="business-name">{{ $business->name }}</span>
        </div>
        <div class="col header-right">
          <nav>
            <a href="{{ route('front.orders.shipping', ['order' => $order->id]) }}" class="btn btn-primary btn-sm"><i class="icon-chevron-right"></i></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <div class="container-md">
    @foreach ($productsByCategory as $name => $category)
      <h3>@if(strpos($name, 'z_') !== false) {{ __('other') }} @else {{ $name }} @endif</h3>
      @foreach ($category as $product)

        <article class="product">
          <div class="left">
            <h5>{{ $product->info->name }}</h5>
            <p>{{ $product->info->description }}</p>
            <small>{{ $product->price->value }}</small>
          </div>
          <div class="right">
            <form action="{{ route('front.orders.add', ['product' => $product->id, 'order' => $order->id]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-sm btn-primary"><i class="icon-plus-circle"></i></button>
            </form>
            <form action="{{ route('front.orders.subtract', ['product' => $product->id, 'order' => $order->id]) }}" method="POST">
              @csrf
              @if ($order->product($product) && $order->product($product)->amount)
                <button type="submit" class="btn btn-sm btn-default"><i class="icon-circle-minus"></i></button>
              @else
                <button type="submit" class="btn btn-sm btn-default disabled" disabled><i class="icon-circle-minus"></i></button>
              @endif
            </form>
            @if ($order->product($product))
              <span class="count">{{ $order->product($product)->amount }}</span>
            @else
              <span class="count">0</span>
            @endif
          </div>
        </article>
      @endforeach
    @endforeach
  </div>

</section>

@endsection
