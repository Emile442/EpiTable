<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edition of {{ $slot->start_at->format('H:i') }}-{{ $slot->end_at->format('H:i') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                @include('slots._form', ['slot' => $slot])
            </div>
        </div>

    </div>
</x-app-layout>
