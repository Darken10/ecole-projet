@props(['lesson'])

<div class="border border-gray-300 shadow-md w-full rounded-md my-4 py-2 pl-6">
    <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Les Differentes Sections de la Leçon</h2>
    <div>
        <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
            @foreach ($lesson->contents  as $content)
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                     <span>{{ $content->section_title }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>