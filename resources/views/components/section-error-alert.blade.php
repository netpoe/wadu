@if (session()->has('error'))
  <div class="ebm-alert ebm-alert-danger">
    <div class="alert-left"><i class="icon-notification-circle"></i></div>
    <div class="alert-right">
      <div class="alert-content">
        <h5>{{ session()->get('error') }}</h5>
      </div>
    </div>
  </div>
@endif
