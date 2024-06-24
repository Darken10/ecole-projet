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

    <div class="text-xl">La réponse :</div>
    <div>
        <x-textarea-input class="w-full" wire:model="responseText"></x-textarea-input>
    </div>
    <div class="flex justify-between">
        <x-btn-secondary data-modal-hide="editer-question-{{ $question->id }}" type="reset" class="mb-4  mx-4 ">Anuller</x-btn-secondary>
        <x-btn-primary wire:click="save" data-modal-hide="editer-question-{{ $question->id }}" type="submit" class="mb-4  mx-4 ">Enregistrer</x-btn-primary>
    </div>
</div>