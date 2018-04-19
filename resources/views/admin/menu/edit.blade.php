@extends('layouts.admin')

@push('head-links')
<link rel="stylesheet" href="{{ asset('css/admin/orders/new.css') }}">
@endpush

@section('content')

<section class="section hero" id="admin-menu-edit">
  <div class="container">

    <h1>Editar Menú</h1>

  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-9">
        <h2>Productos</h2>

        <form action="{{ route('admin.products.create') }}" method="POST" class="row no-gutters">
          @csrf
          <fieldset class="form-group col">
            <label for="name" class="sr-only">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control form-control-sm" placeholder="{{ __('Name') }}">
          </fieldset>
          <fieldset class="form-group col">
            <label for="price" class="sr-only">{{ __('Price') }}</label>
            <input type="text" name="price" class="form-control form-control-sm" placeholder="{{ __('Price') }}">
          </fieldset>
          <fieldset class="form-group col">
            <label for="discount" class="sr-only">{{ __('Discount') }}</label>
            <input type="text" name="discount" class="form-control form-control-sm" placeholder="{{ __('Discount') }}">
          </fieldset>
          <fieldset class="form-group col">
              <label for="product_category_id" class="sr-only">{{ __('Discount') }}</label>
              <select name="product_category_id" id="" class="form-control form-control-sm">
                @foreach ($productCategories as $category)
                  <option value="{{ $category->id }}">{{ $category->value }}</option>
                @endforeach
              </select>
            </fieldset>
          <input type="submit" class="d-none">
        </form>

        @foreach ($products as $product)
          <form action="{{ route('admin.products.update', ['id' => $product->id]) }}" method="POST" class="row no-gutters">
            @csrf
            <fieldset class="form-group col">
              <label for="name" class="sr-only">{{ __('Name') }}</label>
              <input value="{{ $product->info->name }}" type="text" name="name" class="form-control form-control-sm" placeholder="{{ __('Name') }}">
            </fieldset>
            <fieldset class="form-group col">
              <label for="price" class="sr-only">{{ __('Price') }}</label>
              <input value="{{ $product->price->value }}" type="text" name="price" class="form-control form-control-sm" placeholder="{{ __('Price') }}">
            </fieldset>
            <fieldset class="form-group col">
              <label for="discount" class="sr-only">{{ __('Discount') }}</label>
              <input value="{{ $product->price->discount }}" type="text" name="discount" class="form-control form-control-sm" placeholder="{{ __('Discount') }}">
            </fieldset>
            <fieldset class="form-group col">
              <label for="product_category_id" class="sr-only">{{ __('Discount') }}</label>
              <select name="product_category_id" id="" class="form-control form-control-sm">
                @foreach ($productCategories as $category)
                  <option value="{{ $category->id }}" @if($category->id === $product->product_category_id) selected="selected" @endif>{{ $category->value }}</option>
                @endforeach
              </select>
            </fieldset>
            <input type="submit" class="d-none">
          </form>
        @endforeach
      </div>
      <div class="col-3">
        <h3>Categorías de producto</h3>
        <form action="{{ route('admin.product-categories.create') }}" method="POST">
          @csrf
          <fieldset class="form-group">
            <label for="product_category" class="sr-only">{{ __('New product category') }}</label>
            <input type="text" name="product_category" class="form-control form-control-sm" placeholder="{{ __('New product category') }}">
          </fieldset>
          <input type="submit" class="d-none">
        </form>
        @foreach ($productCategories as $category)
          <form action="{{ route('admin.product-categories.update', ['id' => $category->id]) }}" method="POST">
            @csrf
            <fieldset class="form-group">
              <label for="product_category" class="sr-only">{{ __('Product category') }}</label>
              <input value="{{ $category->value }}" type="text" name="product_category" class="form-control form-control-sm">
            </fieldset>
            <input type="submit" class="d-none">
          </form>
        @endforeach
      </div>
    </div>

  </div>
</section>

@endsection
