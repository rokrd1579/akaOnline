@extends('layouts.app_frontend')

@section('content')
<main class="bg_gray">
	<div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="{{route('index.sitio.web')}}">Inicio</a></li>
					<li>Ayuda</li>
				</ul>
		</div>
		<h1 style="text-align: center">Ayuda y soporte</h1>
	</div>
	<!-- /page_header -->
	{{-- 	<div class="search-input">
			<form action="#">
				<input type="text" placeholder="Busca una pregunta o artículo...">
				<button type="submit"><i class="ti-search"></i></button>
			</form>
		</div> --}}
		<!-- /search-input -->
		
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<a class="box_topic" href="{{route('profile')}}">
						<i class="ti-user"></i>
						<h3>Cuenta</h3>
						<p>Revisa tus datos personales o modifica la información personal.</p>
					</a>
				</div>
				
				<div class="col-lg-4 col-md-6">
					<a class="box_topic" href="{{route('history')}}">
						<i class="ti-eraser"></i>
						<h3>Cancelaciones y devoluciones</h3>
						<p>Revisa los puntos que debes considerar antes de hacer una cancelación y el proceso de esta.</p>
					</a>
				</div>

				<div class="col-lg-4 col-md-6">
					<a class="box_topic" href="{{route('frequents')}}">
						<i class="ti-help"></i>
						<h3>Preguntas frecuentes</h3>
						<p>Encuentra soluciones rápidas a problemas en el sitio web.</p>
					</a>
				</div>
			</div>
			<!--/row-->
		</div>
		<!-- /container -->
		<div class="bg_white">
			<div class="container margin_30">
				<h5>Preguntas frecuentes</h5>
				<div class="list_articles add_bottom_15 clearfix">
					<ul>
						@foreach ($frequentQuestions->take(8) as $item)
							<li><a href="{{route('frequents',['q'=>$item->id])}}"><i class="ti-help"></i><strong>{{$item->question}}</strong> - {{substr($item->answer,0,50)}}...</a></li>
						@endforeach
					</ul>
				</div>
				<!-- /list_articles -->
			</div>
		</div>
		<!-- /bg_white -->
</main>
@endsection