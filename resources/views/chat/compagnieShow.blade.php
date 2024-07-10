@extends('layout')
@section('content')
<style>
    .moi{
        text-align-last: right;
    }
    .badge{
        background: #f40;
        color: wheat;
        font: bold;
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        text-align: center;
        align-items: center;
        border-radius: 10px
    }

</style>

<div class=" flex colums-2">
    <div class=" px-4">
        <h3 class="text-xl font-bold ">Conversation  ({{ Auth::user()->name }}) </h3>
        <x-chat.chat-compagnies :$compagnies :$unreadCount />
    </div>

    <div class="  block border border-gray-800 bg-white rounded-md ml-4 w-full">
        <div class=" block font-bold bg-gray-500 rounded-md w-full text-white">
            <span class=" py-2 px-4 w-full ">
                <b>{{ $user->name }} ({{ $messages->count() }})</b>
               
            </span>
        </div>
        <div class="p-4 bg-white">
            @forelse ($messages as $msg)

            <div>
                <x-chat.chat-bulle :message="$msg" />
            </div>
            
            @empty
                <div>AUCUNE CONVERSATION</div>
            @endforelse
        </div>
        <div>
            <form method="post">
                @csrf
                <x-chat.chat-textarea name="message" />
            </form>
        </div>
    </div>
</div>
@endsection
