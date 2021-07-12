@extends('layouts.app_frontend')

@section('content')
{{ csrf_field() }}
<main class="bg_gray">
    <div class="container">
        @if($status == "approved")
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div id="confirm">
                    <div class="icon icon--order-success svg add_bottom_15">
                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                            <g fill="none" stroke="#8EC343" stroke-width="2">
                                <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                            </g>
                        </svg>
                    </div>
                <h2>Orden completada exitosamente!</h2>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5 m-0 vh-50 row justify-content-center align-items-center border border-1">
                <div class="shadow p-3 mb-5 bg-white rounded">
                    <h3>Información de la compra</h3>
                    @if(isset($title))
                        <table class="table table-bordered">
                            <thead>
                                <th scope="col">Producto</td>
                                <th scope="col">Cantidad</td>
                            </thead>
                            <tbody>
                                <td>{{$title}}</td>
                                <td>{{$quantity}}</td>
                            </tbody>
                        </table>
                        <h5>Total:$ {{number_format($price + $shipping,2)}} MXN</h5>
                        <p>Pagado con {{$payment_type}}</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <th scope="col">Producto</td>
                                <th scope="col">Cantidad</td>
                            </thead>
                            @foreach ($cart as $item)
                            <tbody>
                                <td>{{$item->name}}</td>
                                <td>{{$item->quantity}}</td>   
                            </tbody>
                             @endforeach
                        </table>
                        <h5>Total:$ {{number_format($cartTotal + $cshipping,2)}} MXN</h5>
                        <p>Pagado con {{$payment_type}}</p>
                    @endif
                    <div>
                        <p>Entrega en: {{$k}}</p>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($status == "pending")
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div id="confirm">
                    <div class="icon icon--order-pending svg add_bottom_15">
                        <img src="{{asset('/img/pending.png')}}"  width="82" height="82">
                    </div>
                <h2>Orden pendiente de pago</h2>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5 m-0 vh-50 row justify-content-center align-items-center border border-1">
                <div class="shadow p-3 mb-5 bg-white rounded">
                    <h3>Información de la compra</h3>
                    @if(isset($title))
                        <table class="table table-bordered">
                            <thead>
                                <th scope="col">Producto</td>
                                <th scope="col">Cantidad</td>
                            </thead>
                            <tbody>
                                <td>{{$title}}</td>
                                <td>{{$quantity}}</td>
                            </tbody>
                        </table>
                        <h5>Total:$ {{number_format($price,2)}}</h5>
                        <p>Pagado con {{$payment_type}}</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <th scope="col">Producto</td>
                                <th scope="col">Cantidad</td>
                            </thead>
                            @foreach ($cart as $item)
                            <tbody>
                                <td>{{$item->name}}</td>
                                <td>{{$item->quantity}}</td>   
                            </tbody>
                            @endforeach
                        </table>
                        <h5>Total:$ {{number_format($cartTotal,2)}}</h5>
                        <p>Pagado con {{$payment_type}}</p>
                    @endif
                    <div>
                        <p>Entrega en: {{$k}}</p>
                        <p style="font-weight: bold">Esta orden está pendiente de pago, se acreditará una vez el status sea aprobado por MercadoPago.</p>
                    </div>
                </div>
            </div>
        </div>
    @elseif($status == "failed")
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="confirm">
                    <div class="icon icon--order-pending svg add_bottom_15">
                        <img src="{{asset('/img/failed.png')}}"  width="82" height="82">
                    </div>
                <h2>El pedido no se pudo realizar correctamente, intenta nuevamente.</h2>
                </div>
            </div>
        </div>

    @endif
    <h6 class="text-centered"><b><i>Serás redirigido a tu historial automáticamente en 5 segundos.</i></b></h6>
    </div>
    <!-- /container -->
</main>

@endsection

@push('js')
<script>
    setTimeout(function (){ window.location.href= '/history';},5000);
    document.getElementById('verifCookie').value = 0;
</script>
@endpush