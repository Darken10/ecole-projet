<x-layout title="e-Educ@tion">
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg  ">
        <div class=" bg-emerald-500 text-white text-4xl px-4 py-4 flex justify-between">
            <div> Liste des Cours</div>
            <div>
                <x-shared.modale-btn name="ajouter-modale">
                    <div class=" border border-slate-300 bg-emerald-400 rounded-lg p-2 shadow-lg focus:bg-emerald-600 flex">
                        <span class=" text-3xl">
                            <svg class="me-1 -ms-1 w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        </span>
                        <span class=" text-2xl">Ajouter</span>
                    </div>
                </x-shared.modale-btn>
                <x-shared.modale title="Information de l'elève" name="ajouter-modale" type="input">
                    <div class=" text-lg text-black">
                        Creer un Cours
                    </div>
                </x-shared.modale>
                
            </div>
        </div>
        <div class="pb-4 bg-white dark:bg-gray-900 p-4">
            <label for="table-search" class="sr-only">Recherche ...</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Titre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Extrait
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date de Publication
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Statut
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @forelse ($lessons as $lesson)
                    <tr class=" {{ $i%2==0 ? 'bg-white' : 'bg-slate-100' }} border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $lesson->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ Str::limit($lesson->content,50) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $lesson->published_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $lesson->statut->name }}
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <div>
                                <x-shared.modale-btn name="voir-modal-{{ $lesson->id }}">Evaluation</x-shared.modale-btn>
                                <x-shared.modale :btn="False" title="Liste des Evalution du Cours" name="voir-modal-{{ $lesson->id }}" >
                                    <div class=" text-black">
                                        <ul>
                                            @forelse ($lesson->evaluations as $evaluation)
                                                <li class=" border-b my-4">
                                                    <a href="{{ route('prof.evaluations.edit',$evaluation) }}" class=" flex justify-between">
                                                        <span> {{ $evaluation->title }}</span>
                                                        <span> {{ $evaluation->time }}</span>
                                                    </a>
                                                </li>
                                            @empty
                                                <x-aucun>aucune evaluation</x-aucun>
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div class="flex justify-end mx-8">
                                        <x-btn-primary><a href="{{ route('prof.evaluations.create',$lesson) }}">Créer une Evaluation </a></x-btn-primary>
                                    </div>

                                </x-shared.modale>
                            </div>
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Supprimer</a>
                        </td>
                    </tr>
                    @php
                        $i ++;
                    @endphp
                    
                @empty
                    <x-aucun>Aucun Eleve n'est disponible</x-aucun>
                @endforelse

            </tbody>
        </table>
    </div>

</x-layout>