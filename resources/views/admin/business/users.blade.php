@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/index.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-business-users">
  <div class="container">
    <h1>Usuarios</h1>

    <form action="{{ route('admin.business.users.create') }}" method="POST" class="row no-gutters">
      @csrf
      <fieldset class="form-group col">
        <label for="email" class="sr-only">{{ __('Email') }}</label>
        <input type="text" name="email" class="form-control form-control-sm" placeholder="{{ __('Email') }}">
      </fieldset>
      <fieldset class="form-group col">
        <label for="first_name" class="sr-only">{{ __('Name') }}</label>
        <input type="text" name="first_name" class="form-control form-control-sm" placeholder="{{ __('Name') }}">
      </fieldset>
      <fieldset class="form-group col">
        <label for="last_name" class="sr-only">{{ __('Last name') }}</label>
        <input type="text" name="last_name" class="form-control form-control-sm" placeholder="{{ __('Last name') }}">
      </fieldset>
      <input type="submit" class="d-none">
    </form>

    @foreach ($business->users as $user)
      <form action="{{ route('admin.business.users.update', ['user' => $user->id]) }}" method="POST" class="row no-gutters">
        @csrf
        <fieldset class="form-group col">
          <label for="email" class="sr-only">{{ __('Email') }}</label>
          <input value="{{ $user->email }}" type="text" name="email" class="form-control form-control-sm" placeholder="{{ __('Email') }}">
        </fieldset>
        <fieldset class="form-group col">
          <label for="first_name" class="sr-only">{{ __('Name') }}</label>
          <input value="{{ $user->email }}" type="text" name="first_name" class="form-control form-control-sm">
        </fieldset>
        <fieldset class="form-group col">
          <label for="last_name" class="sr-only">{{ __('Last name') }}</label>
          <input value="{{ $user->email }}" type="text" name="last_name" class="form-control form-control-sm">
        </fieldset>
        <fieldset class="form-group col">
          <label for="role_id" class="sr-only">{{ __('Role') }}</label>
          <input value="{{ __($user->role->value) }}" type="text" name="role_id" class="form-control form-control-sm" disabled>
        </fieldset>
        <input type="submit" class="d-none">
      </form>
    @endforeach
  </div>
</section>

@endsection
