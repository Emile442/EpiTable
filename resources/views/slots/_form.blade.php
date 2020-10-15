<form method="POST" action="{{ $slot->id ? route('slots.update', $slot) : route('slots.store') }}">
    @csrf
    @if($slot->id)
        <input type="hidden" name="_method" value="put"/>
    @endif
    <x-jet-validation-errors class="mb-4" />
    <div>
        <x-jet-label for="start_at" value="{{ __('Start At') }}" />
        <x-jet-input id="start_at" class="block mt-1 w-full" type="text" name="start_at" placeholder="00:00" :value="old('start_at', $slot->id ? $slot->start_at->format('H:i'): '' )" required autocomplete="off" />
    </div>
    <div class="mt-4">
        <x-jet-label for="end_at" value="{{ __('End At') }}" />
        <x-jet-input id="end_at" class="block mt-1 w-full" type="text" name="end_at" placeholder="00:00" :value="old('end_at', $slot->id ? $slot->end_at->format('H:i') : '')" required autocomplete="off" />
    </div>
    <div class="flex items-center justify-end mt-4">
        <x-jet-button>
            {{ $slot->id ? __('Edit slot') : __('Add slot') }}
        </x-jet-button>
    </div>
</form>
