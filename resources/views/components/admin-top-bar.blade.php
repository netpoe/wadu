<header class="top-menu">
  <div class="container">
    <div class="row">
      <div class="col top-menu-left">
        <div class="top-menu-item">
          <div><a href="{{ route('admin.orders.index') }}">{{ __('Orders') }}</a></div>
          <ul class="top-menu-dropdown">
            <li class="top-menu-sub-item"><a href="{{ route('admin.orders.new') }}">{{ __('New order') }}</a></li>
            <li class="top-menu-sub-item"><a href="{{ route('admin.orders.index') }}">{{ __('All orders') }}</a></li>
            <li class="top-menu-sub-item"><a href="{{ route('admin.orders.index') }}">{{ __('Ready for processing') }}</a></li>
            <li class="top-menu-sub-item"><a href="{{ route('admin.orders.index') }}">{{ __('Ready to ship') }}</a></li>
          </ul>
        </div>
        <div class="top-menu-item">
          <div><a href="{{ route('admin.menu.edit') }}">{{ __('Products') }}</a></div>
          <ul class="top-menu-dropdown">
            <li class="top-menu-sub-item"><a href="{{ route('front.menu.preview') }}">{{ __('Preview Products Menu') }}</a></li>
          </ul>
        </div>
      </div>

      <div class="col top-menu-right">
        <div class="top-menu-item">
          <div><a href="#">{{ __('Settings') }}</a></div>
          <ul class="top-menu-dropdown">
            <li class="top-menu-sub-item"><a href="{{ route('admin.business.users') }}">{{ __('Usuarios') }}</a></li>
          </ul>
        </div>
        <div class="top-menu-item">
          <div><a href="{{ route('logout') }}">{{ __('Logout') }}</a></div>
        </div>
      </div>
    </div>
  </div>
</header>
