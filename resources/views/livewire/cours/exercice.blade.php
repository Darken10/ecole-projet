<div>
    @if ($is_open)
        <div>
            <h3 class="text-2xl font-semibold"> Exercice {{ $i+1 }} : {{ $exercice->title }}</h3>
            <p>
                {{ $exercice->descriptions }}
            </p>
            <form action="#" method="post">
                @foreach ($exercice->questions as $question)
                    <div class=" my-4">
                        <h4 class="text-xl">{{ $loop->index +1 }}°) {{ $question['question_text'] }}</h4>
                        @foreach ($question['options'] as $option)
                            <div>
                                <input type="radio" name="" id=""> 
                                <label for="">{{ $option['response_text'] }}</label> 
                                {{--@dump($option)--}}
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </form>
            <button class="btn-primary" wire:click="toggle">fermer</button>
        </div>

    @else
        <div>
            close
            <button class="btn-primary" wire:click="toggle">open</button>
        </div>
    @endif

</div>