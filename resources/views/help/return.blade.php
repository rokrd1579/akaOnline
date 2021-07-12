@extends('layouts.app_frontend')

@section('content')
<main class="bg_gray">
    <div class="container margin_30">
        <div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="{{route('index.sitio.web')}}">Inicio</a></li>
					<li><a href="{{route('help')}}">Ayuda</a></li>
                    <li>Cancelaciones y devoluciones</li>
				</ul>
		    </div>
        <div>
            <h1 style="text-align: center">Cancelaciones y devoluciones</h1>
        </div>
        <div class="container margin_30">
            @if($proc == "cancel")
                @if($texto != "Orden cancelada")
                <h5>¿Deseas realmente cancelar tu orden?</h5>
                @else 
                <h5>Tu orden se ha cancelado</h5>
                @endif
            <br>
            <div class="row">
                <div class="col-md-4">
                    <p><b> No. de orden:</b> {{$idOrden}}</p>
                    <p><b> Comprado el:</b> {{$fecha}}</p>
                    @if($metodoPago == "credit_card")
                        <p><b>Pagado con:</b> {{$metodoPago}}</p>
                        <p><b>Últimos 4 digitos:</b> ***{{$array['card']['last_four_digits']}}</p>
                    @else
                        <p><b>Pagado con:</b> {{$metodoPago}}</p>
                    @endif
                    <p><b>Total:</b> {{$total}}</p>
                    @foreach ($address as $item)
                        <p><b>Dirección de entrega:</b> {{$item->street_name}}, {{$item->number_home}}, {{$item->suburb}}</p>
                        <p id="primero"><b>Ciudad:</b> {{$item->city}},{{$item->state}}</p>
                    @endforeach

                </div>
                <div class="col-md-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderProducts->unique('id') as $item)
                            <tr>
                                @foreach($productos->where('id',$item->product_id) as $prod)
                                    <td>
                                        <img class="img-fluid lazy" src="{{$prod->images->first()->url}}" data-src="{{$prod->images->first()->url}}" alt="">
                                    </td>
                                @endforeach
                                <td>{{$item->product}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>${{number_format(($item->sub_total),2)}} MXN</td>
                            </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;">
                    <p><b>Estado:</b> {{$texto}}</p>
                </div>
                <div class="col-md-12">
                    @if($texto != "Orden cancelada")
                    <form action="{{route('operacion')}}" method="get">
                            
                            <input type="hidden" name="idOper" value="cancelConfirm">
                            <input type="hidden" name="idOrden" value="{{$idOrden}}">
                            <input type="hidden" name="idMercadoPago" value="{{$idMercadoPago}}">
                            <button class="btn_1" type="submit" style="display:block;margin-left: auto;margin-right: auto;">Confirmar</button>
                            <div style="text-align: center">
                                <br>
                                <i>Al confirmar se realizará el proceso y serás redirigido a tu historial de compras</i>
                            </div>
                        </form>
                    @else
                    <div style="text-align: center">
                        <b style="display:block;margin-left: auto;margin-right: auto;">Tu orden se canceló exitosamente.</b>
                    </div>
                    @endif
                </div>
            </div>
            @elseif($proc == "refund")
                @if($texto != "Orden en proceso de devolución")
                <h5>¿Deseas realmente devolver tu compra?</h5>
                @else
                <h5>Tu orden está en devolución</h5>
                @endif
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <p><b> No. de orden:</b> {{$idOrden}}</p>
                        <p><b> Comprado el:</b> {{$fecha}}</p>
                        @if($metodoPago == "credit_card")
                            <p><b>Pagado con:</b> {{$metodoPago}}</p>
                            <p><b>Últimos 4 digitos:</b> ***{{$array['card']['last_four_digits']}}</p>
                        @else
                            <p><b>Pagado con:</b> {{$metodoPago}}</p>
                        @endif
                        <p><b>Total:</b> {{$total}}</p>
                        @foreach ($address as $item)
                            <p><b>Dirección de entrega:</b> {{$item->street_name}}, {{$item->number_home}}, {{$item->suburb}}</p>
                            <p id="primero"><b>Ciudad:</b> {{$item->city}},{{$item->state}}</p>
                        @endforeach
    
                    </div>
                    <div class="col-md-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderProducts->unique('id') as $item)
                                <tr>
                                    @foreach($productos->where('id',$item->product_id) as $prod)
                                        <td>
                                            <img class="img-fluid lazy" src="{{$prod->images->first()->url}}" data-src="{{$prod->images->first()->url}}" alt="">
                                        </td>
                                    @endforeach
                                    <td>{{$item->product}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>${{number_format(($item->sub_total),2)}} MXN</td>
                                </tr>    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3" style="display: flex;align-items: center;">
                        <p><b>Estado:</b> {{$texto}}</p>
                    </div>
                    <div class="col-md-12">
                        @if($texto != "Orden en proceso de devolución")
                        <form action="{{route('operacion')}}" method="get">
                            
                            <input type="hidden" name="idOper" value="refundConfirm">
                            <input type="hidden" name="idOrden" value="{{$idOrden}}">
                            <input type="hidden" name="idMercadoPago" value="{{$idMercadoPago}}">
                            <button class="btn_1" type="submit" style="display:block;margin-left: auto;margin-right: auto;">Confirmar</button>
                            <div style="text-align: center">
                                <br>
                                <i>Al confirmar se realizará el proceso y serás redirigido a tu historial de compras</i>
                            </div>
                        </form>
                        @else
                        <div style="text-align: center">
                            <b>Tu orden será devuelta, tu dinero volverá a tu tarjeta en un lapso de 15 días.</b>
                            <p><i>En caso de que hayas depositado en un media diferente a tarjeta, se reembolsará tu dinero en tu cuenta de MercadoPago, si no cuentas con una, se creará automáticamente una cuenta en MercadoPago con el email que usaste para hacer el pago.</i></p>
                        </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        
        <p><i>La devolución de articulos tiene algunos términos para que se pueda llevar a cabo satisfactoriamente, ingresa a <a href="{{route('terms_conditions')}}">este enlace</a> para conocer más información acerca de esto.</i></p>
    </div>
</main>
@endsection