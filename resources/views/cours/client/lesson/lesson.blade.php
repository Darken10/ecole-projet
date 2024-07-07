@extends('layout')

@section('title',"Esi-School | {$lesson->title}")

@section('content')
@if($content!=null)
<div class=" mt-8 my-4 bg-white p-4 rounded-md shadow-sm ">
    <h3 class=" text-2xl font-semibold">Section {{ $content?->numero_section }} : {{ $content?->section_title }}</h3>
    <div>
        {!! $content->content !!}
    </div>
    
    <div class="my-8 border-t-2 py-4">
        @foreach ($content->exercices as $exo)
            <x-cours.exercice :$lesson :exercice="$exo" :i="$loop->index"  />
            {{-- @livewire('cours.exercice',['exercice'=>$exo,'i'=>$loop->index],key($exo->id)) --}}
        @endforeach
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

<div class=" mt-8 my-4 bg-white p-4 rounded-md shadow-sm ">
    Poser une question sur le cours
    <div>
        @foreach ($lesson->user_questions as $uquestion)
            <x-cours.question-bulle :$uquestion />
        @endforeach
    </div>
    <div>
        <form action="{{ route('cours.user_question',$lesson) }}" method="post">
            @csrf
            <div class=" ">
                <x-input-label for="question">La Question</x-input-label>
                <x-textarea-input name="question" id="question" placeholder="Poser votre question" />
            </div>
            <div>
                <button class="btn-primary">Envoyer</button>
            </div>
        </form>
    </div>
</div>
@else
<x-aucun>Aucun Contenu</x-aucun>
@endif
@endsection