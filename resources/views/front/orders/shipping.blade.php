@extends('layouts.front')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/front/orders/shipping.css') }}">
@endpush

@push('body')
  <form action="{{ $form->getOnPostActionString() }}" method="POST" novalidate>
  @csrf
@endpush

@push('header-left')
  <span class="business-name">{{ $order->business->name }}</span>
@endpush

@push('header-right')
  <nav>
    <span>{{ $order->getSubtotal()->toCurrency($order->defaultCurrencySymbol) }}</span>
    <button type="submit" class="btn btn-sm btn-primary"><i class="icon-chevron-right"></i></a>
  </nav>
@endpush

@section('content')
  <section class="section hero" id="front-orders-shipping">
    <div class="follow-me-bar">
      <div class="container">
        <span>{{ __('Add your shipping address') }}</span>
      </div>
    </div>
    <div class="container">
      <div class="fields">
        @include('fields.hidden', ['field' => $form->getField('user_id')])
        @include('fields.hidden', ['field' => $form->getField('country_id')])
        @include('fields.hidden', ['field' => $form->getField('state_id')])
        @include('fields.text', ['field' => $form->getField('street')])
        @include('fields.text', ['field' => $form->getField('interior_number')])
        @include('fields.hidden', ['field' => $form->getField('city')])
        @include('fields.text', ['field' => $form->getField('neighborhood')])
        @include('fields.text', ['field' => $form->getField('zip_code')])
        @include('fields.textarea', ['field' => $form->getField('references')])
      </div>
    </div>
  </section>
@endsection

@push('footer-scripts')
  </form>

  <script>
    (function(global){
      var $country = document.querySelector('#country_id');
      var $state = document.querySelector('#state_id');
      var states = {!! $addressStates !!};

      $country.onchange = function(){
        if (!this.value) return null;

        states[this.value].forEach(function(item, index){
          var option = new Option;
          option.value = item.id;
          option.text = item.name;
          $state.add(option);
        });
      }

    })(window);
  </script>
@endpush
