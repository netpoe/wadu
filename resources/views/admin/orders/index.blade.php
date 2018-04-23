@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-orders-index">
  <div class="container">
    <h1>Órdenes</h1>

    <admin-orders-tr ref="adminOrdersTr"></admin-orders-tr>
  </div>
</section>

@endsection

@push('footer-scripts')
  <script src="{{ asset('js/admin/orders/index.js') }}"></script>
  <script>
    (function(global){
      var adminOrdersTr = AdminOrdersIndex.$refs.adminOrdersTr;
      adminOrdersTr.$data.thead.user = "{{ __('User') }}";
      adminOrdersTr.$data.thead.status = "{{ __('Status') }}";
      adminOrdersTr.$data.thead.paymentType = "{{ __('Payment type') }}";
      adminOrdersTr.$data.thead.paymentStatus = "{{ __('Payment status') }}";
      adminOrdersTr.$data.thead.address = "{{ __('Address') }}";
      adminOrdersTr.$data.thead.products = "{{ __('Products') }}";
      adminOrdersTr.$data.orders = {!! $orders !!};

      console.log(adminOrdersTr.$data.orders);

      Echo.private('orders.' + {{ $orders->first()->business->id }})
          .listen('.index.orders.event', (data) => {
            console.log(data);
            adminOrdersTr.$data.orders = data.orders;
          });

    })(window)
  </script>
@endpush
