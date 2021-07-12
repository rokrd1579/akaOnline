@extends('layouts.app_frontend')
@section('content')
<main>
    @foreach($products as $product)
    @php $rep3=0; @endphp

    @foreach($businessesHasUsers as $rep2)
    @if($product->business_id==$rep2->business_id && auth()->id()==$rep2->user_id)
    @php $rep3=1; @endphp
    @endif

    @endforeach
    @php
        $cantidad_cart = 0;
        foreach ($cart_stock as $key) {
            if($product->id == $key->id){
                $cantidad_cart = $key->quantity;
            }
        }
        $sumatoria = $reviews->where('product_id',$product->id)->sum('rating');
        if($sumatoria > 1){
            $contador = $reviews->where('product_id',$product->id)->count('id');
            $resultado = intval($sumatoria / $contador);
        }else{$resultado = 0;$contador = 0;}
        
    @endphp
    <div class="container margin_30">
        {{-- @if($product->promotion != null)
        Tiene promocion
        <div class="countdown_inner">-{{$product->promotion->discount}}% Esta oferta termina en <div data-countdown="{{$product->promotion->finish_date}}" class="countdown"></div></div>
        @endif --}}

        
        @if($product->promotion != null && $product->promotion->stard_date <= $date && $date < $product->promotion->finish_date)
            <div class="countdown_inner">-{{$product->promotion->discount}}% Esta oferta termina en <div data-countdown="{{$product->promotion->finish_date}}" class="countdown"></div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="all">
                        <div class="slider">
                            <div class="owl-carousel owl-theme main">
                                @foreach($images as $image)
                                @if($product->id == $image->imageable_id)
                                <div style="background-image: url('{{asset($image->url)}}');" class="item-box"></div>
                                @endif
                                @endforeach
                            </div>
                            <div class="left nonl"><i class="ti-angle-left"></i></div>
                            <div class="right"><i class="ti-angle-right"></i></div>
                        </div>
                        <div class="slider-two">
                            <div class="owl-carousel owl-theme thumbs">
                                @foreach($images as $image)
                                @if($product->id == $image->imageable_id)
                                <div style="background-image: url('{{asset($image->url)}}');" class="item"></div>
                                @endif
                                @endforeach
                            </div>
                            <div class="left-t nonl-t"></div>
                            <div class="right-t"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index.sitio.web') }}">Inicio</a></li>
                            @foreach($allcateg as $key)
                            @foreach($categoryproduct as $cat)
                            @if($product->id == $cat->product_id && $cat->category_id == $key->id)
                            <li><a href="{{route('catalogue_categories',['category'=> $key->slug])}}">{{$key->category_name}}</a></li>
                            @endif
                            @endforeach
                            @endforeach
                            <li>{{$product->name}}</li>
                        </ul>
                    </div>
                    <!-- /page_header -->
                    <div class="prod_info">
                        <h1>{{$product->name}}</h1>
                        {{-- validacion estrellas  --}}
                        @switch($resultado)
                            @case(0)
                            <span class="rating"><i class="icon-star"></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star"></i><em>0.0/5.0 Calificaciones {{$contador}}</em></span>
                            @break
                            @case(1)
                            <span class="rating"><i class="icon-star voted"></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star"></i><em>1.0/5.0 Calificaciones {{$contador}}</em></span>
                            @break
                            @case(2)
                            <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star"></i><em>2.0/5.0 Calificaciones {{$contador}}</em></span>
                            @break
                            @case(3)
                            <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star "></i><i class="icon-star"></i><em>3.0/5.0 Calificaciones {{$contador}}</em></span>
                            @break
                            @case(4)
                            <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i><em>4.0/5.0 Calificaciones {{$contador}}</em></span>
                            @break
                            @case(5)
                            <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><em>5.0/5.0 Calificaciones {{$contador}}</em></span>
                            @break
                        @endswitch
                        {{-- fin --}}
                        <p><small>Características</small><br>{!!$product->characteristics!!}</p>
                    @if(($product->stock - $cantidad_cart) > 0)    
                        <div class="prod_options">
                            <div class="row">
                                <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Cantidad</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        <div class="numbers-row">
                                            <input type="hidden" id="codefull" value="{{($product->stock - $cantidad_cart)}}">
                                            <input type="hidden" value="1" id="quantity1" name="quantity">
                                            <input type="text" value="1" id="quantity" class="qty2" name="quantity" readonly>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                @if($product->promotion != null)
                                
                                @if($product->promotion->stard_date <= $date && $date < $product->promotion->finish_date)
                                    
                                    <div class="price_main"><span class="new_price">${{number_format(($product->price - (($product->price * $product->promotion->discount) / 100) ),2)}}</span><span class="percentage">-{{$product->promotion->discount}}%</span><br> <span class="old_price">${{number_format($product->price,2)}}</span></div>
                                @endif

                                @else
                                <div class="price_main"><span class="new_price">${{number_format($product->price,2)}}</span></div>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-6">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                                <input type="hidden" value="{{ $product->slug }}" id="slug" name="slug">
                                <input type="hidden" value="{{ $product->name }}" id="name" name="name">
                                @if($product->promotion != null)
                                
                                @if($product->promotion->stard_date <= $date && $date < $product->promotion->finish_date)
                                    <input type="hidden" value="{{($product->price - (($product->price * $product->promotion->discount) / 100) )}}" id="price" name="price">
                                    @endif
                                    
                                    @else
                                    <input type="hidden" value="{{$product->price}}" id="price" name="price">
                                    @endif
                                    <input type="hidden" value="{{ $product->images->first()->url }}" id="img" name="img">
                                    <input type="hidden" id="shipping" name="shipping" value="{{ $product->price_shipping}}">
                                    <input type="hidden" name="sellerId" value="{{$product->user_id}}">
                                    <input type="hidden" name="codefull" value="{{$product->stock}}">
                                    <div class="btn_add_to_cart"><button href="" class="btn_1">Añadir al carrito</button></div>
                                    </form>

                                    <form action="{{route('ccookies')}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                                        <input type="hidden" value="1" id="quantitybuy" class="qty2" name="quantity">
                                        <input type="hidden" value="{{ $product->name }}" id="name" name="name">
                                        @if($product->promotion != null)
                                        
                                        @if($product->promotion->stard_date <= $date && $date < $product->promotion->finish_date)
                                            <input type="hidden" value="{{($product->price - (($product->price * $product->promotion->discount) / 100) )}}" id="price" name="price">
                                            @endif
                                            
                                            @else
                                            <input type="hidden" value="{{$product->price}}" id="price" name="price">
                                            @endif
                                            <input type="hidden" id="shipping" name="shipping" value="{{ $product->price_shipping}}">
                                            <br>
                                            <div class="btn_add_to_cart"><input class="btn_1" type="submit" value="Comprar"></div>
                                           
                                    </form>
                            </div>
                    @else
                    <div class="row">
                        <div>
                            <p><b>Producto sin stock</b></p>
                        </div>
                    @endif
                            <div class="col-lg-5 col-md-6" id="div1">
                            
                                    <p><b>Vendedor: </b>{{($product->business->name_business)}}</p>
                              
                            </div>
                        </div>
                    </div>
                    <!-- /prod_info -->
                    <div class="product_actions" >
                        <ul>
                        <li>
                                <a href="https://api.whatsapp.com/send?text=http://acaonline.mx/show/{{$product->slug}}" target="_blank"><i class="fab fa-whatsapp" style="font-size: 19px;"></i><span>WhatsApp</span></a>
                            </li>
                            <li>
                                <a href="http://www.facebook.com/share.php?u=http://acaonline.mx/show/{{$product->slug}}" target="_blank"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/intent/tweet?text=AcaOnline&url=http://acaonline.mx/show/{{$product->slug}}" target="_blank"><i class="fab fa-twitter"></i><span>Twitter</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /product_actions -->
                </div>
            </div>
            <!-- /row -->
    </div>
    <!-- /container -->
    <div class="tabs_product bg_white version_2">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Descripción</a>
                </li>
                <li class="nav-item">
                    <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Reseñas</a>
                </li>
                <li class="nav-item">
                    <a id="tab-B" href="#pane-C" class="nav-link" data-toggle="tab" role="tab">Comentarios</a>
                    <button  style="display:none" id="tab-B" href="#pane-C" class="cargar" data-toggle="tab" role="tab">Comentarios</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /tabs_product -->

    <div class="tab_content_wrapper">
        <div class="container">
            <div class="tab-content" role="tablist">
                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
                                Description
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                    <h3>Detalles</h3>
                                    {!!$product->description!!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /TAB A -->
                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                    <div class="card-header" role="tab" id="heading-B">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                                Reseñas
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                        <div class="card-body">
                            <!-- /row -->
                            <div class="row justify-content-between">
                                @php
                                $reviews = $product->review()->paginate(4);
                                @endphp
                                @forelse ($reviews as $review)
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            @if($review->rating==5)
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><em>{{ $review->rating }}.0/5.0 </em></span> @endif
                                            @if($review->rating==4)
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star empty"></i><em>{{ $review->rating }}.0/5.0 </em></span> @endif
                                            @if($review->rating==3)
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><em>{{ $review->rating }}.0/5.0 </em></span> @endif
                                            @if($review->rating==2)
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><em>{{ $review->rating }}.0/5.0</em></span> @endif
                                            @if($review->rating==1)
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><em>{{ $review->rating }}.0/5.0 </em></span> @endif
                                            @if($review->rating==0)
                                            <span class="rating"><i class="icon-star empty"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><em>{{ $review->rating }}.0/5.0</em></span> @endif

                                            <em>Publicado: {{ date_format($review->created_at,"d/m/Y ")}}</em>
                                        </div>
                                        <h4>{{ $review->user->name }} dice: {{ $review->title }}</h4>
                                        <p>{{ $review->review }}</p>
                                    </div>
                                </div>
                                @empty
                                <div style="margin:auto">
                                    <h1>No hay reseñas </h1>
                                </div>
                                @endforelse
                            </div>

                            <div class="row justify-content-between" style="margin:auto">
                                <p>{{$reviews->links()}}</p>
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- /card-body -->
                    </div>
                </div>
                <!--Reseña -->
                <!-- Inicio de los comentarios -->
                <div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                    <div class="card-header" role="tab" id="heading-B">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-C" aria-expanded="false" aria-controls="collapse-B">Comentarios</a>
                        </h5>
                    </div>
                    <div id="collapse-C" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                        <div class="panel-body comment-container">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    @php
                                    $questions = $product->question()->paginate(4);
                                    @endphp
                                    @forelse($questions as $question)
                                    @php $response=0; @endphp
                                    @foreach($question->response as $rep)
                                                @if($question->id === $rep->question_id)  
                                                @php $response=1; @endphp
                                                @endif
                                    @endforeach

                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><em></em></span><em></em>
                                            </div>
                                            <p><b>{{ $question->user->name }}</b> Publicado: {{ date_format($question->created_at,"d/m/Y ") }}</p>
                                            <p>{{$question->question}}</p>

                                            <div style="margin-left:10px;">
                                                @if (Auth::check() && $response==0 && $rep3===1) 
                                                <a style="cursor: pointer;" cid="{{ $question->id }}" name_a="{{ Auth::user()->name }}" token="{{ csrf_token() }}" class="reply"><font color="#1A1AE8">Respuesta:</font></a>&nbsp;
                                                @else
                                                <a style="cursor: pointer;"> </a>&nbsp;
                                                @endif
                                                @if ($response==1)
                                                <a style="cursor: pointer;">Respuesta: </a>&nbsp;
                                                @endif
                                                <div class="reply-form">

                                                    <!-- Dynamic Reply form -->

                                                </div>

                                                @foreach($question->response as $rep)
                                                @if($question->id === $rep->question_id)
                                                
                                                <i><b>{{($product->business->name_business)}} </b> Publicado: {{ date_format($rep->created_at,"d/m/Y ") }}</i>&nbsp;&nbsp; <br>
                                                <span>   {{ $rep->response }}  </span>
                                                <div style="margin-left:10px;">

                                                </div>
                                                <div class="reply-to-reply-form">

                                                    <!-- Dynamic Reply form -->

                                                </div>
                                                @endif
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div style="margin:auto">
                                        <h1>No hay comentarios </h1>
                                    </div>
                                    @endforelse

                                </div>
                                <div class="row justify-content-between" style="margin:auto">
                                    <p>{{$questions->links()}}</p>
                                </div>
                                <div class="row justify-content-between">

                                    <div class="col-lg-6" style="margin-top:20px;">
                                        @if (Auth::check())
                                        <form action="{{ route('question') }}" method="POST">
                                            @csrf
                                            <input class="form-control" id="question" name="question" type="text" placeholder="Comenta aqui" maxlength="190" required> <br>
                                            <input type="hidden" value="{{ $product->id }}" id="product_id" name="product_id">
                                            <div id="container">
                                            <button id="btn" href="" class="btn_1"   >Comentar</button>
                                            </div>
                                            <!--boton y caja de comentario-->
                                        </form>
                                        @endif
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- /fin de los comentarios -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>
    <!-- /tab_content_wrapper -->
    @endforeach
    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Productos Relacionados</h2>
            <span>Productos</span>
        </div>
        <div class="owl-carousel owl-theme products_carousel">

        @foreach ($similar as $item)
            @include('includes.app-frontend.show_catalogue_carousel')  
        @endforeach 

        </div>
        <!-- /products_carousel -->
    </div>
    <!-- /container -->
    <div class="feat">
        <div class="container">
            <ul>
                <li>
                    <div class="box">
                        <i class="ti-gift"></i>
                        <div class="justify-content-center">
                            <h3>Envíos</h3>
                            <p>Envios minimos desde $ </p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-wallet"></i>
                        <div class="justify-content-center">
                            <h3>Pago seguro</h3>
                            <p>Pago 100% seguro</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-headphone-alt"></i>
                        <div class="justify-content-center">
                            <h3>Soporte 24/7</h3>
                            <p>Soporte superior en línea</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!--/feat-->
</main>
@endsection

@push('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/jquery.scrollto/2.1.2/jquery.scrollTo.js"></script>

@if(session('comentado')=='ok')
<script>
$(function(){
  
  $.scrollTo("#div1");

});

$(document).ready(function(){
   $(".cargar").click();
}); 
</script>
@endif


@if(session('agregado')=='ok')

@php
$cantidad=session('cantidad');
@endphp

<script>
Swal.fire({
  
  icon: 'success',
  title: 'Se añadio al carrito: {{$cantidad}} producto(s) ',
  showConfirmButton: false,
  timer: 2000
})
</script>

@endif

@if (session('agregado') == 'no')
<script>
    Swal.fire({
  
  icon: 'error',
  title: 'Ya se agrego al carrito el stock disponible',
  showConfirmButton: false,
  timer: 5000
})
</script>    
@endif
@endpush