@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">{{ __('Register') }}</div>

      <div class="card-body">
        <form method="POST" action="">
          @csrf

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ old('Name') }}</label>

            <div class="col-md-6">
              <input id="name" type="text" class="form-control is-invalid" name="name" value="" autocomplete="name" autofocus>
            <span class="invalid-feedback" role="alert">
              @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
              @endif
              </span>
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ old('E-Mail Address') }}</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control is-invalid" name="email" value="" autocomplete="email">
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ old('Direccion') }}</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control is-invalid" name="email" value="" autocomplete="email">
            </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ old('Password') }}</label>

            <div class="col-md-6">
              <input id="password" type="password" class="form-control is-invalid" name="password" autocomplete="new-password">
            </div>
          </div>

          <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ old('Confirm Password') }}</label>

            <div class="col-md-6">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
            </div>
          </div>

          <div class="form-group row">
            <label for="foto" class="col-md-4 col-form-label text-md-right">{{ old('Foto') }}</label>

            <div class="col-md-6">
              <input id="foto" type="file" class="form-control" name="foto">
            </div>
          </div>
          <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                {{ __('Pagar') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<a href="{{ url('/compra/resumen') }}" class="btn btn-secondary btn-lg float-left">Atras</a>
<a href="{{ url('/compra/confirmar') }}"  class="btn btn-primary btn-lg float-right">Siguiente</a>
<!--<a href="{{ url('/compra/confirmar') }}"  class="btn btn-primary btn-lg float-right">Siguiente</a>-->

<br><br>
@endsection