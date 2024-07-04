@extends('layout')

@section('title',"Esi-School | {$lesson->title}")

@section('content')
<div class=" mt-8 my-4 bg-white p-4 rounded-md shadow-sm ">
    <h3 class=" text-2xl font-semibold">Section {{ $content->numero_section }} : {{ $content->section_title }}</h3>
    <div>
        {!! $content->content !!}
    </div>
    
    <div class="my-8 border-t-2 py-4">
        Exercices
    </div>

    <div class="flex justify-between">
        @if ($prev_content!=null)
            <a href="{{ route('cours.sectionSuivante',[$lesson,$prev_content,$numero-2]) }}">
                <button class="btn-secondary">Arrière</button>  
            </a>
        @endif

        @if ($next_content!=null)
            <a href="{{ route('cours.sectionArriere',[$lesson,$next_content,$numero]) }}">
                <button class="btn-primary">Suivant</button>  
            </a>
        @endif
    </div>
</div>

@endsection