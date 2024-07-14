@extends('layout')

@section('title','Evaluation')

@section('content')
@if ($evaluation->id != null)
    <div class=" my-4 bg-white border shadow-md px-4 py-2 mx-4  items-center mp-4 "> {{-- la note --}}
        <div class="flex justify-center mt-2 text-center w-full uppercase">
            <h3 class=" text-2xl align-middle underline font-semibold"> Devoir : {{ $evaluation->title }}</h3>
        </div>
        <div class="flex justify-between mx-4">
            <div>
                <p class="font-semibold">Matiere</p>
                <p>{{  $evaluation->lesson->chapitre->matiere->name }}</p>
            </div>
            <div>
                <p class="font-semibold">Niveau</p>
                <p>{{  $evaluation->lesson->chapitre->niveau->name }}</p>
            </div>
            <div>
                <p class="font-semibold">Duré</p>
                <p>{{ $evaluation->time }}</p>
            </div>
        </div>
        <div class="flex justify-between mx-4">
            <div>
                <p class="font-semibold">Chapitre</p>
                <p>{{  $evaluation->lesson->chapitre->title }}</p>
            </div>
            <div>
                <p class="font-semibold">Leçon</p>
                <p>{{  $evaluation->lesson->title }}</p>
            </div>
            
        </div>
        <div>

        </div>
    </div>
    <div class="bg-white border shadow-md px-4 py-2 mx-4 my-4">
        <form id="myForm" method="POST" action="{{ route('cours.soumettre',$evaluation) }}">
            @csrf
            @forelse ($evaluation->questions as $question)
                <div class=" border-b-2 pb-4">
                    <div class=" justify-between items-center">
                        <h3 class=" text-xl ml-4 my-4 ">{{ $loop->index+1 }}°) {{ $question->text }} ({{ $question->point }}pts)</h3>
                        @switch(App\Models\Cours\Question::type_question($question))
                            @case(1)
                                @foreach ($question->options as $option_id=>$option)
                                    <div class="ml-12">
                                        <input type="radio" wire:model="answers.question_{{ $question->id }}" value="{{ $option['text'] }}" name="question_{{ $question->id }}" id="option_{{ $option_id }}">
                                        <label for="option_{{ $option_id }}">{{ $option['text'] }}</label>
                                    </div> 
                                @endforeach
                                @break
        
                            @case(2)
                                @foreach ($question->options as $option)
                                    <div class="ml-12">
                                        <input type="checkbox" wire:model="answers.question_{{ $question->id }}"  name="question_{{ $question->id }}[]" id="option_{{ $option_id }}" value="{{ $option['text'] }}"  >
                                        <label for="option_{{ $option_id }}">{{ $option['text'] }}</label>
                                    </div> 
                                @endforeach
                                @break
                            @case(3)
                                <x-textarea-input name="question_{{ $question->id }}" wire:model="answers.question_{{ $question->id }}"></x-textarea-input>
                                @break                        
                        @endswitch
                    </div>
                </div>
            @empty
                <x-aucun>Aucune Question pour cette evaluation</x-aucun>
            @endforelse
            <button class="btn-primary" type="submit">soumettre</button>
        </form>
        
    </div>
    <div id="temps" class=" bg-white text-gray-900 font-semibold px-8 py-4 fixed bottom-4 right-4 text-3xl shadow-xl font-mono rounded-lg border-2 border-gray-700 ">
        
    </div>

    <script>
    // Function to start the countdown
    function startCountdown(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            heures = parseInt(timer / 3600, 10);
            minutes = parseInt((timer % 3600)/60, 10);
            seconds = parseInt(timer % 60, 10);

            heures = heures < 10 ? "0" + heures : heures;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            

            display.textContent = heures + ':' + minutes + ":" + seconds;

            if (--timer < 0) {
                timer = 0;
                document.getElementById("myForm").submit(); // Submit the form when timer reaches 0
            }
        }, 1000);
    }

    // When the page is loaded
    document.addEventListener("DOMContentLoaded", function () {
        const t = @js($evaluation->time).toString().split(':')
        const h = parseInt(t[0], 10);
        const m = parseInt(t[1], 10);
        const s = parseInt(t[2], 10);
        var fiveMinutes =  h*3600+m*60+s, // Adjust the countdown time in seconds here
            display = document.querySelector('#temps');
        startCountdown(fiveMinutes, display);
    });
    
    </script>
@endif
@endsection


