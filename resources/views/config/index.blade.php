@extends('layouts.app_frontend')

@section('content')
<main>
    
    <div class="container margin_30">
        <div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="{{route('index.sitio.web')}}">Inicio</a></li>
					<li>Configuración</li>
				</ul>
		    </div>
                
            <h1 style="text-align: center">Configuración</h1>
        </div>
        <div class="row ">
            <div class="col-lg-3 col-md-6"><p style="margin-top: 100px"> Recibir notificaciones en el sitio web</p></div>
            <div class="col-lg-9 col-md-6" >
               
                    <h3 >Configuracion general de notificaciones</h3>
                        <br>
                        
                        <form action="{{route('configuration')}}">
                            <br>
                        <label class="switch " >
                            <input type="hidden" name="verificador" value="presionado">
                            <input name="push" type="checkbox" @if ($configuration == 1) checked @endif>
                            <span class="slider round"></span>
                        </label>
                        
                        <button class="btn_1" type="submit" style="margin-left: 30px">Aplicar</button>
                        </form>  
            
            </div>
	</div>

  
</main>
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('css/manual/slidernotif.css') }}">
@endpush
