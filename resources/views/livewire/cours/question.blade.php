<form wire:submit="soumettre">
    @forelse ($evaluation->questions as $question)
        <div class=" border-b-2 pb-4">
            <div class="flex justify-between items-center">
                <h3 class=" text-xl ml-4 my-4 ">{{ $loop->index+1 }}°) {{ $question->text }} ({{ $question->point }}pts)</h3>
                @switch(App\Models\Cours\Question::type_question($question))
                    @case(1)
                        @foreach ($question->options as $option_id=>$option)
                            <div class="ml-12">
                                <input type="radio" wire:model="answers.question_{{ $question->id }}" value="{{ $option_id }}" name="answers.question_{{ $question->id }}" id="option_{{ $option_id }}">
                                <label for="option_{{ $option_id }}">{{ $option['text'] }}</label>
                            </div> 
                        @endforeach
                        @break

                    @case(2)
                        @foreach ($question->options as $option)
                            <div class="ml-12">
                                <input type="checkbox" wire:model="answers.question_{{ $question->id }}"  name="answers.question_{{ $question->id }}" id="option_{{ $option_id }}" value="{{ $option_id }}"  >
                                <label for="option_{{ $option_id }}">{{ $option['text'] }}</label>
                            </div> 
                        @endforeach
                        @break
                    @case(3)
                        <x-textarea-input wire:model="answers.question_{{ $question->id }}"></x-textarea-input>
                        @break                        
                @endswitch
            </div>
        </div>
    @empty
        <x-aucun>Aucune Question pour cette evaluation</x-aucun>
    @endforelse
    <button class="btn-primary" type="submit">soumettre</button>
</form>
