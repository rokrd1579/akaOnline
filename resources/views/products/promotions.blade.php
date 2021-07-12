@extends('layouts.app_frontend')

@section('content')
<main>

    <ul id="banners_grid" class="clearfix">
    @foreach ($promotions as $promotion)
           @for ($i = 1; $i <=1; $i++)   
        <li>
            <a href="{{route('show', ['slug'=> $promotion->productslug])}}" class="img_container">
                <img src="{{asset($promotion->image)}}" class="lazy">
                <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.2)">
                    <h3>{{$promotion->name}}   {{$promotion->discount}}%</h3>
                    <h3>{{$promotion->productsname}}</h3>
                    <div><span class="btn_1">Ver más</span></div>
                </div>
            </a>           
        </li>
        @endfor
            @endforeach
    </ul>

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Productos Destacados</h2>
            <p>Las Mejores Marcas y Los Mejores Precios</p>
        </div>
             <div class="owl-carousel owl-theme products_carousel">
           
                 @foreach ($products as $item)
                     @if($item->id >= 0)  
                             @include('includes.app-frontend.show_catalogue_carousel')  
                         @break($item->id == 7)
                     @endif
                @endforeach 
               <!-- /item -->         
             </div>
        <!-- /products_carousel -->
    </div>
</main>
@endsection