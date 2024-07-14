@props(['chapitre'])

@foreach ($chapitre?->lessons as $lesson)
    @if (count($lesson->contents)>0)
        <div class="w-full  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="{{ asset('images/posts/img_10.jpg') }}" alt="product image" />
            </a>
            <div class="px-5 pb-5">
            <a href="{{ route('cours.show',$lesson) }}">
                <h5 class=" text-xs md:text-sm mt-2 text-md font-semibold tracking-tight text-gray-900 dark:text-white">
                    <span>{{ $lesson->chapitre->matiere->name }} : </span>
                    <span>{{ $lesson->title }}</span>

                </h5>
            </a>
            <div>
                <p class=" text-xs md:text-sm">
                    {{ Str::limit($lesson->description,100) }}
                </p>
            </div>
            
                <x-shared.rating :appreciation="$lesson->apreciation() ?? 0" />

            <div class="flex items-center justify-between">
                <span class="text-xl sm:text-xs font-bold text-gray-900 dark:text-white">$599</span>
            </div>
            </div>
        </div>
    @endif
@endforeach
