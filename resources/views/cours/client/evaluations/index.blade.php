@extends('layout')

@section('title','Evaluation')

@section('content')
    <div class="my-4 shadow-lg rounded-md">
        <div class="p-4 rounded-md flex justify-between">
            <h3 class=" text-2xl ">Evaluation de {{ $evaluation->lesson->matiere->name }}</h3>
            <h3 class=" text-2xl ">La Durée {{ $evaluation->time}}</h3>
        </div>
        <div class="p-4 bg-white ">
            <livewire:cours.correction evaluation_id="{{ $evaluation->id }}"  />
        </div>
    </div>
@endsection