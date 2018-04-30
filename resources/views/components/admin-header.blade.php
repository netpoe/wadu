<header class="header">
  <div class="container">
    <div class="row">
      <div class="col header-left">
        @stack('header-left')
      </div>
      <div class="col header-right">
        <nav>
          <a href="{{ route('admin.orders.new') }}" class="btn btn-primary">{{ __('New order') }}</a>
        </nav>
        @stack('header-right')
      </div>
    </div>
  </div>
</header>
