@extends('layouts.app_frontend')

@section('content')
<main class="bg_gray">
    <div class="container margin_30">
    <div class="page_header">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ route('index.sitio.web')}}">Inicio</a></li>
               
                <li>Carrito</li>
            </ul>
        </div>
        <h1>Carrito de compras</h1>
    </div>
    <!-- /page_header -->

@if(\Cart::getTotalQuantity()>0)
    <table class="table table-striped cart-list">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cartCollection as $item) 
            <tr>
                <td>
                    <div class="thumb_cart">
                        <img src="{{  $item->attributes->image  }}" class="lazy" alt="Image">
                    </div>
                    <span class="item_cart">{{ $item->name }}</span>
                </td>
                <td>
                    <strong>${{ number_format($item->price,2)}} MXN</strong>
                </td>
                <td>
                    <div class="numbers-row">
                    <input type="hidden" id="codefull" value="{{$item->attributes->stock}}">
                        <input type="text" value="{{ $item->quantity }}" id="quantity" readonly class="qty2" name="quantity[]" onkeypress='return event.charCode >= 49 && event.charCode <= 57'>
                        <div class="inc button_inc">+</div><div class="dec button_inc">-</div>
                    </div>
                </td>
                <td>
                    <strong>${{ number_format(\Cart::get($item->id)->getPriceSum(),1) }}MXN</strong>
                </td>
                <td>
                    <form action="{{ route('cart.remove')}}" method="POST">
                        {{ csrf_field() }}
                        <input class="collection" type="hidden" name="id[]" id="id" value="{{ $item->id}}">
                        <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i class="fa fa-trash">
                    </form>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>

    <form action="{{ route('cart.clear') }}" method="POST">
    {{ csrf_field() }}
    <div class="row add_top_30 flex-sm-row-reverse cart_actions">
        <div class="col-sm-4 text-right">
            <button type="button" class="btn_1 gray" onclick="carrito();" method="POST">Actualizar carrito</button>
            <button type="submit" class="btn_1 gray">Limpiar carrito</button>
        </div>
    </div>
    </form>
</div>
    <div class="box_cart">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-xl-4 col-lg-4 col-md-6">
        <ul>
            <li>
                <span>Envío minimo:</span>$ {{number_format($shipping,2)}} MXN
            </li>
            <li>
                <span>Total</span>$ {{ number_format((\Cart::getTotal() + $shipping),2) }} MXN
            </li>
        </ul>
        <a href="{{ route('checkout')}}" class="btn_1 full-width cart">Pagar</a>
                </div>
            </div>
        </div>
    </div>
@else
<center>    <font color="gray" size=7>Tu carrito est&aacute; vac&iacute;o</font> </center>
    <center>     <font color="gray">¿No sabes qu&eacute; comprar? ¡Miles de productos te esperan! </font> </center>
    <br><br><br>
@endif

</main>
@endsection

@push('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
