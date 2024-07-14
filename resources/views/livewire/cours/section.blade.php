@props(['content'])

<div class=" mt-8 my-4 bg-white p-4 rounded-md shadow-sm ">
    <div>
        <input type="range"  value="{{ $number_section_finished *100 / count($all_contents) }}" disabled class="w-full">
    </div>
    <h3 class=" text-2xl font-semibold">Section {{ $content->numero_section }} : {{ $content->section_title }}</h3>
    <div>
        {!! $content->content !!}
    </div>
    
    <div class="my-8 border-t-2 py-4">
        @foreach ($content->exercices as $exo)
            <x-cours.exercice :lesson="$content->lesson" :exercice="$exo" :i="$loop->index"  />
            {{-- @livewire('cours.exercice',['exercice'=>$exo,'i'=>$loop->index],key($exo->id)) --}}
        @endforeach
    </div>

    <div class="flex justify-between">
        @if ($has_prev)
            <button class="btn-secondary justify-start" wire:click="prev" >Precedente</button>
        @endif
        @if ($has_next)
            <button class="btn-primary justify-end" wire:click="next">Suivant</button>
        @endif
    </div>
    @if ($number_section_finished == count($all_contents))
        <a class="btn-primary justify-end" href="{{ route('cours.evaluation.list',$content->lesson) }}" >Les Evaluations</a>
    @endif

    <div>
        {{-- <x-cours.ratting :lesson="$content->lesson" /> --}}

        <livewire:cours.rating :lesson="$content->lesson" />

    </div>
</div>