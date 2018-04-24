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
          <span class="business-name">{{ $business->name }}</span>
        </div>
        <div class="col header-right">
          <nav>
            <span>{{ $order->getProductsTotal() }}</span>
            <a href="{{ route('front.orders.shipping', ['order' => $order->id]) }}" class="btn btn-primary btn-sm"><i class="icon-chevron-right"></i></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  @foreach ($productsByCategory as $name => $category)
    <div class="follow-me-bar">
      <div class="container">
        <span class="product-category-title">@if(strpos($name, 'z_') !== false) {{ __('other') }} @else {{ $name }} @endif</span>
      </div>
    </div>
    @foreach ($category as $product)
      <article class="product">
        <div class="container">
          <div class="top">
            <div class="row">
              <div class="col-8 left">
                <h5 class="name">{{ $product->info->name }}</h5>
                <span class="price">{{ $product->getPrice() }}</span>
                <span> x </span>
                <span class="count">@if($order->product($product)){{ $order->product($product)->amount }}@else 0 @endif</span>
              </div>
              <div class="col-4 right">
                <div class="row no-gutters text-right">
                  <div class="col-6">
                    <form action="{{ route('front.orders.subtract', ['product' => $product->id, 'order' => $order->id]) }}" method="POST">
                      @csrf
                      @if ($order->product($product) && $order->product($product)->amount)
                        <button type="submit" class="btn btn-sm btn-default"><i class="icon-circle-minus"></i></button>
                      @else
                        <button type="submit" class="btn btn-sm btn-default disabled" disabled><i class="icon-circle-minus"></i></button>
                      @endif
                    </form>
                  </div>
                  <div class="col-6">
                    <form action="{{ route('front.orders.add', ['product' => $product->id, 'order' => $order->id]) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-dark"><i class="icon-plus-circle"></i></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="bottom" style="display: none">
            <p class="description">{{ $product->info->description }}</p>
          </div>
        </div>
      </article>
    @endforeach
  @endforeach

</section>

@endsection

@push('footer-scripts')
  <script src="{{ asset('js/front/menu/index.js') }}"></script>
@endpush
