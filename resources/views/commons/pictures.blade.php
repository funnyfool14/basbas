<div class="row">
    @foreach($allPictures as $picture)
        <div class="col-sm-4 mt-4">
            <img class=""src={!!$picture->pic!!} alt="" width=100%></li>
                @include('commons.nice_button')
        </div>    
    @endforeach
 </div>