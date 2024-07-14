@extends('layout')

@section('title','Esi-School | exercice - correction')

@section('content')


    <div class="bg-white border shadow-md px-4 py-2 mx-4 my-4">
        <div>
            <h3 class="text-2xl font-semibold"> Correction de l'exercice: {{ $exercice->title }}</h3>
            <p>
                {{ $exercice->description }}
            </p>
            <form >
                @foreach ($exercice->questions as $Qkey=>$question)
                    <div class=" my-4">
                        @if (array_key_exists("options",$question))
                            
                            <h4 class="text-xl">{{ $loop->index +1 }}°) {{ $question['question_text'] }}</h4>
                        
                            <table>
                                @foreach ($question['options'] as $key=>$option)
                                    @switch(App\Helpers\TypeQuestion::typeQuestion($question))
                                        @case(1)
                                            <tr class="  gap-4 items-center">
                                               <td>
                                                    @if (array_key_exists("question_{$Qkey}",$data))
                                                        @if ($data["question_{$Qkey}"]==$option['response_text'] and $option['is_correct'] )
                                                            <img src="{{ asset('icone/true_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                                        @elseif (($data["question_{$Qkey}"]==$option['response_text'] and !$option['is_correct']) or ($data["question_{$Qkey}"]!=$option['response_text'] and $option['is_correct']))
                                                            <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                                        @endif
                                                    @elseif (!$option['is_correct']) 
                                                        <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                                    @endif
                                               </td>
                                                <td class="px-2">

                                                    <input type="radio" name="question_{{ $Qkey }}" id="opt_{{ $Qkey }}" @checked(array_key_exists("question_{$Qkey}",$data) and $data["question_{$Qkey}"]==$option['response_text']) disabled> 
                                                    <label for="opt_{{ $Qkey }}">{{ $option['response_text'] }}</label> 
                                                </td>
                                            </tr>
                                            @break
                                        @case(2)
                                            <tr class="  gap-4 items-center">
                                                <td>
                                                    @if (array_key_exists("question_{$Qkey}",$data))
                                                        @if (array_key_exists($key,$data["question_{$Qkey }"]))
                                                            @if ($data["question_{$Qkey }"]["$key"]=='on' and $option['is_correct'])
                                                                <img src="{{ asset('icone/true_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                                            @elseif (($data["question_{$Qkey }"]["$key"]=='on' and !$option['is_correct']) or ($data["question_{$Qkey }"]["$key"]!='on' and $option['is_correct']))
                                                                <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                                            @endif
                                                        @endif
                                                    @elseif ($option['is_correct'])
                                                        <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                                    @endif
                                                </td>
                                                <td class="xp-2">
                                                    <input type="checkbox"  id="opt_{{ $key }}" @checked(array_key_exists($key,$data["question_{$Qkey}"]) and $data["question_{$Qkey }"]["$key"]=="on")> 
                                                    <label for="opt_{{ $key }}">{{ $option['response_text'] }}</label> 
                                                </td>
                                            </tr>
                                            @break
            
                                        @case(3)
                                            <tr class="  gap-4 items-center">
                                                <td>
                                                    @if (array_key_exists("question_{$Qkey}",$data) and $data["question_{$Qkey }"]!=null)
                                                        @if (array_key_exists($key,$data["question_{$Qkey }"]))
                                                            @if (trim(strtolower($data["question_{$Qkey}"]))==trim(strtolower($option['response_text']))  and  $option['is_correct'])
                                                                <img src="{{ asset('icone/true_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                                            @elseif (($data["question_{$Qkey }"]["$key"]=='on' and !$option['is_correct']) or ($data["question_{$Qkey }"]["$key"]!='on' and $option['is_correct']))
                                                                <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                                            @endif
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('icone/false_response.png') }}" class="w-6 h-6" alt="" srcset="">
                                                    @endif
                                                </td>
                                                <td class="px-2">
                                                    <x-text-input type="text" name="question_{{ $Qkey }}" value='{{ array_key_exists("question_{$Qkey}",$data) ? $data["question_{$Qkey }"] : "" }}' /> 
                                                </td>
                                            </tr>
                                            @break
                                        @default
                                            
                                    @endswitch
                                @endforeach
                            </table>
                        @endif
                    </div>
                @endforeach
            </form>
        </div>
    </div>
    <div class=" bg-white border shadow-md px-4 py-2 mx-4 flex justify-between items-center">
        <div>
            Note :
        </div>
        <div>
            {{ $note }} sur {{ $note_total }}
        </div>

    </div>



@endsection