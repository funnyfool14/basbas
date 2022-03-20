<div class="row">
    @foreach($allPictures as $picture)
        <div class="col-sm-4 mt-4">
            <img class=" "src="{{asset('storage/'.$picture->pic)}}" alt="" width=100%>
                @include('commons.nice_button')
        </div>    
    @endforeach
 </div>