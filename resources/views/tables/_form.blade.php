<form method="POST" action="{{ $table->id ? route('tables.update', $table) : route('tables.store') }}">
    @csrf
    @if($table->id)
        <input type="hidden" name="_method" value="put"/>
    @endif
    <x-jet-validation-errors class="mb-4" />
    <div>
        <x-jet-label for="name" value="{{ __('Name') }}" />
        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $table->name)" required autocomplete="off" />
    </div>
    <div class="mt-4">
        <x-jet-label for="maxPlaces" value="{{ __('Max Places') }}" />
        <x-jet-input id="maxPlaces" class="block mt-1 w-full" type="number" name="maxPlaces" :value="old('maxPlaces', $table->maxPlaces)" required autocomplete="off" />
    </div>
    <div class="flex items-center justify-end mt-4">
        <x-jet-button>
            {{ $table->id ? __('Edit table') : __('Add table') }}
        </x-jet-button>
    </div>
</form>
