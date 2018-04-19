@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="front-menu-index">
  <div class="container">

    <h1>Menú</h1>
    <h2>{{ $business->name }}</h2>

  </div>

  <div class="container-md">
    @foreach ($products as $product)

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
              @if ($order->fromProduct($product) && $order->fromProduct($product)->amount)
                <button type="submit" class="btn btn-sm btn-default"><i class="icon-circle-minus"></i></button>
              @else
                <button type="submit" class="btn btn-sm btn-default disabled" disabled><i class="icon-circle-minus"></i></button>
              @endif
            </form>
            @if ($order->fromProduct($product))
              <span class="count">{{ $order->fromProduct($product)->amount }}</span>
            @else
              <span class="count">0</span>
            @endif
          </div>
        </article>

    @endforeach
  </div>

</section>

@endsection
