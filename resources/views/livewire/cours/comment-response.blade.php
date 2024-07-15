<div>

    @forelse ($comment->commentResponses as $response)
        <div class="flex items-start my-4  gap-2.5 justify-end">
            <div class="flex flex-col  max-w-[480px] leading-1.5 p-4 border-blue-400 bg-blue-300 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $response->user->name }}</span>
                </div>
                <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{!! nl2br(e($response->message)) !!}</p>
                <div class="flex justify-end italic gap-2">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $response->created_at->diffForHumans() }}</span>
                 </div>
            </div>
            <img class="w-8 h-8 rounded-full" src="{{ asset($response->user->profile_uri ?? 'images/user1.png') }}" alt="Jese image">
        </div >
    @empty
        <x-aucun class=" font-bold ">
            <div class="block text-center">
                <img src="{{ asset('icone/chat-round-dots-svgrepo-com.svg') }}" alt="" srcset="" class=" max-w-32 mx-auto ">
                <p>Pas de reponse</p>
            </div>
        </x-aucun>
    @endforelse

    <form wire:submit="save" method="post">
        <div class="">
            <label for="chat" class="sr-only">Votre sugestion ou questions</label>
            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                
                <textarea wire:model="response" id="input_comment" name="input_comment" rows="2" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre message..."></textarea>
                    <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                    </svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
        </div>
        
    </form>

</div>
