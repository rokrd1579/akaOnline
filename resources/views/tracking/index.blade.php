@extends('layouts.app_frontend')
@section('content') 
<body>
	<main class="bg_gray">
		<div id="track_order">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-xl-7 col-lg-9">
						<img src="{{asset('img/track_order.svg')}}" alt="" class="img-fluid add_bottom_15" width="200" height="177">
						<p>Rastrea tu Orden</p>
						<form action="/track/order" method="get">
							<div class="search_bar">
								<input type="number" maxlength="6" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="search" name="search" class="form-control" placeholder="ID de Seguimiento">
								<input type="submit" value="Buscar" style="height:38px">
							</div>
						</form>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /track_order -->
		
		<div class="bg_white">
			<div class="container margin_60_35">
				<div class="main_title">
					<h2>Nuevos Productos</h2>
					<span>Productos</span>
					<p>Nuevos productos disponibles para comprar.</p>
				</div>
				<div class="owl-carousel owl-theme products_carousel">
					@foreach ($products as $item)
            			@include('includes.app-frontend.show_catalogue_carousel')  
        			@endforeach 
				</div>
				<!-- /products_carousel -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_white -->
	</main>
</body>
@endsection