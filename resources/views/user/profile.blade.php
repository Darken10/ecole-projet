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
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
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
            <div class="flex mt-4 md:mt-6">
                <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add friend</a>
                <a href="#" class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Message</a>
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

                        <div class="py-2 flex flex-row items-center justify-between">
                            <a href="{{ route('cours.like',$lesson) }}" class="no-underline"> {{-- love --}}
                              <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg">
                                 <x-cours.love-icone is_love :number="$lesson->count_likes()"/> 
                              </button>
                            </a>
                            <a href="" class="no-underline"> {{-- vue --}}
                                <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg> 
                                    <span class="ml-1">{{ $lesson->count_views() }}</span> 
                                </button>
                            </a>  
                            <a  class="text-gray-900" style="text-decoration: none"> {{-- appreciation --}}
                                <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
                                  <x-shared.rating :appreciation="$lesson->apreciation()" />
                                </button>
                              </a>
                          </div>
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