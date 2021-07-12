@extends('layouts.app_frontend')

@section('content')
<input type="hidden" id="msgVerificador" value="{{$msgVerificador}}">
<main class="bg_gray">
	<div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="/">Inicio</a></li>
					<li>Pagar</li>
				</ul>
		</div>
		<h1>Información de pago</h1>
	</div>
	<!-- /page_header -->
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="step first">
					
						<h3>1. Forma de entrega</h3>
					
							<div class="tab-content checkout">
								<form action="{{route('checkout')}}" method="POST" onsubmit="return validarEnvios()" >	
									{{ csrf_field() }}		
									@if(isset($entrega))
									<div class="row">
										<div class="col-12">
											<h6>Entrega en: </h6>
											<p>{{$entrega}}</p>
											<br>
											<a href="{{url()->previous()}}" class="btn btn_1">Modificar entrega</a>
										</div>
									</div>
									@else
										<div class="row">
											<div class="col-12" id="defaultSelected">
												@if(count($selleraddress) > 0 && count($cartCollection) <= 1 || $nameP != null)
												<h6>En sucursal:</h6>
													@foreach($selleraddress as $key)
														<div id="direccion" name="direccion">
															<label class="container_radio">{{$key->street_name}} {{$key->number_home}}, {{$key->suburb}}<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
																<input type="radio" name="entrega" id="entrega" value="{{$key->street_name}} {{$key->number_home}}, {{$key->suburb}}" >
																<input type="hidden" name="idAddress" id="idAddress" value="{{$key->id}}">
																<span class="checkmark"></span>
															</label>
														</div>
													@endforeach
													<hr>
												@endif
											</div>
										</div>
										<div class="row no-gutters">
											<div class="col-12">
												<h6 class="pb-2">En domicilio:</h6>
												<input type="hidden" name="countAddress" id="countAddress" value="{{count($addresses)}}">
												@if(count($addresses) > 0)
													@foreach($addresses as $key)
														<div id="direccion" name="direccion">
															<label class="container_radio">{{$key->street_name}} {{$key->number_home}}, {{$key->suburb}}<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
																<input type="radio" name="entrega" id="entrega" value="{{$key->street_name}} {{$key->number_home}}, {{$key->suburb}}" >
																<input type="hidden" name="idAddress" id="idAddress" value="{{$key->id}}">
																<span class="checkmark"></span>
															</label>
														</div>
													@endforeach
												@else 
													<div>
														<b>No se encontraron direcciones guardadas</b>
													</div>
												@endif
											</div>
										</div>
									@endif
							</div>
					</div>
					<!-- /step -->
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="step middle payments">
						<h3>2. Forma de pago</h3>
							<div class="tab-content checkout">
							<input type="hidden" id="idAddressSelected" value="0">
							<br>
							<ul>
								<li>
									<label class="container_radio">MercadoPago
										<input type="radio" name="payment" checked>
										<span class="checkmark"></span>
									</label>
								</li>
							</ul>
							</div>
							<div class="payment_info d-none d-sm-block"><figure><img src="{{ asset('img/cards_all.png') }}" alt=""></figure> <p>Todas las transacciones son hechas por MercadoPago, una plataforma confiable que cuenta con el programa "Protección al comprador".</p></div>
					</div>
					@if(!isset($entrega))
					<input type="submit" value="Continuar" class="btn_1 full-width" >
					@endif
				</form>
					<!-- /step -->
				</div>
				<div class="col-lg-4 col-md-6" >
					<div class="step last">
						<h3>3. Resumen de orden</h3>
						<div class="box_general summary">
							@if(count($cartCollection) > 0 and $nameP == null)
								{{ csrf_field() }}
								<ul>
									@foreach ($cartCollection as $item)
									<li class="clearfix"><em>{{$item->quantity}} x {{$item->name}}</em>  <span>${{number_format(\Cart::get($item->id)->getPriceSum(),2)}}</span></li>	
									@endforeach
								</ul>
								<ul>
									<li class="clearfix"><em><strong>Subtotal</strong></em>  <span>${{number_format(\Cart::getSubTotal(),2)}}</span></li>
									<li class="clearfix"><em><strong>Envío</strong></em> <span>@if($cartshipping == 0) Gratis @else ${{number_format($cartshipping,2)}} @endif</span></li>
								</ul>
								<div class="total clearfix">TOTAL <span>${{ number_format((\Cart::getTotal() + $cartshipping),2) }}</span></div>
								
							@else
								<ul>
									<li class="clearfix"><em>{{$quantityP}} x {{$nameP}}</em>  <span>${{number_format($priceP,2)}}</span></li>	
									
								</ul>
								<ul>
									<li class="clearfix"><em><strong>Subtotal</strong></em>  <span>${{number_format($total,2)}}</span></li>
									<li class="clearfix"><em><strong>Envío</strong></em> <span>@if($shipping == 0) Gratis @else ${{number_format($shipping,2)}} @endif</span></li>
								</ul>
								<div class="total clearfix">TOTAL <span>${{number_format(($total + $shipping),2) }}</span></div>

							@endif
							<div>
							@if(isset($entrega))
								<script
								src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js"
								data-preference-id="{{$preference->id}}" data-button-label="Confirmar y pagar" >
								</script>
								<button class="btn_1" onclick="cancelOrder()">Cancelar</button>
							@endif
							</div>
						</div>
					<!-- /box_general -->
					</div>
					<!-- /step -->
				</div>
			</div>
			<!-- /row -->
		
		</div>
		<!-- /container -->
		
		<form action="/checkout/info/5" method="POST" id="form1">
			@csrf
			<input type="hidden" name="id" id="id" value="1">
		</form>
	</main>

@endsection

@push('js')
<script src="{{ asset('js/manual/checkout.js')}}"></script>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	function redirectProfile(){
		window.location.href= '/profile';
	}
	function cancelOrder(){
		Swal.fire({
		title: '¿Estás seguro de cancelar tu orden?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		allowOutsideClick: false,
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sí',
		cancelButtonText: 'No',
		}).then((result) => {
		if (result.isConfirmed) {
			Swal.fire(
			'¡Orden cancelada!',
			'Tu orden se ha cancelado.',
			'success'
			)
			window.location.href= '/checkout/clear';
		}
		})
	}
	try {
		document.getElementById('verifCookie').value = 0;
		
	} catch (error) {
		
	}
	
</script>
@endpush
