<h5 class="mt-1">-basket shoes-</h5>
    @if($manyShoes->isEmpty())
        <h3 class="mt-4">show off your kicks!!</h3>
        <img class="shoes_pic"src="{{asset('image/shoes_pic.jpg')}}" alt="">
    @else
        @foreach($manyShoes as $shoes)
            <h4 class="mt-4">{!!$shoes->brand!!}</h4>
            <div class="row">
                <h2>{!!$shoes->model!!}</h2>
                @if(!is_null($shoes->size))
                    <h5 class="mt-2 ml-3">{!!number_format($shoes->size, 1)!!}cm</h5>
                @endif
            </div>
            @if(is_null($shoes->shoes_pic))
                <img class="shoes_pic"src="{{asset('image/shoes_pic.jpg')}}" alt="">
            @else
                <img class="shoes_pic"src="{{asset($shoes->shoes_pic)}}" alt="">
            @endif
        @endforeach
    @endif
{!!$manyShoes->links()!!}