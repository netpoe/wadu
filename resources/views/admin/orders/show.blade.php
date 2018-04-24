@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/index.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-orders-show">
  <admin-orders-show ref="adminOrdersShow"></admin-orders-show>
</section>

@endsection

@push('footer-scripts')
  <script src="{{ asset('js/admin/orders/show.js') }}"></script>
  <script>
    (function(global){
      var adminOrdersShow = AdminOrdersShow.$refs.adminOrdersShow;

      console.log({!! $order !!});
      adminOrdersShow.$data.order = {!! $order !!};

      adminOrdersShow.$data.routes.ordersIndex = "{{ route('admin.orders.index') }}";
      adminOrdersShow.$data.routes.ordersProcess = "{{ route('admin.orders.process', ['order' => $order]) }}";
      adminOrdersShow.$data.routes.ordersReadyToShip = "{{ route('admin.orders.ready-to-ship', ['order' => $order]) }}";
      adminOrdersShow.$data.routes.ordersShip = "{{ route('admin.orders.ship', ['order' => $order]) }}";

      adminOrdersShow.$data.messages.processedBy = "{{ __('This order is being processed by') }}";
      adminOrdersShow.$data.messages.processOrder = "{{ __('Process order') }}";
      adminOrdersShow.$data.messages.status = "{{ __('Status') }}";
      adminOrdersShow.$data.messages.paymentStatus = "{{ __('Payment status') }}";
      adminOrdersShow.$data.messages.paymentType = "{{ __('Payment type') }}";
      adminOrdersShow.$data.messages.readyToShip = "{{ __('Ready to ship') }}";
      adminOrdersShow.$data.messages.shipOrder = "{{ __('Ship order') }}";

      adminOrdersShow.$data.loaded = true;

      Echo.private('order.' + {{ $order->id }} + '.business.' + {{ $order->business->id }})
          .listen('.show.order.event', (data) => {
            console.log(data);
            adminOrdersShow.$data.order = data.order;
          });
    })(window);
  </script>
@endpush




