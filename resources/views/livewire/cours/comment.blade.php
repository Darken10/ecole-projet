<div>
    <div  >
        @forelse ($lesson->comments as $comment)
        <div id="response_bloc_{{ $comment->id }}">
            <div class="flex items-start  gap-2.5 ">
                <img class="w-8 h-8 rounded-full" src="{{ asset($comment->user->profile_uri ?? 'images/user1.png') }}" alt="Jese image">
                <div class="flex flex-col  max-w-[480px] leading-1.5 p-4 border-gray-300 bg-gray-200 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
                    </div>
                    <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{!! nl2br(e($comment->message)) !!}</p>
                    <div class="flex justify-end italic gap-2">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots{{ $comment->id }}" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600" type="button">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                </button>
            </div >
            <div class=" mx-4 mb-6 gap-4 font-semibold text-gray-600">
                <a class="mx-2 cursor-pointer" wire:click="like({{ $comment->id }})" >j'aime ({{ $comment->count_likes() }})  </a>
                <a  class=" mx-2 cursor-pointer" id="responde_a_{{ $comment->id }}">Reponse ({{ $comment->count_responses() }})  </a>
            </div>

            {{-- le trois petit point de la bulle de commentaire --}}
            <div id="dropdownDots{{ $comment->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                    <li>
                        <a class="block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white " id="responde_btn_{{ $comment->id }}">Repondre</a>
                    </li>
                    <li>
                        <a  class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:click="like({{ $comment->id }})" >J'aime</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Copy</a>
                    </li>
                    
                    </ul>
                </div>

                {{-- la gestion des reponse --}}
                <div hidden id="response_{{ $comment->id }}"     >
                    @livewire('cours.comment-response', ['comment' => $comment], key($comment->id))
                </div>
            </div>

                <script>
                    const response_{{ $comment->id }} = document.getElementById("response_{{ $comment->id }}")
                    const response_bloc_{{ $comment->id }} = document.getElementById("response_bloc_{{ $comment->id }}")
                    const responde_btn_{{ $comment->id }} = document.getElementById("responde_btn_{{ $comment->id }}")
                    responde_btn_{{ $comment->id }}.addEventListener('click',function (e){
                        e.preventDefault()
		                e.stopPropagation()
                        console.log(response_{{ $comment->id }});
                        response_{{ $comment->id }}.toggleAttribute('hidden')
                        response_bloc_{{ $comment->id }}.setAttribute('class','bg-gray-100 p-4')
                    })
                    responde_a_{{ $comment->id }}.addEventListener('click',function (e){
                        e.preventDefault()
		                e.stopPropagation()
                        console.log(response_{{ $comment->id }});
                        response_{{ $comment->id }}.toggleAttribute('hidden')
                        response_bloc_{{ $comment->id }}.setAttribute('class','bg-gray-100 p-4')
                    })

                </script>
        @empty
            <x-aucun class=" font-bold ">
                <div class="block text-center">
                    <img src="{{ asset('icone/chat-round-dots-svgrepo-com.svg') }}" alt="" srcset="" class=" max-w-32 mx-auto ">
                    <p>Pas de Suggestion/Commentaire</p>
                </div>
            </x-aucun>
        @endforelse
    </div>

    <form wire:submit="save" method="post">

        <div class="">
            <label for="chat" class="sr-only">Votre sugestion ou questions</label>
            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path fill="currentColor" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z"/>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z"/>
                    </svg>
                    <span class="sr-only">Upload image</span>
                </button>
                <button type="button" class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.408 7.5h.01m-6.876 0h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM4.6 11a5.5 5.5 0 0 0 10.81 0H4.6Z"/>
                    </svg>
                    <span class="sr-only">Add emoji</span>
                </button>
                <textarea wire:model="message" id="input_comment" name="input_comment" rows="2" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre message..."></textarea>
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
</div>
