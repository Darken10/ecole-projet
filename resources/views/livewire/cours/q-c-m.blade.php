<div class="mx-4">

    <div class="flex w-full gap-4">
        <div class="my-4  w-[80%]">
            <x-input-label for="question" value="La Question : " />
            <x-text-input type="text" wire:model="questionText" name="question" class="w-full"/>
            <x-input-error :messages="$errors->get('question')" class="mt-2" />
        </div>
        <div class="my-4 w-[20%]">
            <x-input-label for="point" value="Point : " />
            <x-text-input type="number" wire:model="questionPoint" class="w-full" />
            <x-input-error :messages="$errors->get('question')" class="mt-2" />
        </div>
    </div>

    <div class="text-xl">Les reponses possible :</div>
    @foreach ($responsesTable as $index=>$response)
        <div class="flex gap-4 my-4">
            <x-text-input type="text" class="w-[80%]" wire:model="responsesTable.{{ $index }}.text" /> 
            <div class="flex gap-2 items-center">
                <input type="checkbox" wire:model="responsesTable.{{ $index }}.isCorrect" >
                {{-- <label for="isCorrect">Correcte</label> --}}
                <button wire:click="removeQcmResponse({{ $index }})">
                    <img src="{{ asset('icone/supprimer1.png') }}" class="w-8 h-8"  alt="">
                </button>
            </div>
            <x-input-error :messages="$errors->get('responsesTable.{{ $index }}.text')" class="mt-2" />
        </div>
    @endforeach
    
    <button wire:click="addQcmResponse"> 
        <img src="{{ asset('icone/ajouter2.png') }}" class="w-8 h-8" alt="" srcset="">
    </button>


    <div class="flex justify-between">
        <x-btn-secondary data-modal-hide="editer-question-{{ $question->id }}" type="reset" class="mb-4  mx-4 ">Anuller</x-btn-secondary>
        <x-btn-primary wire:click="save" data-modal-hide="editer-question-{{ $question->id }}" type="submit" class="mb-4  mx-4 ">Enregistrer</x-btn-primary>
    </div>
</div>
 
{{--<div>
    <div>
        <label for="">Question</label>
        <input >
    </div>
    <div>
        <label for="">Question</label>
        <input type="number" wire:model="questionPoint">
    </div>
    <div>
        <h3>Response </h3>
        <button wire:click="addQcmResponse"> + Ajouter Response</button>
        @foreach ($responsesTable as $index=>$response)
            <div>
                <input type="text" wire:model="responsesTable.{{ $index }}.text" >
                <input type="checkbox" wire:model="responsesTable.{{ $index }}.isCorrect" >
                <label for="isCorrect">Correcte</label>
                <button wire:click="removeQcmResponse({{ $index }})">Supprimer</button>
            </div>
        @endforeach
    </div>
    <button wire:click="save">Valider</button>

</div>--}}
    
