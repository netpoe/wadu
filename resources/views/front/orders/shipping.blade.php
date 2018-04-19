@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="front-orders-shipping">
  <form action="{{ $form->getOnPostActionString() }}" method="POST">
    @csrf
    <div class="container">
      <div class="row">
        <div class="col-6">
          <h1>Envío</h1>
        </div>
        <div class="col-6">
          <button type="submit" class="btn btn-primary">Continuar</a>
        </div>
      </div>
    </div>

    <div class="container-md">
      <h2>¿A dónde enviamos tu orden?</h2>
        @include('fields.hidden', ['field' => $form->getField('user_id')])
        @include('fields.select', ['field' => $form->getField('country_id')])
        @include('fields.select', ['field' => $form->getField('state_id')])
        @include('fields.text', ['field' => $form->getField('street')])
        @include('fields.text', ['field' => $form->getField('interior_number')])
        @include('fields.text', ['field' => $form->getField('city')])
        @include('fields.text', ['field' => $form->getField('neighborhood')])
        @include('fields.text', ['field' => $form->getField('zip_code')])
        @include('fields.textarea', ['field' => $form->getField('references')])
    </div>
  </form>
</section>

@endsection

    @push('footer-scripts')
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
