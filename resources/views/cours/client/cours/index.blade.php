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
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur repellendus cum debitis ab tenetur rerum earum similique. Pariatur cumque illum tempore veritatis aperiam molestiae repudiandae sapiente quia quaerat, magni beatae.
    
    <div class="bg-white m-4 p-8 shadow-sm" >
        <x-cours.accordeon-cours />
    </div>
@endsection

@section('script')
    <script>
        jQuery(document).ready(function($) {
        /*$('.loop').owlCarousel({
            center: true,
            items: 2,
            loop: true,
            margin: 10,
            responsive: {
            600: {
                items: 4
            }
            }
        });*/
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