@extends('layouts.app_frontend')

@section('content')
<main class="bg_gray">
    <div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="{{route('index.sitio.web')}}">Inicio</a></li>
                    <li><a href="{{route('help')}}">Ayuda</a></li>
					<li>Preguntas frecuentes</li>
				</ul>
		</div>
		<h1 style="text-align: center">Preguntas frecuentes</h1>
	</div>

    <div class="search-input">
        <form action="{{route('frequents')}}" >
            <input type="text" placeholder="Busca una pregunta en específico..." value="{{$search}}" name="search">
            <button type="submit"><i class="ti-search"></i></button>
        </form>
    </div>
    
    <div class="container">

        {{-- {{decrypt($id)}} --}}
        @if(isset($search))
            @foreach ($frequentQuestions as $item)
                        
                <div class="shadow filter_type version_2 pt-2">
                    <h4><a href="#filter_{{$item->id}}" data-toggle="collapse" class="closed">{{$item->question}}</a></h4>
                    <div class="collapse" id="filter_{{$item->id}}">
                    <div class="container">
                        <p>{{$item->answer}}</p>
                    </div>
                    </div>
                </div>
            @endforeach
        @elseif(isset($id))
            @foreach($id as $nitem)
                <div class="shadow filter_type version_2 pt-2" style="border: blue 1px dotted;">
                    <h4><a href="#filter_{{$nitem->id}}" data-toggle="collapse" class="opened">{{$nitem->question}}</a></h4>
                    <div class="collapse show" id="filter_{{$nitem->id}}">
                    <div class="container">
                        <p>{{$nitem->answer}}</p>
                    </div>
                    </div>
                </div>
            @endforeach

            <h6 class="pt-2">Más preguntas...</h6>
            @foreach ($frequentQuestions as $item)
                
            <div class="shadow filter_type version_2 pt-2">
                <h4><a href="#filter_{{$item->id}}" data-toggle="collapse" class="closed">{{$item->question}}</a></h4>
                <div class="collapse" id="filter_{{$item->id}}">
                <div class="container">
                    <p>{{$item->answer}}</p>
                </div>
                </div>
            </div>
            @endforeach
        @else

            @foreach ($frequentQuestions as $item)
                    
            <div class="shadow filter_type version_2 pt-2">
                <h4><a href="#filter_{{$item->id}}" data-toggle="collapse" class="closed">{{$item->question}}</a></h4>
                <div class="collapse" id="filter_{{$item->id}}">
                <div class="container">
                    <p>{{$item->answer}}</p>
                </div>
                </div>
            </div>
            @endforeach

        @endif

    </div>

    <div class="text-xs-center">
        {{$frequentQuestions->links()}}
    </div>

</main>
@endsection