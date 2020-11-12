<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Bas×Bas</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav text-right">
                {{--<li class="nav-item">{!!link_to_route('????.????','####',[],['class'=>'nav-link'])!!}</li>--}}
                <li class="nav-item"><a href="#" class="nav-link">HOOP search</a></li>
                <li class="nav-item"><a href="#" class="nav-link">TEAM search</a></li>
                @if(Auth::check())
                <li class="nav-item">{!!link_to_route('logout.get','logout',[],['class'=>'nav-link'])!!}</li>
                @else
                <li class="nav-item">{!!link_to_route('signup.get','signup',[],['class'=>'nav-link'])!!}</li>
                <li class="nav-item">{!!link_to_route('login','login',[],['class'=>'nav-link'])!!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>