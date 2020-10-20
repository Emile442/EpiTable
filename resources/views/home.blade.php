<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Je réserve
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <div class="sm:ml-10 sm:mr-10">
            <div x-data="bookingForm()" x-cloak>
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-5 flex flex-col my-2">
                    <div x-show.transition="step === 'complete'">
                        <div class="p-10 content-center ">
                            <div>
                                <div class="text-center" id="form-success-img">
                                    <spinning-dots class="mb-4 " style="width:50px"></spinning-dots>
                                </div>

                                <h2 class="text-2xl mb-4 text-gray-800 text-center font-bold" id="form-success-title">Réservation en cours..</h2>

                                <p class="text-gray-600 text-center mb-8" id="form-success-text"></p>

                                <a href="{{ route('root') }}" class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
                                >Accueil</a>
                            </div>
                        </div>
                    </div>

                    <div x-show.transition="step != 'complete'">
                        <div class="border-b-2 py-4">
                            <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight" x-text="`Étape: ${step} sur 2`"></div>
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="flex-1">
                                    <div x-show="step === 1">
                                        <div class="text-lg font-bold text-gray-700 leading-tight">Quand voulez-vous déjeuner ?</div>
                                    </div>

                                    <div x-show="step === 2">
                                        <div class="text-lg font-bold text-gray-700 leading-tight">Où veux-tu être placé ?</div>
                                    </div>
                                </div>

                                <div class="flex items-center md:w-64">
                                    <div class="w-full bg-white rounded-full mr-2">
                                        <div class="rounded-full bg-gray-200 text-xs leading-none h-2 text-center text-white" :style="'width: '+ parseInt(step / 2 * 100 - 50) +'%'"></div>
                                    </div>
                                    <div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 2 * 100 - 50) +'%'"></div>
                                </div>
                            </div>
                        </div>

                        <div class="py-5">
                            <div x-show.transition.in="step === 1">
                                <div>
                                    @if($bookingToday)
                                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-600 p-4 mt-4 my-5" role="alert">
                                            <p><strong>Note:</strong> Vous avez une réservation pour <strong>aujourd'hui</strong> à <strong>{{ $bookingToday->slot->start_at->format('H:i') }}</strong>. Vous êtes à la table <strong>{{ $bookingToday->table->name }}</strong>, place n°<strong>{{ $bookingToday->table_place }}</strong> </p>
                                        </div>
                                    @endif
                                    @if($bookingToday && $bookingTomorrow)
                                        <div class="bg-red-100 border-l-4 border-red-500 text-red-600 p-4 mt-4 my-5" role="alert">
                                            <p><strong>Note:</strong> Vous avez atteint la limite de réservation, revenez plus tard !</p>
                                        </div>
                                    @endif
                                    <label class="block tracking-wide font-medium text-sm text-gray-700 mb-2" for="day">
                                        Quand ?
                                    </label>
                                    <div class="relative">
                                        <select name="day" class="block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="day">
                                            <option value="today" {{ $bookingToday ? 'disabled' : '' }}>Aujourd'hui</option>
                                            <option value="tomorrow" {{ $bookingTomorrow ? 'disabled' : '' }}>Demain</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label class="block tracking-wide font-medium text-sm text-gray-700 mb-2" for="slots">
                                        A quelle heure ?
                                    </label>
                                    <div class="relative">
                                        <select name="slots" class="block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="slots">
                                            @foreach(\App\Models\Slot::orderBy('start_at', 'ASC')->get() as $slot)
                                                <option value="{{ $slot->id }}">De {{ $slot->start_at->format('H:i') }} à {{ $slot->end_at->format('H:i') }}</option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div x-show.transition.in="step === 2">
                                <div>
                                    <button type="button" onclick="randomPlace('random')" class="focus:outline-none bg-gray-500 hover:bg-gray-700 text-white py-1 px-4 rounded-full mt-1" >
                                        Placement aléatoire
                                    </button>
                                    <button type="button" onclick="randomPlace('side_to')" class="focus:outline-none bg-gray-500 hover:bg-gray-700 text-white py-1 px-4 rounded-full mt-1" >
                                        Placement à coté d'un {{ \Auth::user()->schoolName }}
                                    </button>
                                    <button type="button" onclick="randomPlace('not_side_to')" class="focus:outline-none bg-gray-500 hover:bg-gray-700 text-white py-1 px-4 rounded-full mt-1" >
                                        Placement à coté d'un cusrus différent du miens
                                    </button>
                                </div>

                                <div class="mt-4" id="error-message">

                                </div>

                                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-600 p-4 mt-4 my-5" role="alert">
                                    <p><strong>Click</strong> sur un siège pour choisir une place</p>
                                </div>

                                <div class="mt-4 grid grid-cols-3 gap-4" id="tables_all">
                                    <input type="hidden" name="place" id="seat">
                                </div>
                            </div>
                        </div>

                    </div>

                    <p class="text-gray-300">Fait par Emile LEPETIT, Anaëlle RAVON, Alexandre POIGNAND</p>
                </div>

                <div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
                    <div class="max-w-3xl mx-auto px-4">
                        <div class="flex justify-between">
                            <div class="w-1/2">
                                <button
                                    x-show="step > 1"
                                    @click="step--"
                                    class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
                                >Précédent</button>
                            </div>

                            <div class="w-1/2 text-right">
                                <button
                                    x-show="step < 2"
                                    @click="step++; fetchTable()"
                                    class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-{{ $bookingToday && $bookingTomorrow ? '200' : '500' }} hover:bg-blue-{{ $bookingToday && $bookingTomorrow ? '200' : '600' }} font-medium {{ $bookingToday && $bookingTomorrow ? 'cursor-not-allowed' : '' }}"
                                    {{ $bookingToday && $bookingTomorrow ? 'disabled' : '' }}
                                >Suivant</button>

                                <button
                                    @click="step = 'complete'; postForm()"
                                    x-show="step === 2"
                                    class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium"
                                >Réserver</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-20"></div>
    </div>

</x-app-layout>
