@if(empty($profile->user_pic))
    <img class="user_pic"src="{{asset('image/user_pic.jpg')}}" alt="">
@else
    <img class="user_pic"src="{{asset($profile->user_pic)}}"alt="">
@endif