@props(['lesson'])

<div class="py-2 flex flex-row items-center justify-between">
    <a href="{{ route('cours.like',$lesson) }}" class="no-underline"> {{-- love --}}
      <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg">
         <x-cours.love-icone is_love :number="$lesson->count_likes()"/> 
      </button>
    </a>
    <a href="" class="no-underline"> {{-- vue --}}
        <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg> 
            <span class="ml-1">{{ $lesson->count_views() }}</span> 
        </button>
    </a>  
    <a  class="text-gray-900" style="text-decoration: none"> {{-- appreciation --}}
        <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
          <x-shared.rating :appreciation="$lesson->apreciation()" />
        </button>
      </a>
</div>