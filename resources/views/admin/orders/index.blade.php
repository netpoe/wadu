@extends('layouts.admin')

@push('head-links')
{{-- {{ asset('js/admin/orders/index.js') }} --}}
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-orders-index">
  <div class="container">
    <h1>Órdenes</h1>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>{{ __('User') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Payment type') }}</th>
            <th>{{ __('Payment status') }}</th>
            <th>{{ __('Address') }}</th>
            <th>{{ __('Products') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td>{{ $order->user->contact->whatsapp }}</td>
              <td>{{ __($order->status->description) }}</td>
              <td>@isset($order->paymentType){{ __($order->paymentType->description) }}@endisset</td>
              <td>@isset($order->paymentStatus){{ __($order->paymentStatus->description) }}@endisset</td>
              <td>@isset($order->address){{ __($order->address->asString()) }}@endisset</td>
              <td>
                @foreach($order->products as $orderProduct)
                  <p>{{ $orderProduct->product->info->name }}</p>
                @endforeach
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

@endsection

@push('footer-scripts')
  <script src="{{ asset('js/admin/orders/index.js') }}"></script>
  <script>
    (function(global){
      Echo.private('order.' + {{ $order->business->id }})
          .listen('.order.created', (e) => {
            console.log(e);
          });
      // Echo.join('orders.' + {!! $order->business->id !!})
      //   .here((order) => {
      //     console.log(order);
      //   })
      //   .joining((order) => {
      //     console.log(order);
      //   })
      //   .leaving((order) => {
      //     console.log(order);
      //   });
    })(window)
  </script>
@endpush
