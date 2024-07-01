@extends('layout')

@section('title','Esi-School | '.$lesson->title)

@section('content')
    <div class=" w-full bg-white text-gray-900 m-4 my-8 p-4 ">
        <div class=" mx-auto justify-center h-full  " style=" opacity: 1; background-image: url({{ asset('images/posts/img_1.jpg') }});">
            <div class="text-6xl gap-8 font-bold items-center text-center h-full py-40">
                <span class="py-4">{{ $lesson->matiere->name }}</span> <br>
                <span class="py-4">{{ $lesson->title }}  </span>
            </div>
        </div>
        <div class="w-full mx-auto my-4">
            <x-cours.card-prof-profile :user="$lesson->prof"/>
        </div>
    </div>
@endsection
