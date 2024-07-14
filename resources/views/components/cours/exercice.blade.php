@props(['lesson','exercice','i'])
<div>
    <div>
        <h3 class="text-2xl font-semibold"> Exercice {{ $i+1 }} : {{ $exercice->title }}</h3>
        <p>
            {{ $exercice->description }}
        </p>
        <form  action="{{ route('cours.exercice_corretion',$exercice) }}" method="Post">
            @csrf
            @foreach ($exercice->questions as $Qkey=>$question)
                <div class=" my-4">
                    <h4 class="text-xl">{{ $loop->index +1 }}°) {{ $question['question_text'] }}</h4>
                    @foreach ($question['options'] as $key=>$option)
                        @switch(App\Helpers\TypeQuestion::typeQuestion($question))
                            @case(1)
                                <div>
                                    <input type="radio" name="question_{{ $Qkey }}" id="opt_{{ $Qkey }}" value="{{ $option['response_text'] }}"> 
                                    <label for="opt_{{ $Qkey }}">{{ $option['response_text'] }}</label> 
                                </div>
                                @break
                            @case(2)
                                <div>
                                    <input type="checkbox" name="question_{{ $Qkey }}[{{ $key }}]" id="opt_{{ $key }}"> 
                                    <label for="opt_{{ $key }}">{{ $option['response_text'] }}</label> 
                                </div>
                                @break

                            @case(3)
                                <div>
                                    <x-text-input type="text" name="question_{{ $Qkey }}" /> 
                                </div>
                                @break
                            @default
                                
                        @endswitch
                    @endforeach
                </div>
            @endforeach
            <button type="submit" class="btn-primary" >Corriger</button>
        </form>
    </div>
</div>