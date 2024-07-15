@extends('layout')

@section('title','Esi-School | '.$lesson->title)

@section('content')
    <div class=" w-full bg-white text-gray-900 m-4 my-8 p-4 ">
        <div class=" mx-auto justify-center h-full  md:text-3xl sm:text-2xl" style=" opacity: 1; background-image: url({{ asset( $lesson->image_uri ? 'storage/'.$lesson->image_uri : 'images/matiere-default.jpeg') }});">
            <div class=" md:text-3xl sm:text-2xl lg:text-6xl gap-8 font-bold items-center text-center h-full py-40">
                <span class="py-4">{{ $lesson->chapitre->matiere->name }}</span> <br>
                <span class="py-4">{{ $lesson->title }}  </span>
            </div>
            
        </div>

        <div class="border border-gray-300 shadow-md w-full rounded-md my-4 py-2 pl-6 text-center">
            <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Description</h2>
            <div class="  mx-12 text-xl">
                {{ $lesson->description }}
            </div>
        </div>

        <div class=" grid lg:grid-cols-2 md:grid-cols-1 items-center">
            <div class="w-full mx-auto my-4">
                <x-cours.card-prof-profile :user="$lesson->prof"/>
            </div>
            <div>
                <x-cours.cours-statistique :$lesson />
            </div>
        </div>

        <div>
            <x-cours.objectifs_pre-requits :objectifs="$lesson->objectifs" :pre_requies="$lesson->pre_requies" />
        </div>

        <div>
            <x-cours.list_cours_section  :$lesson />
        </div>
        @if (count($lesson->contents)!=0)
            <div class="flex justify-end mx-8">
                <a href="{{ route('cours.suivre',$lesson) }}">
                    <button class="btn-primary">Suivre la leçon</button>
                </a>
            </div>
        @endif

        
    </div>
@endsection
