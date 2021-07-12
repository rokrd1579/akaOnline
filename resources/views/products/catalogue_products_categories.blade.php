@extends('layouts.app_frontend')

@section('content')

<main>
  <br>
  <h3 style="text-align: center;">Categoria: {{$categname}} </h3> 
<div class="container margin_60_35">
  
            <div class="row small-gutters">
               
                @foreach ($productos as $item)
                         @include('includes.app-frontend.show_catalogue') 
                @endforeach            
              <!-- /col -->          
            </div>
              @if(isset($products))
                 {{$products->links()}} 
               @endif   <!-- /row -->
</div>
</main>
@endsection