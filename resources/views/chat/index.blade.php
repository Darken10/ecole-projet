@extends('layout')

@section('content')
    <div class=" pt-4 flex colums-2">
        <div class="">
            <div class=" pt-4 p-2">
                <x-chat.chat-users :users="$users" />
            </div>
        </div>    
    </div>
@endsection