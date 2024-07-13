@extends('layout')

@section('title','Evaluation')

@section('content')

    <div>
        @forelse ($evaluations as $evaluation)
        @php
            $soumitions = $evaluation->soumitions()->where('user_id',auth()->user()->id)->get();
        @endphp
        <div class=" bg-white p-4 rounded-lg shadow-lg my-2">
                <div>
                    <h3 class=" text-2xl font-semibold">Evaluation {{ $loop->index +1 }} : {{ $evaluation->title }}</h3>
                    <p>
                        {{ $evaluation->description }}
                    </p>
                    <p class="gap-4 text-gray-600 text-sm italic">
                        <span class="mx-2 ">cote : {{ $evaluation->cote }}</span>
                        <span class="mx-2 ">durée : {{ $evaluation->time }}</span>
                    </p>
                    @if (count($soumitions)!=0)
                        <div class=" font-semibold text-gray-700 ">
                            <span>Note : </span>
                            <span>{{ $soumitions->last()->note }} sur {{ $soumitions->last()->evaluation->note_max() }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex justify-end mr-4">
                    
                    @if (count($soumitions)==0)
                        <a class="btn-primary" href="{{ route('cours.evaluation',$evaluation) }}" >Commencer</a>
                    @else
                        <a class="btn-primary" href="{{ route('cours.evaluation_voir',$evaluation) }}" >Voir</a>
                    @endif
                </div>
        </div>
            
        @empty
            <x-aucun class=" font-bold">Aucune evaluation Disponible</x-aucun>
        @endforelse
    </div>
@endsection