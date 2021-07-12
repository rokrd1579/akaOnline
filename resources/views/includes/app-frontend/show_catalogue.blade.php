@php
        
$sumatoria = $reviews->where('product_id',$item->id)->sum('rating');
if($sumatoria > 1){
    $contador = $reviews->where('product_id',$item->id)->count('id');
    $resultado = intval($sumatoria / $contador);
}else{$resultado = 0;$contador = 0;}

@endphp
<div class="col-6 col-md-4 col-xl-3">
    <div class="grid_item">
        <figure>
            
            @if($item->promotion != null && $item->promotion->stard_date <= $date && $date <=$item->promotion->finish_date)
                <span class="ribbon off">{{$item->promotion->discount}}%</span>
                @endif
                

                @foreach($images as $image)
                @if($item->id == $image->imageable_id)
                <a href="{{route('show', ['slug'=> $item->slug])}}">
                    <img class="img-fluid lazy" src="{{asset($image->url)}}" data-src="{{asset($image->url)}}" width="400" height="400">
                </a>
                @break
                @endif
                @endforeach

                @if($item->promotion != null && $item->promotion->stard_date <= $date && $date <=$item->promotion->finish_date)
                <div data-countdown="{{$item->promotion->finish_date}}" class="countdown"></div>
                @endif
                
        </figure>

        {{-- validacion estrellas  --}}
        @switch($resultado)
            @case(0)
            <span class="rating"><i class="icon-star"></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star"></i></span>
            @break
            @case(1)
            <span class="rating"><i class="icon-star voted"></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star"></i></span>
            @break
            @case(2)
            <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star"></i></span>
            @break
            @case(3)
            <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star "></i><i class="icon-star"></i></span>
            @break
            @case(4)
            <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></span>
            @break
            @case(5)
            <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i></span>
            @break
        @endswitch
        {{-- fin --}}
        <a href="{{route('show', ['slug'=> $item->slug])}}">
            <h3>{{$item->name}}</h3>
        </a>
        <div class="price_box">
            
            @if($item->promotion != null && $item->promotion->stard_date <= $date && $date <=$item->promotion->finish_date)   
                <span class="new_price">${{number_format(($item->price - (($item->price * $item->promotion->discount) / 100) ),2)}}</span>
                <span class="old_price">${{number_format($item->price,2)}}</span>
            @else 
                <span class="new_price">${{number_format($item->price,2)}}</span>      
            @endif
                
        </div>
    </div>
</div>