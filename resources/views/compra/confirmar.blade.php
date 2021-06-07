@extends('layouts.app')

@section('content')
@php
$total=0
@endphp
@foreach ($products as $product)
@php
$total+=$product->price
@endphp
@endforeach
<div class="row">

  <div class="col-lg-3">

    <h1 class="my-4">Lego Shop</h1>
    <ul class="list-group">
      <li class="list-group-item">
      Total de productos: {{sizeof($products)}}</li>
      <li class="list-group-item">
      Precio total de productos: {{$total}}</li>
    </ul>

  

  </div>
  <!-- /.col-lg-3 -->

  <div class="col-lg-9">
  <div class="card">
      <div class="card-header">{{ __('Datos de envio') }}</div>

      <div class="card-body">
        <ul>
        <li><img src="{{ asset('img/users/'.$shipping->image) }}" ></li>
        @foreach($shipping as $key=>$info)
        <li>{{$key}} {{$info}}</li>
        @endforeach

        </ul>
      </div>
    </div>

  </div>
  <!-- /.col-lg-9 -->
</div>

<a href="{{ url('/compra/envio') }}" class="btn btn-secondary btn-lg float-left">Atras</a>
<a href="#"  class="btn btn-primary btn-lg float-right">Comprar</a>
<br><br>
@endsection