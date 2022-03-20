<div class="offset-sm-1 col-sm-7">
    @if(isset($profile))
        @if(!is_null($profile->nickname))
            <div class="row">
                <p>nickname</p>
                <h4 class="right">{{$profile->nickname}}</h4>
            </div>
        @endif
        @if(!is_null($profile->gender))
            <div class="row">
            <p>sex</p>
                <h4 class="right">{{$profile->gender}}</h4>
            </div>
        @endif
        @if(!is_null($profile->birthplace))
            <div class="row">
                <p>birthplace</p>
                <h4 class="right">{{$profile->birthplace}}</h4>
            </div>
        @endif
        @if(!is_null($profile->local))
            <div class="row">
                <p>local</p>
                <h4 class="right">{{$profile->local}}</h4>
            </div>
        @endif
        @if(!is_null($profile->position))
            <div class="row">
                <p>position</p>
                <h4 class="right">{{$profile->position}}</h4>
            </div>
        @endif
        @if(!is_null($profile->favorite_player))
            <div class="row">
                <p>favorite player</p>
                <h4 class="right">{{$profile->favorite_player}}</h4>
            </div>
        @endif
    @endif
</div>