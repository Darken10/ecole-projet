@extends('layout')

@section('title','Esi-School | '.$lesson->title)

@section('content')
    <div class=" w-full bg-white text-gray-900 m-4 my-8 p-4 ">
        <div class=" mx-auto justify-center h-full  md:text-3xl sm:text-2xl" style=" opacity: 1; background-image: url({{ asset('images/posts/img_1.jpg') }});">
            <div class=" md:text-3xl sm:text-2xl lg:text-6xl gap-8 font-bold items-center text-center h-full py-40">
                <span class="py-4">{{ $lesson->chapitre->matiere->name }}</span> <br>
                <span class="py-4">{{ $lesson->title }}  </span>
            </div>
        </div>
        <div class=" grid lg:grid-cols-2 md:grid-cols-1 items-center">
            <div class="w-full mx-auto my-4">
                <x-cours.card-prof-profile :user="$lesson->prof"/>
            </div>
            <div>
                <x-cours.cours-statistique />
            </div>
        </div>
        {{--<div class=" grid lg:grid-cols-2 md:grid-cols-1 items-center">
            <div>
                <x-cours.objectif :objectifs="$lesson->objectifs" />
            </div>
            <div>
                <x-cours.pre-requit :$lesson />
            </div>
        </div>--}}
        <div>
            <x-cours.objectifs_pre-requits :objectifs="$lesson->objectifs" :pre_requies="$lesson->pre_requies" />
        </div>

        <div>
            <x-cours.list_cours_section  :$lesson />
        </div>

        <div class="flex justify-end mx-8">
            <a href="{{ route('cours.suivre',$lesson) }}">
                <button class="btn-primary">Suivre la leçon</button>
            </a>
        </div>
    </div>
@endsection
