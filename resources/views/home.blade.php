<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <div class="grid grid-cols-8 gap-4">
            <div class="col-start-2 col-span-6">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                    <span class="text-2xl font-bold">Je réserve une place</span>
                    <x-jet-validation-errors class="mb-4" />

                    <div>
                        <div>
                            <label class="block tracking-wide font-medium text-sm text-gray-700 mb-2" for="school">
                                Slots
                            </label>
                            <div class="relative">
                                <select name="school" class="block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="school">
                                    @foreach(\App\Models\Slot::all() as $slot)
                                        <option value="{{ $slot->id }}">{{ $slot->start_at->format('H:i') }}-{{ $slot->end_at->format('H:i') }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block tracking-wide font-medium text-sm text-gray-700 mb-2" for="school">
                                Tables
                            </label>
                            <div class="relative">
                                <select name="school" class="block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="school">
                                    @foreach(\App\Models\Table::all() as $table)
                                        <option value="{{ $table->id }}">{{ $table->name }} (x available places)</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-jet-button class="">
                                {{ __('Submit') }}
                            </x-jet-button>
                        </div>
                    </div>

                    <hr class="mt-10 mb-10">

                    <div>
                        <span>Je souhaite un placement aléatoire</span>
                        <div>
                            <label class="block tracking-wide font-medium text-sm text-gray-700 mb-2" for="school">
                                Slots
                            </label>
                            <div class="relative">
                                <select name="school" class="block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="school">
                                    @foreach(\App\Models\Slot::all() as $slot)
                                        <option value="{{ $slot->id }}">{{ $slot->start_at->format('H:i') }}-{{ $slot->end_at->format('H:i') }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6 mt-4">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="inline-flex items-center mt-3">
                                    <input type="radio" name="options" class="form-checkbox h-5 w-5 text-gray-600" checked><span class="ml-2 text-gray-700">Placement aléatoire</span>
                                </label>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="inline-flex items-center mt-3">
                                    <input type="radio" name="options" class="form-checkbox h-5 w-5 text-gray-600" ><span class="ml-2 text-gray-700">Placement à coté d'un {{ \Auth::user()->schoolName }}</span>
                                </label>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="inline-flex items-center mt-3">
                                    <input type="radio" name="options" class="form-checkbox h-5 w-5 text-gray-600" ><span class="ml-2 text-gray-700">Placement à coté d'un cusrus différent du miens</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-jet-button class="">
                                {{ __('Submit') }}
                            </x-jet-button>
                        </div>
                    </div>

                    <hr class="mt-10 mb-10">

                    <div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-3 sm:col-span-3 md:col-span-3 xl:col-span-1">
                                <div class="seat-map"></div>
                            </div>
                            <div class="col-span-3 sm:col-span-3 md:col-span-3 xl:col-span-1">
                                <div class="seat-map2"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
