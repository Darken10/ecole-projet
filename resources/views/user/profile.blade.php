@extends('layout')

@section('title','profile')

@section('content')
<div class="flex justify-center">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-4">
            <button id="dropdownButton" data-dropdown-toggle="dropdown" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                <li>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Editer</a>
                </li>
                <li>

                    <a href="{{ route('user.profile.reset-password') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Modifier password</a>
                </li>
                <li>
                    <x-shared.modale-btn name="user-delete-modal">
                        <a  class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">supprimer</a>
                    </x-shared.modale-btn>
                </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col items-center pb-10">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset(auth()->user()->profile_uri ?? 'images/user1.png') }}" alt="Bonnie image"/>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</span>
            <div>
                {{-- <div class=" text-gray-700 font-semibold mb-2">
                    Nom :
                </div>
                <input type="text" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 " value="ZERBO"> --}}
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
                        <td class=" flex justify-end font-semibold">Niveau </td>
                        <td class="px-1">:</td>
                        <td>{{ $user->niveau->name }}</td>
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
        @foreach ($user->lessons as $lesson)
           <div class="border-t border-b border-gray-300 flex gap-2 items-center">
                <div class=" w-16 ">
                    <img  src="{{ asset($lesson->image_uri ?? 'images/matiere-default.jpeg') }}" class="rounded-md">
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

<x-shared.modale :btn="False" title="Information de l'elève" name="user-delete-modal" type="alert">
    <div class=" text-lg text-black">
       Entrer votre mot de passe pour supprimer ce compt <br>
    </div>
    <div class="mt-4">
        <form action="{{ route('profile.destroy') }}" method="post" class="flex justify-between">
            @csrf
            @method('DELETE')
            <div class="block w-full">
                <div class="w-full text-start">
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" class="w-full " name="password" type="password" class="mt-1 block w-full"  required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>
                <div class=" mt-4 flex justify-between">
                    <button data-modal-hide="user-delete-modal" type="reset" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Anuller</button>
                    <button data-modal-hide="user-delete-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
</x-shared.modale>
@endsection