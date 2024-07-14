@extends('layout')

@section('content')

    <div class="bg-white m-4 p-8 shadow-sm mx-auto " >
        @forelse ($lessons as $lesson)
        <div class="my-4 flex  items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <img src="{{ asset($lesson->image_uri ?? 'images/matiere-default.jpeg')  }}" class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"  alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                    <a href="{{ route('cours.show',$lesson) }}" class="">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $lesson->title }}</h5>
                    </a>
                    <div>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{ Str::limit($lesson->description,70) }}
                        </p>
                        <x-like-view-rating :$lesson />
                    </div>
                    
                </div>
        </div>
        @empty
            <x-aucun>AUCUNE LECON</x-aucun>
        @endforelse
    </div>
@endsection
