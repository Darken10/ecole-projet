<div class=" border-b-2 pb-4">
    @switch($question->type_question_id)
    @case(1)
        <div class="flex justify-between items-center">
            <h3 class=" text-xl ml-4 my-4 ">{{ $i }}°) {{ $question->text }} ({{ $question->point }}pts)</h3>
            <div>
                <x-shared.modale-btn name="editer-question-{{ $question->id }}">
                    <img src="{{ asset('icone/editer.svg') }}" class="w-8 h-8" alt="" srcset="">
                </x-shared.modale-btn>
                <x-shared.modale :btn="False" type="input" title="Modifier une Question" name="editer-question-{{ $question->id }}" >
                    <div class=" text-lg text-black">
                        @livewire('cours.q-c-m',['question'=>$question,'evaluation'=>$evaluation], key($question->id))
                    </div>
                </x-shared.modale>
            </div>
        </div>
        @foreach ($question->responses as $response)
            <div class="ml-12">
                <input type="radio" name="question_{{ $question->id }}" id="question_{{ $response->id }}" value="{{ $response->id }}" disabled @checked($response->is_correct)  >
                <label for="question_{{ $response->id }}">{{ $response->text }}</label>
            </div> 
        @endforeach
        @break

    @case(2)
        <div class="flex justify-between items-center">
            <h3 class=" text-xl ml-4 my-4 ">{{ $i }}°) {{ $question->text }} ({{ $question->point }}pts)</h3>
            <div>
                <x-shared.modale-btn name="editer-question-{{ $question->id }}">
                    <img src="{{ asset('icone/editer.svg') }}" class="w-8 h-8" alt="" srcset="">
                </x-shared.modale-btn>
                <x-shared.modale :btn="False" type="input" title="Modifier une Question" name="editer-question-{{ $question->id }}" >
                    <div class=" text-lg text-black">
                        @livewire('cours.q-c-m',['question'=>$question,'evaluation'=>$evaluation], key($question->id))
                    </div>
                </x-shared.modale>
            </div>
        </div>
        @foreach ($question->responses as $response)
            <div class="ml-12">
                <input type="checkbox"  name="question_{{ $question->id }}" id="question_{{ $response->id }}" value="{{ $response->id }}" disabled @checked($response->is_correct)  >
                <label for="question_{{ $response->id }}">{{ $response->text }}</label>
            </div> 
        @endforeach
        @break

    @case(3)
        <div class="flex justify-between items-center">
            <h3 class=" text-xl ml-4 my-4 ">{{ $i }}°) {{ $question->text }} ({{ $question->point }}pts)</h3>
            <div>
                <x-shared.modale-btn name="editer-question-{{ $question->id }}">
                    <img src="{{ asset('icone/editer.svg') }}" class="w-8 h-8" alt="" srcset="">
                </x-shared.modale-btn>
                <x-shared.modale :btn="False" type="input" title="Modifier une Question" name="editer-question-{{ $question->id }}" >
                    <div class=" text-lg text-black">
                        @livewire('cours.question-ouverte',['question'=>$question,'evaluation'=>$evaluation], key($question->id))
                    </div>
                </x-shared.modale>
            </div>
        </div>
        <x-textarea-input disabled='disabled'>{{ $question->responses->last()->text ?? "" }}</x-textarea-input>
        @break                        
@endswitch

</div>