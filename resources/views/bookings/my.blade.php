<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes réservations
        </h2>
    </x-slot>

    <div>
        <div class="container mx-auto py-8 overflow-auto">
            <div class="inline-block min-w-full bg-white shadow-md rounded rounded-lg pt-2 my-2 ">
                @include('layouts._flash')
                <table class="min-w-full leading-normal ">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            Quand ?
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            Table / Place
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    @if($booking->booked_for->format('d/m/Y') == \Carbon\Carbon::now()->format('d/m/Y'))
                                        Aujourd'hui
                                    @elseif($booking->booked_for->format('d/m/Y')== \Carbon\Carbon::now()->addDay()->format('d/m/Y'))
                                        Demain
                                    @else
                                        {{ $booking->booked_for->format('d/m/Y') }}
                                    @endif
                                       à {{ $booking->slot->start_at->format('H:i') }}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $booking->table->name }} / Place n°{{ $booking->table_place }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($booking->canBeDelete)
                                    <a class="ml-1 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full" href="{{ route('booking.my.delete', $booking) }}" data-method="delete" data-confirm="Etes-vous sur de vouloir annuler cette réservation ?">
                                        Annuler
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

