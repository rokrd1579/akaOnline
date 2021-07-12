@extends('layouts.app_frontend')

@section('content')
<main>
    <div class="main_title">
    <br>
            <h2>Productos añadidos recientemente</h2>
            <p>Encuentra los productos más nuevos</p>
    </div> 
    <div class="container margin_60_35">

        <div class="row small-gutters">
    
            @foreach ($products as $item)
                @include('includes.app-frontend.show_catalogue') 
            @endforeach  
    
        </div>
         @if(isset($products))
                {{$products->links()}} 
            @endif  
    </div>
</main>

@endsection