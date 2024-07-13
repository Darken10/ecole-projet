@extends('layout')

@section('title',"Esi-School | {$lesson->title}")

@section('content')
    @if($content!=null)
        @livewire('cours.section', ['content' => $content], key($content->id))

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