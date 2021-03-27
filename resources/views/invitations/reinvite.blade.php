@extends('commons.layouts')
@section('content')
    @foreach($invitations as $invitation)
        @if(count($invitation->waiting())==3)
        @else
            <h3 class='mt-5 mb-3'>{{$invitation->name}}</h3>
            <div class="">
                <form method="POST" action="{{route('invitations.restore',$invitation->id)}}">
                    @csrf
                    <h4 class='mt-4'>チームメイトを friendから招待する</h4>
                    @if(count($invitation->waiting())==2)
                        <div class="">
                            <label for='formInputName' class='mt-2'>member</label>
                            <select class='form-control'name='member1'>
                                <label for='member1'>member</label>
                                <option value=''disabled selected style='display:none;'>friend の中から選択</option>
                                @foreach($invitation->not_invited() as $friend)
                                    <option value='{{$friend->id}}'@if(old('member1')==$friend->id) selected @endif>{{$friend->firstName.' '.$friend->lastName}}</option>
                                @endforeach
                            </select>    
                        </div>
                    @elseif(count($invitation->waiting())==1)
                        <div class="">
                            <label for='formInputName' class='mt-2'>member</label>
                            <select class='form-control'name='member1'>
                                <label for='member1'>member</label>
                                <option value=''disabled selected style='display:none;'>friend の中から選択</option>
                                @foreach($invitation->not_invited() as $friend)
                                    <option value='{{$friend->id}}'@if(old('member1')==$friend->id) selected @endif>{{$friend->firstName.' '.$friend->lastName}}</option>
                                @endforeach
                            </select>    
                        </div>
                        <div class="">
                            <label for='formInputName' class='mt-2'>member</label>
                            <select class='form-control'name='member2'>
                                <label for='member2'>member</label>
                                <option value=''disabled selected style='display:none;'>friend の中から選択</option>
                                @foreach($invitation->not_invited() as $friend)
                                    <option value='{{$friend->id}}'@if(old('member2')==$friend->id) selected @endif>{{$friend->firstName.' '.$friend->lastName}}</option>
                                @endforeach
                            </select>    
                        </div>
                    @endif
                    <div class="text-center mt-5">
                        <button type="submit" class='btn btn-outline-primary btn-lg mt-5 col-sm-8'>invite to the team</button>
                    </div> 
                </form>
            </div>
        @endif
    @endforeach    
@endsection('content')