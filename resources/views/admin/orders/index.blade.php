@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/index.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-orders-index">
  <div class="container">
    <h1>Órdenes</h1>
    {{-- <h2>Mostrando órdenes listas para procesarse</h2> --}}
    <span>Mostrar órdenes:</span>
    <nav>
      <a href="#" class="btn btn-sm btn-light">{{ __('All orders') }}</a>
      <a href="#" class="btn btn-sm btn-light">{{ __('Ready for processing') }}</a>
    </nav>

    <admin-orders-tr ref="adminOrdersTr"></admin-orders-tr>
  </div>
</section>

@endsection

@push('footer-scripts')
  <script src="{{ asset('js/admin/orders/index.js') }}"></script>
  <script>
    (function(global){
      var adminOrdersTr = AdminOrdersIndex.$refs.adminOrdersTr;
      console.log({!! $orders !!});

      adminOrdersTr.$data.thead.user = "{{ __('User') }}";
      adminOrdersTr.$data.thead.status = "{{ __('Status') }}";
      adminOrdersTr.$data.thead.paymentType = "{{ __('Payment type') }}";
      adminOrdersTr.$data.thead.paymentStatus = "{{ __('Payment status') }}";
      adminOrdersTr.$data.thead.address = "{{ __('Address') }}";
      adminOrdersTr.$data.thead.products = "{{ __('Products') }}";
      adminOrdersTr.$data.thead.processedBy = "{{ __('Processed by') }}";

      adminOrdersTr.$data.tbody.seeOrder = "{{ __('See order') }}";
      adminOrdersTr.$data.tbody.processOrder = "{{ __('Process order') }}";

      adminOrdersTr.$data.orders = {!! $orders !!};

      Echo.private('orders.' + {{ $orders->first()->business->id }})
          .listen('.index.orders.event', (data) => {
            console.log(data);
            adminOrdersTr.$data.orders = data.orders;
          });

    })(window)
  </script>
@endpush
