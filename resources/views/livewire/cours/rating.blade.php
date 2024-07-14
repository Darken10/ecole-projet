<!-- resources/views/livewire/course-rating.blade.php -->
<div>
    @if(!$hasRated)
        <!-- Modal -->
        <div class="fixed z-10 inset-0 overflow-y-auto items-center h-full mt-4">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5l3.09 6.26 6.91.62-5 4.87 1.18 6.88L12 18.5l-6.18 3.63L7 16.25l-5-4.87 6.91-.62L12 4.5z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Notez ce cours
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Veuillez donner une note à ce cours de 0 à 5.
                                </p>
                            </div>
                            <div class="mt-2">
                                <div class="mt-2 flex justify-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg wire:click="setRating({{ $i }})" class="h-6 w-6 cursor-pointer {{ $apreciation >= $i ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5l3.09 6.26 6.91.62-5 4.87 1.18 6.88L12 18.5l-6.18 3.63L7 16.25l-5-4.87 6.91-.62L12 4.5z" />
                                        </svg>
                                    @endfor
                                </div>
                                @error('apreciation') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button wire:click="submitRating" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-yellow-600 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Soumettre
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>