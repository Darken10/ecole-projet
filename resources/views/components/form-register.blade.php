

<div ><!-- Information de la personalite-->
    <h3 class=" text-2xl text-center">Information Personnel</h3>
    <!-- nom -->
    <div>
        <x-input-label for="first_name" :value="__('Nom')" />
        <x-text-input id="first_name" class="block mt-1 w-full my-4 " type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
    </div>
    <!-- prenom -->
    <div>
        <x-input-label for="last_name" :value="__('Prenom')" />
        <x-text-input id="last_name" class="block mt-1 w-full my-4" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
    </div>

    <div class="flex justify-between gap-x-4">
        <!-- Sexe -->
        <div>
            <x-input-label for="sexe" :value="__('Sexe')" />
            <x-select-input id="sexe" class="block mt-1 w-full my-4"  name="sexe" :value="old('sexe')" required autofocus autocomplete="name" >
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
        </div>
        <!-- Date naissance -->
        <div class="w-full">
            <x-input-label for="date_naissance" :value="__('Date de Naissance')" />
            <x-text-input id="date_naissance" class="block mt-1 w-full my-4" type="date" name="date_naissance" :value="old('date_naissance')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
        </div>
        <div class="w-full">
            <x-input-label for="niveau" :value="__('Niveau')" />
            <x-select-input id="niveau" class="block mt-1 w-full my-4"  name="niveau_id" :value="old('niveau_id')" required autofocus autocomplete="name" >
                @foreach (App\Models\Cours\Niveau::all()  as $niveau)
                    <option value="{{ $niveau->id }}">{{ $niveau->name }}</option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('niveau_id')" class="mt-2" />
        </div>
    </div>
</div>

<div>
    <h3 class=" text-2xl border-t-2 mt-4 pt-2 text-center">Adresse</h3>
    <!-- numero -->
    <div>
        <x-input-label for="numero" :value="__('Numero')" />
        <x-text-input id="numero" class="block mt-1 w-full my-4" type="tel" name="numero" :value="old('numero')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('numero')" class="mt-2" />
    </div>
    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full my-4" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
</div>