@php
    $i=1;
    $totalPoint=0;
@endphp
<div>
    @if ($soumissions->isEmpty())
        <form wire:submit="valider" action="{{ route('evaluation.correction',$evaluation) }}" method="post">
            @csrf
            @foreach ($evaluation->questions as $question)
                <div>
                    <div class="flex justify-between">
                        <h3 class=" text-xl ml-4 my-4 ">{{ $i }}°) {{ $question->text }} ({{ $question->point }}pts)</h3>
                    </div>
                    @switch($question->type_question_id)
                        @case(1)
                            @foreach ($question->responses as $response)

                                <div class="ml-12">
                                    <input type="radio" wire:model="responses.{{ $question->id }}" 
                                            id="question_{{ $response->id }}" value="{{ $response->id }}"  
                                    <label for="question_{{ $response->id }}">{{ $response->text }}</label>
                                </div> 
                            @endforeach
                            @break
                
                        @case(2)
                            @foreach ($question->responses as $response)
                                <div class="ml-12">
                                    <input type="checkbox" wire:model="responses.{{ $question->id }}.{{ $response->id }}" name="question_{{ $question->id }}" id="question_{{ $response->id }}" value="{{ $response->id }}"    >
                                    <label for="question_{{ $response->id }}">{{ $response->text }}</label>
                                </div> 
                            @endforeach
                            @break
                        @case(3)
                            <x-textarea-input wire:model="responses.{{ $i }}" ></x-textarea-input>
                            @break                        
                    @endswitch
                </div>
                @php
                    $i++;
                    $totalPoint += $question->point
                @endphp
            @endforeach
            
            <x-btn-primary type="submit">Valider</x-btn-primary>
        </form>

    @else
        <div>
            @foreach ($evaluation->questions as $question)
                
            <div>
                <div class="flex justify-between">
                    <h3 class=" text-xl ml-4 my-4 ">{{ $i }}°) {{ $question->text }} ({{ $question->point }}pts)</h3>
                </div>
                @switch($question->type_question_id)
                    @case(1)
                        @foreach ($question->responses as $response)
                            @php
                                $user_response = $question->corriger()->where('soumission_id',$soumission->id)->get()->last()->response_id ?? 0;
                            @endphp
                            <div class=" ml-12  flex items-center my-2 gap-4">
                                <div>
                                    @if ($d = $response->is_correct)
                                        @if ($user_response == $response->id)
                                            <img src="{{ asset('icone/true_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                        @else
                                            <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                        @endif
                                    @else
                                        @if ($d = $user_response == $response->id)
                                            <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                        @endif
                                    @endif
                                </div>            
                                <div @class(['inline', 'pl-6' => !$d])>
                                    <input type="radio"  
                                            id="question_{{ $response->id }}" value="{{ $response->id }}"  
                                            @disabled(true)
                                            @checked($question->corriger()->where('soumission_id',$soumission->id)->get()->last()?->response_id == $response->id)>
                                    <label for="question_{{ $response->id }}">{{ $response->text }}</label>
                                </div> 
                            </div>
                        @endforeach
                        @break
            
                    @case(2)
                        
                        @foreach ($question->responses as $response)
                            @php
                                $user_response = $question->corriger()->where('soumission_id',$soumission->id )->get()->last()?->response->pluck('is_correct','id')->toArray() ?? [];
                            @endphp
                            <div class="ml-12  flex items-center my-2 gap-4"> 
                                <div>
                                    @if ($d = $response->is_correct)
                                        @if ($d = key_exists($response->id,$user_response))
                                            <img src="{{ asset('icone/true_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                        @else
                                            <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                        @endif
                                    @else
                                        @if ($d = key_exists($response->id,$user_response))
                                            <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                        @endif
                                    @endif
                                </div>
                                <div  @class(['inline', 'pl-6' => !$d])>
                                    <input type="checkbox"  name="question_{{ $question->id }}" 
                                            id="question_{{ $response->id }}" value="{{ $response->id }}"  
                                            @disabled(true) 
                                            @checked(key_exists($response->id,$user_response))>
                                    <label for="question_{{ $response->id }}">{{ $response->text }}</label>
                                </div> 
                            </div>
                        @endforeach
                        @break
                    @case(3)
                        @php
                            $response = $question->responses->last();
                            //dd($question->responses->last());
                            $user_response = $question->corriger()->where('soumission_id',$soumission->id)->get()->last()->response_text ?? "";
                        @endphp

                        <div class="ml-12  flex items-center my-2 gap-4">
                            <div>
                                @if ($response->is_correct and trim(strtolower($response->text)) == trim(strtolower($user_response)) )
                                    <img src="{{ asset('icone/true_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                @else
                                    <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                @endif
                            </div>
                            <x-textarea-input   >{{ $user_response }}</x-textarea-input>    
                        </div>
                        @break                        
                @endswitch
            </div>
                @php
                    $i++;
                    $totalPoint += $question->point
                @endphp
            @endforeach
            <div  class="text-xl font-semibold my-4 border-t-2 border-gray-500 flex justify-between mx-4">
                <span>Totale Points</span>
                <span >{{ $soumission->note }} / {{ $totalPoint }} ({{ $soumission->note/$totalPoint *100  }}%)</span>
            </div> 
        </div>
    @endif
</div>

