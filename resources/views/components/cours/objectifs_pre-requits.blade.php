@props([
    'pre_requies'=>[],
    'objectifs'=>[],
])
<div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
        <li class="me-2">
            <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="true" class="inline-block p-4 text-blue-600 rounded-ss-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">Objectifs</button>
        </li>
        <li class="me-2">
            <button id="services-tab" data-tabs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Pré Requits</button>
        </li>
    </ul>
    <div id="defaultTabContent">
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
            <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Objectifs</h2>
            <!-- List -->
            <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                @forelse ($objectifs as $objectif)
                <li class=" space-x-2 rtl:space-x-reverse items-center">
                    <div class="flex items-center ">
                        <img src="{{ asset('images/objectif.png') }}" class="w-8 " alt="" srcset="">
                        <span class="leading-tight font-semibold  text-gray-800 ">{{ $objectif->title }}</span>
                    </div>
                    <p class="text-sm">
                        {{ $objectif->description }}
                    </p>
                </li>
                @empty
                   <x-aucun>Non Définie</x-aucun> 
                @endforelse
                
            </ul>
        </div>
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="services" role="tabpanel" aria-labelledby="services-tab">
            <h2 class="mb-5 text-2xl font-extrabold tracking-tight  dark:text-white">Pré-Requits</h2>
            <!-- List -->
            <ul role="list" class="space-y-4  dark:text-gray-400">
                @forelse ($pre_requies as $pre_requie)
                <li class=" space-x-2 rtl:space-x-reverse items-center">
                    <div class="flex  text-gray-900 gap-2">
                        <img src="{{ asset('icone/pre_requit.png') }}" class="w-6 " alt="" srcset="">
                        <p class="leading-tight font-semibold  text-gray-800 ">
                            {{ $pre_requie->title }}
                        </p>
                    </div>
                    <p class="text-sm  text-gray-500">
                        {{ $pre_requie->description }}
                    </p>
                    @if ($pre_requie->liens!=null)
                            <a href="{{ $pre_requie->liens }}" style="color: blue" class=" text-blue-700  underline  ">voir</a>
                    @endif
                </li>
                @empty
                    <x-aucun>Pas de Pré-Requits</x-aucun>
                @endforelse
            </ul>
        </div>
    </div>
</div>

