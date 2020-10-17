
<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
    <span class="text-2xl font-bold">Réservation du Mardi 14 Oct</span>
    <x-jet-validation-errors class="mb-4" />

    <div>
        <div>
            <label class="block tracking-wide font-medium text-sm text-gray-700 mb-2" for="school">
                Slots
            </label>
            <div class="relative">
                <select name="school" class="block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="school">
                    @foreach(\App\Models\Slot::all() as $slot)
                        <option value="{{ $slot->id }}">De {{ $slot->start_at->format('H:i') }} à {{ $slot->end_at->format('H:i') }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white py-1 px-4 rounded-full mt-1" >
                Placement aléatoire
            </button>
            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white py-1 px-4 rounded-full mt-1" >
                Placement à coté d'un {{ \Auth::user()->schoolName }}
            </button>
            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white py-1 px-4 rounded-full mt-1" >
                Placement à coté d'un cusrus différent du miens
            </button>
        </div>

        <div class="mt-4 grid grid-cols-3 gap-4">
            <input type="hidden" name="place" id="seat">
            @foreach($tables as $k => $table)
                <div class="col-span-3 sm:col-span-3 md:col-span-3 xl:col-span-1">
                    <span>{{ $table->name }}</span>
                    <div id="seat-map-{{ $k }}" data-map="{{ $table->map }}"></div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <button type="button" class="inline-flex items-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-800 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 bg-green">
                Réserver
            </button>
        </div>
    </div>
</div>
