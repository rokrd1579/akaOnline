@extends('layouts.app_frontend')
@section('content')
<body>
	<main class="bg_gray">	
		<div id="track_order" class="justify-content-center align-items-center">
		<div class="col-md-4"></div>
            <div class="col-md-10 m-0 vh-50 row justify-content-center align-items-center">
                <div class="shadow p-3 mb-5 bg-white rounded">
				@if(count($track_order)<=0)
				<h1>No hay resultados</h1>
								<li style=" color:rgb(0, 0, 0);" >
                                    Revisa el ID de seguimiento.
                                </li>
                        
                                <li style=" color:rgb(0, 0, 0);" >
                                 No se encuentra disponible el seguimiento de la compra.
                                </li>
								<br>
				@endif
				@foreach ($track_order as $track)
                    <h2>Detalles del envío</h2>
					<br>
					<div class="container">
    					<div class="progress-container">
       						<div class="progress" id="progress"></div>
							   		@switch($track->status)
                                        @case('Preparando')
                                            <div class="progress" id="progress"></div>
												<div class="circle active"><i class="ti-package"></i></div>
        										<div class="circle"><i class="ti-truck"></i></div>
        										<div class="circle"><i class="ti-check"></i></div>
                                        @break
										@case('En camino')
											<div class="progress1" id="progress"></div>
												<div class="circle active"><i class="ti-package"></i></div>
        										<div class="circle active"><i class="ti-truck"></i></div>
        										<div class="circle"><i class="ti-check"></i></div>
                                        @break
										@case('Entregado')
											<div class="progress2" id="progress"></div>
												<div class="circle active"><i class="ti-package"></i></div>
        										<div class="circle active"><i class="ti-truck"></i></div>
        										<div class="circle active"><i class="ti-check"></i></div>
                                        @break
									@endswitch
    						</div>
						</div>
                        <table class="table table-bordered">
						<h5> Estatus de la orden: {{$track->status}} </h5> 
						<h5>Fecha estimada de entrega: 16/06/2021</h5>
                            <thead>
							    <th scope="col">ID de seguimiento: {{$track->tracking_id}}</tr>
                                <th scope="col">Producto: {{$track->product}}</tr>
                                <th scope="col">Cantidad: {{$track->quantity}}</tr>
                            </thead>
                        </table>
						@endforeach
						<div class="row justify-content-center text-center">
					<div class="col-xl-7 col-lg-9">
						<img src="{{asset('img/track_order.svg')}}" alt="" class="img-fluid add_bottom_15" width="150" height="177">	
					</div>
				</div>
                </div>
            </div>
			<!-- /container -->
		</div>
		<br><br><br><br><br>
		<!-- /track_order -->
	</main>
</body>
@endsection
@push('css')
	<link href="{{asset('css/progress_bar.css')}}" rel="stylesheet" type="text/css">
@endpush

