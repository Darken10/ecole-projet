<div class=" mx-4">
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
    <div class="my-4 w-full">
        <x-input-label for="point" value="Reponse : " />
        <x-textarea-input  wire:model="responseText" class="w-full" />
        <x-input-error :messages="$errors->get('responseText')" class="mt-2" />
    </div>

    <div class="flex justify-between">
        <x-btn-secondary data-modal-hide="create-question-simple" type="reset" class="mb-4  mx-4 ">Anuller</x-btn-secondary>
        <x-btn-primary wire:click="save" data-modal-hide="create-question-simple" type="submit" class="mb-4  mx-4 ">Enregistrer</x-btn-primary>
    </div>
</div>
