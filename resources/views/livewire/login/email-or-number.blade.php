<div class="flex items-center justify-between">
     <!-- numero Address -->
 <div>
    <x-input-label for="choix" :value="__('Type')" />
    <x-select-input name="choix" wire:change="change_choix">
        <option value="numero">numero</option>
        <option value="email">email</option>
    </x-select-input>
</div>
    @if ($choix!="numero")
        <!-- Email Address -->
        <div  >
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    @else
        <div class="" >
            <x-input-label for="numero" :value="__('Numero')" />
            <x-text-input id="numero" class="block mt-1 w-full" type="tel" name="numero" :value="old('numero')" autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('numero')" class="mt-2" />
        </div>
    @endif

</div>
