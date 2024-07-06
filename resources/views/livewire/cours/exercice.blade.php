<div>
    @if ($is_open)
        <div>
            <h3 class="text-2xl font-semibold"> Exercice {{ $i+1 }} : {{ $exercice->title }}</h3>
            <p>
                {{ $exercice->description }}
            </p>
            <form action="#" method="post">
                @foreach ($exercice->questions as $Qkey=>$question)
                    <div class=" my-4">
                        <h4 class="text-xl">{{ $loop->index +1 }}°) {{ $question['question_text'] }}</h4>
                        @foreach ($question['options'] as $key=>$option)
                            @switch(App\Helpers\TypeQuestion::typeQuestion($question))
                                @case(1)
                                    <div>
                                        <input type="radio" name="opt_{{ $Qkey }}" id="opt_{{ $Qkey }}" wire:model="user_responses.{{ $key }}"> 
                                        <label for="opt_{{ $Qkey }}">{{ $option['response_text'] }}</label> 
                                    </div>
                                    @break
                                @case(2)
                                    <div>
                                        <input type="checkbox" name="opt_{{ $Qkey }}" id="opt_{{ $Qkey }}"> 
                                        <label for="opt_{{ $Qkey }}">{{ $option['response_text'] }}</label> 
                                    </div>
                                    @break

                                @case(3)
                                    <div>
                                        <x-text-input type="text"/> 
                                    </div>
                                    @break
                                @default
                                    
                            @endswitch
                        @endforeach
                    </div>
                @endforeach
            </form>
            <button class="btn-primary" wire:click="correction">Corriger</button>
            <button class="btn-primary" wire:click="toggle">fermer</button>
        </div>

    @else
        <div>
            close
            <button class="btn-primary" wire:click="toggle">open</button>
        </div>
    @endif

</div>