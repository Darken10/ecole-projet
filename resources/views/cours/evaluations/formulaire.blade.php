<x-layout title="Evalutions">
    <div class=" bg-white rounded-lg mx-auto my-4 shadow-lg">
        <div class=" bg-emerald-500 p-4 rounded-t-lg flex justify-between ">
            <h1 class=" text-3xl font-bold text-white">{{$evaluation->exists ? 'Modification d\'une Evalutaion ' : 'Creation d\'une Evalutaion'}} </h1> 
            
            <x-shared.modale-btn name="effacer-modal">
                <a href="#" class="px-3 py-2 text-sm font-semibold text-center inline-flex items-center text-white bg-red-500 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Effacer
                </a>
            </x-shared.modale-btn>
            <x-shared.modale :btn="False" title="Information de l'elève" name="effacer-modal" type="alert">
                <div class=" text-lg text-black">
                   Voulez-vous vraiment supprimer l'évaluation <br>"{{ $evaluation->title }}"
                </div>
                <div >
                    <form action="{{ route('prof.evaluations.destroy',$evaluation) }}" method="post" class="flex justify-between">
                        @csrf
                        @method('DELETE')
                        <button data-modal-hide="effacer-modal" type="reset" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Non</button>
                        <button data-modal-hide="effacer-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Oui</button>
                    </form>
                </div>
            </x-shared.modale>
            
            @if ($evaluation->exists)
                <form method="POST" action="{{ route('prof.evaluations.destroy',$evaluation) }}" class="mx-4">
                    @csrf
                </form>
            @endif
        </div>  

        <form method="POST"  class="p-4 md:p-5" action="{{ $evaluation->exists ? route('prof.evaluations.update',$evaluation) : route('prof.evaluations.store',$lesson) }}" enctype="multipart/form-data" >
            @csrf
            @method($evaluation->exists ? 'PUT' : 'POST')
            <div>
                <div class="grid gap-4 mb-4 grid-cols-2 ">
                    <!-- Titre de l'evaluation -->
                    <div class="col-span-2 sm:col-span-1">
                        <x-input-label for="title" value="Titre :" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title',$evaluation->title)" required   />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <!-- Description de l'evaluation -->
                    <div class="col-span-2 sm:col-span-1">
                        <x-input-label for="description" value="Description :" />
                        <x-textarea-input id="description" class="block mt-1 w-full" type="text" name="description"  required autofocus  >{{ old('description',$evaluation->description) }}</x-textarea-input>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                     <!-- Niveau -->
                     {{--<div class="col-span-2 sm:col-span-1">
                        <x-input-label for="niveau" value="Niveau :" />
                        <x-select-input id="niveau" class="block mt-1 w-full"  name="niveau" :value="old('niveau',$evaluation->niveau?->pluck('id'))" required autofocus  >
                            @foreach ($niveaux as $niveau)
                                <option value="{{ $niveau->id }}">{{ $niveau->name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('niveau')" class="mt-2" />
                    </div>--}}
                </div>


                <div class="grid gap-4 mb-4 sm:grid-cols-2 md:grid-cols-4 grid-cols-2">
                    <!-- Note Max de l'evaluation -->
                    <div class="">
                        <x-input-label for="note_max" value="Note Maximal :" />
                        <x-text-input id="note_max" class="block mt-1 w-full" type="number" name="note_max" :value="old('note_max',$evaluation->note_max ?? 20) " required   />
                        <x-input-error :messages="$errors->get('note_max')" class="mt-2" />
                    </div>
                    <!-- Cote de l'evaluation -->
                    <div class="">
                        <x-input-label for="cote" value="Coefficient :" />
                        <x-text-input id="cote" class="block mt-1 w-full" type="number" name="cote" :value="old('cote',$evaluation->cote ?? 1) " required   />
                        <x-input-error :messages="$errors->get('cote')" class="mt-2" />
                    </div>
                    <!-- La difficulter de l'evaluation -->
                    <div class="">
                        <x-input-label for="difficulty" value="Difficulter :" />
                        <x-text-input id="difficulty" class="block mt-1 w-full" type="number" name="difficulty" :value="old('difficulty',$evaluation->difficulty ?? 1) " required   />
                        <x-input-error :messages="$errors->get('difficulty')" class="mt-2" />
                    </div>
                    <!-- Temps de l'evaluation -->
                    <div class="">
                        <x-input-label for="time" value="La durée :" />
                        <x-text-input id="time" class="block mt-1 w-full" type="time" name="time" :value="old('time',$evaluation->time)" required   />
                        <x-input-error :messages="$errors->get('time')" class="mt-2" />
                    </div>
                </div>
                
            </div>

            <div class=" flex justify-between px-4 items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <x-btn-secondary type="reset" class=" col-span-2">Anuller</x-btn-secondary>
                <x-btn-primary type="submit" class=" col-span-2">Enregistrer</x-btn-primary>
            </div>
        </form>
    </div>

    {{-- QUESTION --}}
    <div class=" bg-white rounded-lg mx-auto my-4 shadow-lg">
        <div class=" bg-emerald-500 p-4 rounded-t-lg flex justify-between ">
            <h1 class=" text-3xl font-bold text-white">{{$evaluation->exists ? 'Le Contenu ' : 'Contenu'}} </h1> 
            <div>
                <div>Durée : {{ $evaluation->time }}</div>
            </div>
        </div>  
        
        <div class="mx-2 pb-4">
            @php
                $i=1;
                $note_total = 0;
            @endphp
            @forelse ($evaluation->questions as $question)
                @livewire('cours.qcm-response', ['question' => $question,'evaluation'=>$evaluation,'i'=>$i], key($question->id))
                @php
                    $i++;
                    $note_total += $question->point
                @endphp
            @empty
                <x-aucun>Aucune Question </x-aucun>
            @endforelse
            <div class="flex justify-end m-4 gap-4">
                <x-shared.modale-btn name="create-question-qcm">
                    <a href="#" class="btn-primary ">Nouveau QCM</a>
                </x-shared.modale-btn>

                <x-shared.modale-btn name="create-question-simple">
                    <a href="#" class="btn-primary ">Nouvelle question </a>
                </x-shared.modale-btn>
            </div>
            <x-shared.modale :btn="False" type="input" title="Modifier une Question" name="create-question-qcm" >
                <div class=" text-lg text-black">
                   @livewire('cours.q-c-m',['question'=>new App\Models\Cours\Question(),'evaluation'=>$evaluation], key(0))
                </div>
            </x-shared.modale>   
                
            <x-shared.modale :btn="False" type="input" title="Modifier une Question" name="create-question-simple" >
                <div class=" text-lg text-black">
                   @livewire('cours.question',['question'=>new App\Models\Cours\Question(),'evaluation'=>$evaluation], key(0))
                </div>
            </x-shared.modale>          
        </div>
        <div class=" border-t py-4 flex justify-between mx-4 text-xl">
            <span class="my-4">Note Total </span>
            <span class="my-4">{{ $note_total }} pts</span>
        </div>
    </div>

</x-layout>
