@extends('layouts.app_frontend')
@if(isset($busqueda))
@section('busqueda',$busqueda)
@endif


@section('content')

<main>
    <div class="container margin_30">
        <div class="row">
            <aside class="col-lg-3" id="sidebar_fixed">
                <form action="{{route('search')}}">
                <div class="filter_col">
                    <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
                    <div class="filter_type version_2">
                        <h4><a href="#filter_1" data-toggle="collapse" class="opened">Categories</a></h4>
                        <div class="collapse show" id="filter_1">
                            <ul>
                                @php
                                $count =0;
                                @endphp
                                @foreach ($categorias as $item)
                                
                                    @break($count==5)
                                    <li>
                                        <a href="{{route('search', ['search'=>$busqueda, 'cat'=>$item->id])}}">{{$item->category_name}} </a>
                                    </li> 
                                    @php
                                        $count++;
                                    @endphp
                                    
                                @endforeach
                                @if(count($categorias) > 5)
                                    <span class="more" id="more" style="display: none">
                                    @php
                                    $count =0;
                                    @endphp
                                        @foreach($categorias as $item)
                                            @if($count>=5) 
                                        
                                            <li>   
                                                <a href="{{route('search', ['search'=>$busqueda, 'cat'=>$item->id])}}">{{$item->category_name}} </a>
                                            </li> 
                                            @endif
                                            @php
                                            $count++;
                                            @endphp
                                        @endforeach
                                    </span>      
                                    <li><a href="#" id="read" onclick="read()" style="font-weight: bold; text-decoration: none">Ver mas categorías</a></li>
                                @endif
                            </ul>
                            
                        </div>
                        <!-- /filter_type -->
                    </div>
                    <!-- /filter_type -->
                    <div class="filter_type version_2">
                        <h4><a href="#filter_2" data-toggle="collapse" class="opened">Precio</a></h4>
                        <div class="collapse show" id="filter_2">
                            <ul>
                            <li>
                                    <a href="{{route('search',['search'=>$busqueda, 'price1'=>0 , 'price2'=>1000 ])}}">$0 - $1,000</a>
                                </li>
                                <li>
                    
                                    <a href="{{route('search',['search'=>$busqueda, 'price1'=>1000 , 'price2'=>5000 ])}}">$1,000 - $5,000</a>
                                </li>
                                <li>
                            
                                    <a href="{{route('search',['search'=>$busqueda, 'price1'=>5000 , 'price2'=>15000 ])}}">$5,000 - $15,000</a>
                                </li>
                                <li>
                                    
                                    <a href="{{route('search',['search'=>$busqueda, 'price1'=>15000 , 'price2'=>25000 ])}}">$15,000 - $25,000</a>
                                </li>
                            </ul>
                           
                        </div>
                    </div>

                    <!-- -->
                    <!-- /filter_type -->
                        
                    </div>
                </form>
            </aside>
            <!-- /col -->
            <div class="col-lg-9">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{route('index.sitio.web')}}">Inicio</a></li>
                        <li>Búsqueda</li>
                        <li>Resultados</li>
                    </ul>
                </div>
                <!-- /top_banner -->
                <div id="stick_here"></div>
                <div class="toolbox elemento_stick add_bottom_30">
                    <div class="container">
                        <ul class="clearfix">
                            <li>
                                <a href="#0" class="open_filters">
                                    <i class="ti-filter"></i><span></span>
                                </a>
                            </li>
                        </ul>
                        @if(isset($text))
                        <h5>Resultados de la búsqueda {{$text}}</h5>
                        @else
                        <h5>Resultados de la búsqueda</h5>
                        @endif

                    </div>
                </div>
                <!-- /toolbox -->
                
                @if(isset($products))
                @foreach($products as $productos)
                
                <div class="row row_item">
                    <div class="col-sm-4">
                        <figure> 
                                    
                                @if($productos->promotion != null && $productos->promotion->stard_date <= $date && $date < $productos->promotion->finish_date)
                                    <span class="ribbon off">{{$productos->promotion->discount}}%</span>
                                @endif
                                
                                <a href="{{route('show', ['slug' => $productos->slug])}}">  
                                   {{-- {{$productos->images->first()->url}} --}}
                                <img class="img-fluid lazy" src="{{$productos->images->first()->url}}" data-src="{{$productos->images->first()->url}}" alt="">
                            </a>
                            
                                @if($productos->promotion != null && $productos->promotion->stard_date <= $date && $date < $productos->promotion->finish_date)
                                    <div data-countdown="{{$productos->promotion->finish_date}}" class="countdown"></div>
                                @endif
                                
                            
                        </figure>
                    </div>
                    <div class="col-sm-8">
                        <a href="{{route('show', ['slug' => $productos->slug])}}">
                            <h3> {{ $productos -> name}}</h3>
                        </a>
                        <p> {!!$productos -> description!!}</p>
                        <div class="price_box">
                            
                            @if($productos->promotion != null)
                            
                                    @if($productos->promotion->stard_date <= $date && $date < $productos->promotion->finish_date)
                                        <span class="new_price">${{number_format(($productos->price - (($productos->price * $productos->promotion->discount) / 100) ),2)}}</span>
                                        <span class="old_price">${{number_format($productos->price,2)}}</span>
                                    @endif
                                    
                            @else
                                <span class="new_price">${{number_format($productos->price,2)}}</span>
                            @endif
                        </div>
                        <ul>
                            <form action="{{ route('cart.store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="1" name="quantity"> 
                                <input type="hidden" value="{{ $productos->slug }}" name="slug">
                                <input type="hidden" value="{{ $productos->id }}"  name="id">
                                <input type="hidden" value="{{ $productos->name }}" name="name">
                                @if($productos->promotion != null)
                                
                                    @if($productos->promotion->stard_date <= $date && $date < $productos->promotion->finish_date)
                                        <input type="hidden" value="{{($productos->price - (($productos->price * $productos->promotion->discount) / 100) )}}"  name="price">
                                    @endif
                                        
                                @else
                                    <input type="hidden" value="{{$productos->price}}"  name="price">
                                @endif
                                <input type="hidden" value="{{ $productos->images->first()->url }}"  name="img">
                                <input type="hidden" value="{{ $productos->price_shipping}}" name="shipping">
                                <input type="hidden" name="sellerId" value="{{$productos->user_id}}">
                                <input type="hidden" name="codefull" value="{{$productos->stock}}">
                                @if(($productos->stock) > 0)
                                <li><input class="btn_1" type="submit" value="Agregar al carrito"></li>
                                @else
                                <div class="row">
                                    <div>
                                        <p><b>Producto sin stock</b></p>
                                    </div>
                                @endif
                            </form>
                            
                        </ul>
                    </div>
                </div>
                
                @endforeach
                @endif

                @if(count($products)==0)
                <div class="container-md shadow p-3 mb-5 bg-body rounded"style=" background-color:rgb(255, 255, 255);">
                    <div class="row " >
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            
                            <h5 style=" color:rgb(0, 0, 0); background-color:rgb(255, 255, 255);" >
                             Lo sentimos, no existen publicaciones relacionadas con el producto que busca
                            </h5>
                        
                        
                                <li style=" color:rgb(0, 0, 0);" >
                                    Revisa la ortografia de tu búsqueda
                                </li>
                        
                                <li style=" color:rgb(0, 0, 0);" >
                                 No se encuentra disponible el producto
                                </li>
                        </div>  
                    </div>
                </div>
                @endif
                <!-- /row_item -->
                @if(isset($products))
                {{$products->appends(request()->input())->links()}}
                @endif
            
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
@endsection
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/manual/filters.js')}}"></script>
@if(session('agregado')=='ok')

@php
$cantidad=session('cantidad');
@endphp
<script>
Swal.fire({
  
  icon: 'success',
  title: 'Se añadio al carrito: {{$cantidad}} producto(s)',
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