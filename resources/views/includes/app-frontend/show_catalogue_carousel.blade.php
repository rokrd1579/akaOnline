@php
        
$sumatoria = $reviews->where('product_id',$item->id)->sum('rating');
if($sumatoria > 1){
    $contador = $reviews->where('product_id',$item->id)->count('id');
    $resultado = intval($sumatoria / $contador);
}else{$resultado = 0;$contador = 0;}

@endphp
<div class="item">
    <div class="grid_item">
        @if($item->state == 'Nuevo')
        <span class="ribbon new">{{$item->state}}</span>
        @elseif($item->promotion != null && $item->promotion->stard_date <= $date && $date <=$item->promotion->finish_date)
            <span class="ribbon off">{{$item->promotion->discount}}%</span>
        @endif
        <figure>
            <a href="{{route('show', ['slug'=> $item->slug])}}">

                @foreach($images as $image)
                @if($item->id == $image->imageable_id)
                <img class="owl-lazy" src="{{asset($image->url)}}" data-src="{{asset($image->url)}}" alt="">
                @break
                @endif
                @endforeach

            </a>
        </figure>
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
    <!-- /grid_item -->
</div>