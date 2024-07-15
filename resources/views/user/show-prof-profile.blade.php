@extends('layout')

@section('title','prof profile')

@section('content')
<div class="flex justify-center">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col items-center pb-10">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset($user->profile_uri ? 'storage/'.$user->profile_uri : 'images/user1.png') }}" alt="Bonnie image"/>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</span>
            <div>
                <table class="mt-4">
                    <tr class="mx-4 my-1">
                        <td class=" flex justify-end px-2 font-semibold">Née le </td>
                        <td class="px-1">:</td>
                        <td>{{ $user->date_naissance->format("d/m/Y") }}</td>
                    </tr>
                    <tr class="mx-4 my-1">
                        <td class=" flex justify-end font-semibold">Genre </td>
                        <td class="px-1">:</td>
                        <td>{{ $user->sexe }}</td>
                    </tr>
                    <tr class="mx-4 my-1">
                        <td class=" flex justify-end font-semibold">Statut </td>
                        <td class="px-1">:</td>
                        <td>{{ $user->statut->name }}</td>
                    </tr>
                </table> 
            </div>
            
        </div>
    </div>
</div>

{{-- mes cours --}}
<div class="flex justify-center mt-4">
    <div class=" p-4 w-full max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h3 class="text-2xl font-semibold mb-2 flex justify-center ">Mes cours</h3>
        @foreach ($user->lessonsCreated as $lesson)
           <div class="border-t border-b border-gray-300 flex gap-2 items-center">
                <div class=" w-16 ">
                    <img  src="{{ asset($lesson->image_uri ? 'storage/'.$lesson->image_uri : 'images/matiere-default.jpeg') }}" class="rounded-md">
                </div>
                <div>
                    <a href="{{ route('cours.show',$lesson) }}">
                        <h3 class="text-xl font-semibold ">{{ $lesson->title }}</h3>
                        <div class=" text-gray-600 text-sm italic">
                            <span class=" font-semibold">{{ $lesson->chapitre->matiere->name }}</span> : {{ $lesson->chapitre->title }}
                        </div>
                    </a>
                    <div class="mx-4">

                        <x-like-view-rating :$lesson />
                    </div>
                </div>
           </div>
        @endforeach
    </div>
</div>


@endsection