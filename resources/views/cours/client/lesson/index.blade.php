@extends('layout')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
@endsection

@section('content')

    <div>
        <x-carroucel />
    </div>

    @if(count($lessons_order)>0)
    <section>
        <h2 class="text-2xl">Les plus vue</h2>
        <div class="bg-white m-4 p-8 shadow-sm mx-auto " >
            @forelse ($lessons_order as $lesson)
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
    </section>
    @endif
    <div class="bg-white m-4 p-8 shadow-sm" >
        <x-cours.accordeon-cours :$matieres/>
    </div>
@endsection

@section('script')
    <script>
        jQuery(document).ready(function($) {
        $('.nonloop').owlCarousel({
            center: true,
            items: 1,
            loop: false,
            margin: 10,
            responsive: {
            600: {
                items: 3
            }
            }
        });
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection