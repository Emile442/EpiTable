<?php

namespace App\Http\Controllers;


use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index() {
        $bookings = Booking::with('table')->with('slot')->get();

        return response()->json($bookings);
    }

    public function my() {
        $bookings = Booking::with('table')->with('slot')
            ->where('user_id', \Auth::user()->id)
            ->orderBy('booked_for', 'DESC')
            ->get();
        return view('bookings.my', compact('bookings'));
    }

    public function deleteMy(Booking  $booking) {
        if ($booking->user_id != \Auth::user()->id) {
            abort(403);
        }
        if (!$booking->canBeDelete) {
            return redirect()->route('booking.my')->with('error', "Impossible d'annuler cette réservation");
        }
        $booking->delete();
        return redirect()->route('booking.my')->with('success', 'Réservation annulée !');
    }

    public function store(BookingRequest $request) {
        $seatData = explode('_', $request->get('place'));
        $date = $request->get('day') == 'today' ? Carbon::now() : Carbon::now()->addDay();

        if (Booking::where('user_id', \Auth::user()->id)->whereDate('booked_for', $date)->first()) {
            return response()->json(['message' => "Vous avez déjà une réservation pour ce jour là ! Merci de l'annuler avant dans réserver une autre !"], 422);
        }

        $table = Table::where('id', $seatData[0])->first();
        if (is_null($table) || $seatData[1] == 0 || $seatData[1] > $table->maxPlaces) {
            return response()->json(['message' => "Une erreur c'est produite"], 422);
        }

        $booking = Booking::create([
            'user_id' => \Auth::user()->id,
            'table_id' => $table->id,
            'table_place' => $seatData[1],
            'slot_id' => $request->get('slots'),
            'booked_for' => $date
        ]);

        $rt = Booking::with('table')->with('slot')->where('id', $booking->id)->first();

        return response()->json($rt);
    }
}
