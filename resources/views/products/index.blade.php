@extends('layouts.app_frontend')

@section('content')
<main>
    <div id="carousel-home">
        <div class="owl-carousel owl-theme">

            @foreach ($promotion as $promociones)
            @for ($i = 1; $i <=1; $i++) <div class="owl-slide cover" style="background-image: url('{{$promociones->image}}')">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.2)">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-end">
                            <div class="col-lg-6 static">
                                <div class="slide-text text-right white">
                                    <h2 class="owl-slide-animated owl-slide-title">{{$promociones->name}} {{$promociones->discount}}%</h2>
                                    <h2 class="owl-slide-animated owl-slide-title">{{$promociones->productsname}}</h2>
                                    <p class="owl-slide-animated owl-slide-subtitle">
                                        {{$promociones->description}}
                                    </p>
                                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="{{route('show', ['slug'=> $promociones->productslug])}}" role="button">Ver más</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endfor
        @endforeach
        <!--/owl-slide-->
    </div>
    <div id="icon_drag_mobile"></div>
    </div>
    <!--/carousel-->

    <ul id="banners_grid" class="clearfix">
        @foreach ($categories as $category)
        @for ($i = 1; $i <=1; $i++) <li>
            <a href="{{route('catalogue_categories', ['category'=> $category->slug])}}" class="img_container">
                <img src="{{asset($category->image)}}" alt="" class="lazy">
                <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.2)">
                    <h3>{{$category->category_name}}</h3>
                    <div><span class="btn_1" href="{{route('catalogue_categories', ['category'=> $category->slug])}}">Ver más</span></div>
                </div>
            </a>
            </li>
            @endfor
            @endforeach
    </ul>

    <!--/banners_grid -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Lo Más Vendido</h2>
            <span>Productos</span>
            <p>Encuentra los Productos Más Buscados</p>
        </div>
        <div class="row small-gutters">

            @foreach ($products as $item)
            @continue($item->id == 25)

            @include('includes.app-frontend.show_catalogue')

            @break($item->id == 41)
            @endforeach
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    @foreach ($promo as $promocion)
    @for ($i = 1; $i <=1; $i++) <div class="featured lazy" data-bg="url('{{$promocion->image}}')">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.1)">
            <div class="container margin_60">
                <div class="row justify-content-center justify-content-md-start">
                    <div class="col-lg-6 wow" data-wow-offset="150">
                        <h3>{{$promocion->name}} {{$promocion->discount}}%</h3>
                        <h3>{{$promocion->productsname}}</h3>
                        <p>{{$promocion->description}}</p>
                        <div class="feat_text_block">
                            <a class="btn_1" href="{{route('show', ['slug'=> $promocion->productslug])}}" role="button">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        @endfor
        @endforeach
        <!-- /featured -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Productos Destacados</h2>
                <span>Productos</span>
                <p>Las Mejores Marcas y Los Mejores Precios</p>
            </div>
            <div class="owl-carousel owl-theme products_carousel">

                @foreach ($products as $item)
                @if($item->id >= 42)
                @include('includes.app-frontend.show_catalogue_carousel')
                @break($item->id == 49)
                @endif
                @endforeach
                <!-- /item -->
            </div>
            <!-- /products_carousel -->
        </div>
        <!-- /container -->

        <div class="container margin_60_35">
            <div class="owl-carousel owl-theme products_carousel">
                @foreach ($products as $item)
                @if($item->id >= 50)
                @include('includes.app-frontend.show_catalogue_carousel')
                @break($item->id == 57)
                @endif
                @endforeach
                <!-- /item -->
                <!-- /item -->
            </div>
            <!-- /products_carousel -->
        </div>

        <div class="bg_gray">
            <div class="container margin_30">
                <div id="brands" class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_1.png" alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_2.png" alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_3.png" alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_4.png" alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_5.png" alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                    <div class="item">
                        <a href="#0"><img src="img/brands/placeholder_brands.png" data-src="img/brands/logo_6.png" alt="" class="owl-lazy"></a>
                    </div><!-- /item -->
                </div><!-- /carousel -->
            </div><!-- /container -->
        </div>
        <!-- /bg_gray -->

        <!-- /container -->
</main>
@endsection