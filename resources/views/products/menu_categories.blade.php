@extends('layouts.app_frontend')

@section('content')
<main> 
     <div class="container margin_60_35">
          <h5>Categorias</h5>
          <div class="container">
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-xl-3 col-sm-6 col-12 my-1">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="m-0 row justify-content-center align-items-center">
                                            <span><a class=" text-wrap" href="{{route('catalogue_categories', ['category'=> $category->slug])}}">{{$category->category_name}}</a></span>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach 
                </div>
            </div>
            @if(isset($categories))
                 {{$categories->links()}} 
            @endif  
     </div>     
</main>   
@endsection