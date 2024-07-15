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

    <div class="  colums-2 inline-block md:flex">
        <div class=" px-4">
            <x-chat.chat-users :$users :$unreadCount />
        </div>
    
        <div class="  block border border-gray-400 bg-white rounded-md ml-4 w-full">
            <div class=" items-center flex gap-4 bg-gray-500 rounded-md w-full text-white">
                <div class=" mx-4 flex-shrink-0">
                    <img class="w-8 h-8 rounded-full" src=" {{ asset($user->profile_uri ? 'storage/'.$user->profile_uri : 'images/user1.png') }}" alt="Neil image">
                 </div>
                <div >
                    <span class=" font-bold py-2 px-4 w-full ">
                        <b>{{ $user->name }} ({{ $messages->count() }})</b>
                    </span>
                    <div>
                        <span class=" text-white text-sm italic">{{ $user->email }}</span>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white">
                @forelse ($messages as $msg)

                <div>
                    <x-chat.chat-bulle :message="$msg" />
                </div>
                
                @empty
                    <x-aucun class=" font-bold ">
                        <div class="block text-center">
                            <img src="{{ asset('icone/chat-round-dots-svgrepo-com.svg') }}" alt="" srcset="" class=" max-w-32 mx-auto ">
                            <p>Aucune Conversation</p>
                        </div>
                    </x-aucun>
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