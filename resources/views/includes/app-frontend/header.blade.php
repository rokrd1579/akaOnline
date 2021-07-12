<header class="version_2">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="{{route('index.sitio.web')}}"><img src="{{ asset('img/Logo_carrito.png')}}" width="150" height="60"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a href="{{route('index.sitio.web')}}"><img src="{{ asset('img/Logo_carrito.png')}}" width="200" height="90"></a>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>
                            <li>
                                <a href="{{route('bestseller')}}">Lo más vendido</a>
                            </li>
                            <li>
                                <a href="{{route('promotions')}}">Promociones</a>
                            </li>
                            <li>
                                <a href="{{route('news')}}">Novedades</a>
                            </li>
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">

                    <a class="phone_top" href="{{ route('help')}}"><strong><span>¿Necesitas ayuda?</span>AcaOnline@gmail.com</strong></a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->

    <div class="main_nav Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <nav class="categories">
                        <ul class="clearfix">
                            <li><span>
                                    <a href="#">
                                        <span class="hamburger hamburger--spin">
                                            <span class="hamburger-box">
                                                <span class="hamburger-inner"></span>
                                            </span>
                                        </span>
                                        Categorías
                                    </a>
                                </span>
                                <div id="menu">
                                    <ul>
                                        @foreach ($categoriesMenu as $category)
                                        <li><span><a href="{{route('catalogue_categories', ['category'=> $category->slug])}}">{{$category->category_name}}</a></span></li>
                                        @endforeach
                                        <li><a href="{{route('menucategories')}}">Ver más categorías</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                    <div class="custom-search-input">
                        <form action="/search" method="get" onsubmit="return validar()">
                            <input id="search" name="search" type="text" value="@yield('busqueda')" placeholder="Buscar un producto">
                            <button type="submit"><i class="header-icon_search_custom"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-2 col-md-3">
                    <ul class="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">
                            <a href="{{route('cart')}}"><i class="ti-shopping-cart" style="font-size: x-large"></i><strong>{{ \Cart::getTotalQuantity()}} </strong></a>
                                <div class="dropdown-menu">

   @php   $shipping=0; @endphp
                                    <ul>
                                        @if(count(\Cart::getContent()) > 0)
                                        @foreach(\Cart::getContent()->reverse()->take(3) as $item)
                                        <li>
                                            <a href="{{route('show',['slug'=>$item->attributes->slug])}}">

                                                <figure><img src="{{asset($item->attributes->image)}}" data-src="{{asset($item->attributes->image)}}" alt="" width="50" height="50" class="lazy"></figure>
                                                <strong><span>{{$item->name}}</span>${{number_format( $item->price,2) }} MXN x {{$item->quantity}}</strong>
                                            </a>

                                            <!-- <a href="#0" class="action"><i class="ti-trash"></i></a> -->

                                        </li>
                                        @php
                                      
                                    $shipping =$item->attributes->envio+$shipping;
                                    @endphp

                                        @endforeach
                                    </ul>
                                    <div class="total_drop">
                                    <div class="clearfix"><strong>Envio minimo:</strong><span>${{ number_format( $shipping,2) }} MXN</span></div>
                                        <div class="clearfix"><strong>Total:</strong><span>${{ number_format((\Cart::getTotal() + $shipping),2) }} MXN</span></div>
                                        <a href="{{route('cart')}}" class="btn_1 outline">Carrito de compras</a><a href="{{ route('checkout') }}" class="btn_1">Pagar</a>
                                    </div>
                                    @else
                                    <p>Carrito vacio</p>
                                    <div class="total_drop">

                                        <a href="{{route('cart')}}" class="btn_1 outline">Carrito de compras</a>
                                    </div>
                                    @endif

                                </div>
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        <li>
                            {{-- NOTIFICACIONES --}}
                            <div class="dropdown dropdown-access">
                                
                                @if((Auth::user() != null))
                                    <a href="#"><i class="ti-bell" style="font-size: x-large"></i><strong><span class="babge babge-warning">{{ count(auth()->user()->unreadNotifications) }}</span></strong></a>
                                    <div class="dropdown-menu">
                                        <div>
                                        <p><b>Notificaciones</b></p>
                                        <label class="switchBtn">
                                            <input type="checkbox" value="{{Auth::user()->configuration->notif_push}}" @if(Auth::user()->configuration->notif_push == 1) checked @endif id="switchNotif" onclick="clickNotif()">
                                            <div class="slide round"></div>
                                        </label>
                                        </div>
                                        <ul>
                                            @php
                                                $contador = 0;
                                            @endphp
                                            @forelse(auth()->user()->unreadNotifications->take(4) as $notification)
                                            @php
                                                $contador += 1;
                                            @endphp
                                            <li>
                                                
                                            @switch($notification->data['status'])
                                                    @case('approved')
                                                    <a href="{{route('history')}}" style="text-decoration: none"><i class="ti-check-box mr-1" style="margin: auto"></i>Compra de <b>{{$notification->data['product']}}</b> realizado con éxito. <br><em style="color:lightslategrey">{{$notification->created_at->diffForHumans()}}</em></a>
                                                    @break
                                                    @case('pending')
                                                    <a href="{{route('history')}}" style="text-decoration: none"><i class="ti-timer mr-1" style="top: auto"></i>Compra de <b>{{$notification->data['product']}}</b> pendiente a pagar. <br><em style="color:lightslategrey">{{$notification->created_at->diffForHumans()}}</em></a>
                                                    @break
                                                    @case('cancelled')
                                                    <a href="{{route('history')}}" style="text-decoration: none"><i class="ti-na mr-1" style="margin: auto"></i><b>La orden no. {{$notification->data['order_id']}}</b> se canceló. <br><em style="color:lightslategrey">{{$notification->created_at->diffForHumans()}}</em></a>
                                                    @break
                                                    @case('return')
                                                    <a href="{{route('history')}}" style="text-decoration: none"><i class="ti-na mr-1" style="margin: auto"></i><b>La orden no. {{$notification->data['order_id']}}</b> se devolvió. <br><em style="color:lightslategrey">{{$notification->created_at->diffForHumans()}}</em></a>
                                                    @break
                                                    @case('1')
                                                    <a href="{{route('cart')}}" style="text-decoration: none"><i class="ti-shopping-cart-full mr-1" style="margin: auto"></i><b>{{$notification->data['name']}}</b> se agrego al carrito. <br><em style="color:lightslategrey">{{$notification->created_at->diffForHumans()}}</em></a>
                                                    @break
                                                    @case('2')
                                                    <a href="#" style="text-decoration: none"><i class="ti-announcement" style="margin: auto"></i>Proximamente una nueva promoción de <b>{{$notification->data['names']}}</b>. <br><em style="color:lightslategrey">{{$notification->created_at->diffForHumans()}}</em></a>
                                                    @break
                                                    @endswitch 
                                            </li>

                                            
                                            @empty
                                            <p style="text-align: center;">Ninguna notificación sin leer.</p>
                                            @endforelse
                                            
                                            @if($contador > 0)
                                                <li>
                                                <a href="{{route('allmarks')}}" style="text-align: center;"><b>Eliminar todas las notificaciones</b></a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @else
                                    <a href="#"><i class="ti-bell" style="font-size: x-large"></i></a>
                                @endif
                            </div>
                            {{-- NOTIFICACIONES --}}
                        </li>
                        <li>
                            <div class="dropdown dropdown-access">
                          
                            <a href="{{route('login')}}" class="access_link"><span>Cuenta</span></a>
                        
                            <div class="dropdown-menu">

                                    @if(Auth::user() == null)
                                    <p>Inicia sesión para realizar compras y más...</p>
                                    <a href="{{route('login')}}" class="btn_1">Iniciar sesión</a>

                                    @else

                                    <p href="#"><b>Hola, {{Auth::user()->name}}</b></p>
                                    <ul>
                                        <li>
                                            <a href="{{route('profile')}}"><i class="ti-user"></i>Mi perfil</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('history') }}"><i class="ti-package"></i>Mis ordenes</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('tracing') }}"><i class="ti-truck"></i>Rastrea tu orden</a>
                                        </li>
                                        <li>
                                            <a href="{{route('help')}}"><i class="ti-help-alt"></i>Ayuda</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="ti-shift-right"></i>
                                                {{ __('Cerrar sesión') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                @endif

                            </div>
                            <!-- /dropdown-access-->
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="btn_search_mob"><span>Buscar</span></a>
                        </li>
                        <li>
                            <a href="#menu" class="btn_cat_mob">
                                <div class="hamburger hamburger--spin" id="hamburger">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                                Categorias
                            </a>
                        </li>
                    </ul>
                </div>
    </div>
    <!-- /row -->
    </div>
    <div class="search_mob_wp">
        <form action="/search" method="get">
            <input id="search" name="search" type="text" required value="@yield('busqueda')" class="form-control" placeholder="Buscar un producto">
            <input type="submit" class="btn_1 full-width" value="Buscar">
        </form>
    </div>
    <!-- /search_mobile -->
    </div>
    <!-- /main_nav -->
</header>

<!-- FORMULARIO  PARA PODER ENVIAR EL TOKEN Y USAR AJAX -->
<form action="/configuration/5" method="post" id="config">
    <input type="hidden" name="ok" value="0">
@csrf
</form>

@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
    function clickNotif(){
        
        try {
            var btnSettingsNotif = document.getElementById('switchNotif').value;
            const demoId = document.querySelector('#switchNotif');
                    demoId.setAttribute('disabled', '');

            if(btnSettingsNotif == 1){
                    $.ajax({
                    url: '/configuration/1',
                    method: 'POST',
                    data:$("#config").serialize()
                }).done(function(res){
                    var result = JSON.parse(res);
                    Swal.fire({
                    icon: 'success',
                    title: 'Notificaciones',
                    text: result,
                    allowOutsideClick: false
                    })
                   location.reload();
                })
            }else{
                $.ajax({
                    url: '/configuration/0',
                    method: 'POST',
                    data:$("#config").serialize()
                }).done(function(res){
                    var result = JSON.parse(res);
                    Swal.fire({
                    icon: 'success',
                    title: 'Notificaciones',
                    text: result,
                    allowOutsideClick: false
                    })
                   location.reload();
                })
            }
        } catch (error) {
            
        }
    }
</script>
@endpush