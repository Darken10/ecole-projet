@extends('layout')

@section('content')

@props(['user'])
    <div class="flex justify-center">
        <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div>
                Pour accerder au contenu d'un cours sur e-Education il vous faudra payer une somme forfetaire
            </div>
            <div>
                <a class="btn-primary" href="{{ route('payment.payment') }}">Payer</a>
            </div>
        </div>

    </div>
@endsection

