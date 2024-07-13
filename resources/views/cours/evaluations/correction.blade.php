@extends('layout')


@section('content')
    <div class=" my-4 bg-white border shadow-md px-4 py-2 mx-4  items-center mp-4 "> {{-- la note --}}
        <div class="flex justify-center mt-2 text-center w-full uppercase">
            <h3 class=" text-2xl align-middle underline font-semibold"> Devoir : {{ $soumition->evaluation->title }}</h3>
        </div>
        <div class="flex justify-between mx-4">
            <div>
                <p class="font-semibold">Matiere</p>
                <p>{{  $soumition->evaluation->lesson->chapitre->matiere->name }}</p>
            </div>
            <div>
                <p class="font-semibold">Niveau</p>
                <p>{{  $soumition->evaluation->lesson->chapitre->niveau->name }}</p>
            </div>
            <div>
                <p class="font-semibold">Temps</p>
                <p>{{ $soumition->evaluation->time }}</p>
            </div>
        </div>
        <div class="flex justify-between mx-4">
            <div>
                <p class="font-semibold">Chapitre</p>
                <p>{{  $soumition->evaluation->lesson->chapitre->title }}</p>
            </div>
            <div>
                <p class="font-semibold">Leçon</p>
                <p>{{  $soumition->evaluation->lesson->title }}</p>
            </div>
        </div>
        <div>

        </div>
    </div>
    <div class="bg-white border shadow-md px-4 py-2 mx-4 my-4">
        
        @forelse ($soumition->evaluation->questions as $question)
            @php
                $justification = ''
            @endphp
            <div class=" border-b-2 pb-4">
                <div class=" justify-between items-center">
                    <h3 class=" text-xl ml-4 my-4 ">{{ $loop->index+1 }}°) {{ $question->text }} ({{ $question->point }}pts)</h3>
                        <table class="ml-12 flex items-center gap-2 ">
                        @switch(App\Models\Cours\Question::type_question($question))
                            @case(1)
                                    @foreach ($question->options as $option_id=>$option)                                   
                                            <tr>
                                                <td class="px-1">
                                                    @if ($soumition->response["question_{$question->id}"]==$option['text'] and $option['is_correct'] )
                                                        @php
                                                            $justification = $option['justification']
                                                        @endphp
                                                        <img src="{{ asset('icone/true_response.png') }}" class="w-6 h-6" >
                                                    @elseif (($soumition->response["question_{$question->id}"]==$option['text'] and !$option['is_correct']) or ($soumition->response["question_{$question->id}"]!=$option['text'] and $option['is_correct']))
                                                        <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                                    @endif
                                                </td>
                                                <td class="px-1">
                                                    <input type="radio"  id="option_{{ $option_id }}" disabled @checked($soumition->response["question_{$question->id}"]==$option['text']) >
                                                    <label for="option_{{ $option_id }}">{{ $option['text'] }}</label>
                                                </td>
                                            </tr>
                                    @endforeach
                                @break
        
                            @case(2)
                                @foreach ($question->options as $option)
                                    <tr>
                                        <td class="px-1">
                                            @php
                                                $good = null;
                                                $cochet = False;
                                                foreach ($soumition->response["question_{$question->id}"] as $item) {
                                                    
                                                    if ($item == $option['text']) {
                                                        $cochet = True;
                                                        $good = $option['is_correct'] ? True : False;
                                                    }
                                                }
                                            @endphp
                                            @if ($good==True)
                                                @php
                                                    $justification = $option['justification']
                                                @endphp
                                                <img src="{{ asset('icone/true_response.png') }}" class="w-6 h-6" >
                                            @elseif ($good==null and $option['text'])
                                                <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                            @else
                                                <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                            @endif
                                        </td>
                                        <td class="px-1">
                                            <input type="checkbox"  id="option_{{ $option_id }}" @checked($cochet)  >
                                            <label for="option_{{ $option_id }}">{{ $option['text'] }}</label>
                                        </td> 
                                    </tr>
                                @endforeach
                                @break
                            @case(3)
                                    <tr>
                                        <td class="px-1">
                                                @php
                                                    $justification = $question->options[0]['justification']
                                                @endphp
                                            @if ($soumition->response["question_{$question->id}"] == $question->options[0]['text'])
                                                
                                                <img src="{{ asset('icone/true_response.png') }}" class="w-6 h-6" >
                                            @else
                                                <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                            @endif
                                        </td>
                                        <td class="px-1">
                                            <x-textarea-input >{{ $soumition->response["question_{$question->id}"] }}</x-textarea-input>
                                        </td>
                                    </tr>
                                @break                        
                        @endswitch
                    </table>
                </div>
            @if ($justification != ''){{-- La justification --}}
                <div class=" pt-4 text-sm italic text-gray-600"> 
                    Justification :  {{ $justification ?? null }}
                </div>
            @endif
            </div>
            
        @empty
            <x-aucun>Aucune Question pour cette evaluation</x-aucun>
        @endforelse

        <div class=" my-4 bg-white border shadow-md px-4 py-2 mx-4 flex justify-between items-center mp-4 font-semibold"> {{-- la note --}}
            <span>Note : </span>
            <span>{{ $soumition->note }} sur {{ $soumition->evaluation->note_max() }}</span>
        </div>
    </div>

@endsection
