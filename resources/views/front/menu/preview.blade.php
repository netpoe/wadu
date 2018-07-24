@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/front/menu/preview.css') }}">
@endpush

@push('header-left')
  <span class="business-name">{{ $business->name }}</span>
@endpush

@section('content')

<section class="section hero" id="front-menu-index">
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
              </div>
            </div>
          </div>
          <div class="bottom d-none">
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
