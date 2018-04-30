@extends('layouts.admin')

@push('head-links')
  <link rel="stylesheet" href="{{ asset('css/admin/orders/index.css') }}">
@endpush

@push('header-left')
  <span class="business-name">{{ $business->name }}</span>
@endpush

@push('sub-header-left')
  <h1 class="page-title">{{ __('Orders') }}</h1>
@endpush

@push('sub-header-menu')
  <nav>
    <span class="active">{{ __('All orders') }}</span>
    <span>{{ __('Ready for processing') }}</span>
    <span>{{ __('Shipped') }}</span>
  </nav>
@endpush

@section('content')

<section class="section hero" id="admin-orders-index">
  <div class="container">
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

      adminOrdersTr.$data.messages.order = "{{ __('Order') }}";
      adminOrdersTr.$data.messages.actions = "{{ __('Actions') }}";
      adminOrdersTr.$data.messages.user = "{{ __('User') }}";
      adminOrdersTr.$data.messages.status = "{{ __('Status') }}";
      adminOrdersTr.$data.messages.paymentType = "{{ __('Payment type') }}";
      adminOrdersTr.$data.messages.paymentStatus = "{{ __('Payment status') }}";
      adminOrdersTr.$data.messages.address = "{{ __('Address') }}";
      adminOrdersTr.$data.messages.products = "{{ __('Products') }}";
      adminOrdersTr.$data.messages.processedBy = "{{ __('Processed by') }}";

      adminOrdersTr.$data.messages.seeOrder = "{{ __('See order') }}";
      adminOrdersTr.$data.messages.processOrder = "{{ __('Process order') }}";
      adminOrdersTr.$data.messages.shipOrder = "{{ __('Ship order') }}";

      adminOrdersTr.$data.orderStatus = {!! $orders->first()->status->asObjectByValue() !!};

      adminOrdersTr.$data.orders = {!! $orders !!};

      Echo.private('orders.' + {{ $orders->first()->business->id }})
          .listen('.index.orders.event', (data) => {
            console.log(data);
            // adminOrdersTr.$data.orders = data.orders;

            getOrders();
          });

      function getOrders(){
        axios.get("{{ route('api.orders.index') }}", {}).then(function(response){
          console.log(response);
          adminOrdersTr.$data.orders = response.data;
        }).catch(function(error){
          console.log(error);
        });
      }

    })(window)
  </script>
@endpush
