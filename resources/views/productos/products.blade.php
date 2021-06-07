@extends((Request::ajax()) ? 'layouts.ajax' : 'layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-3">

    <h1 class="my-4">Lego Shop</h1>
    <div class="list-group">
      @foreach ($filters->category as $key=>$category)
      <a href="{{url('category', [$key])}}" class="list-group-item">{{$category}}</a>
      @endforeach
    </div>

    <form method="POST" action={{ action('ProductController@rating') }}>
      <input type="hidden" name="category" value="{{Request()->id}}">
      {{ csrf_field() }}
      <div class="form-group">
        @foreach ($filters->stars as $key=>$star)
        <div class="form-check">
          <input name="stars[]" class="form-check-input" type="checkbox" value="{{$key}}" id="defaultCheck_{{$key}}">
          <label class="form-check-label" for="defaultCheck_{{$key}}">
            {{$star}}
          </label>
        </div>
        @endforeach
        <!-- Poner 5 checkbox de 1 a 5 estrellas-->
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </div>
  <!-- /.col-lg-3 -->

  <div class="col-lg-9">
    @if($showBanner)
    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
      <ol class="carousel-indicators">
        @for ($i = 0; $i < sizeof($products); $i++) <li data-target="#carouselExampleIndicators" data-slide-to="0">
          </li>
          @endfor
      </ol>
      <div class="carousel-inner" role="listbox">
        @foreach ($products as $key =>$product)
        <div class="carousel-item {{$key==0 ? 'active' : '' }}">
          <img class="d-block img-fluid" src="{{ asset('img/'.$product->image) }}" alt="Second slide">
        </div>
        @endforeach
        <div class="carousel-item">
          <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    @endif
    <div class="row">
      @forelse ($products as $product)
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="{{ asset('img/'.$product->image) }}" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">{{$product->name}}</a>
            </h4>
            <h5>${{$product->price}}</h5>
            <p class="card-text">{{$product->description}}</p>
          </div>
          <div class="card-footer">
          <form class="addCart">
          <input type="hidden" name="prod_id" value="{{$product->id}}">
          <select name="qty">@for ($i = 1; $i < 10; $i++)  <option value="{{$i}}">{{$i}}</option>@endfor</select>
          <button type="submit" class="btn btn-primary">Comprar</button>
          </form>
          </div>
        </div>
      </div>
      @empty
      <p>No products to show</p>
      @endforelse
    </div>
    <!-- /.row -->

  </div>
  <!-- /.col-lg-9 -->

</div>

<script>
    //Escribir aqui el codigo necesario de AXIOS
    //Al hacer click se obtiene la info del producto
    $('.addCart').submit(function(e){
      e.preventDefault();
      var data = $(this).serialize()
      console.log(data)
      axios.post('stock', data) 
      .then(response => {
        if (response == false) {
          window.alert('Lo sentimos, no tenemos este producto actualmente')
        } else {
          axios.post('compra', response.data)
        }
      })
      //Sustituir 0 por la cantidad que tengamos en el carrito
      $('#carrito').html(sizeof(app('request')->session()->get('carrito',[]));
    })
</script>
@endsection