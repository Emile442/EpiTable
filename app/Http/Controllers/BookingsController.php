<?php

namespace App\Http\Controllers;


use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Slot;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    const RANDOM = 'random';
    const SIDE_TO = 'side_to';
    const NOT_SIDE_TO = 'not_side_to';

    public function __construct() {
        $this->authorizeResource(Booking::class, 'booking');
    }

    public function index() {
        $bookings = Booking::with('table')->with('slot')->get();

        return response()->json($bookings);
    }

    public function my() {
        $bookings = Booking::with('table')->with('slot')
            ->where('user_id', \Auth::user()->id)
            ->orderBy('booked_for', 'DESC')
            ->paginate(20);
        return view('bookings.my', compact('bookings'));
    }

    public function destroy(Booking  $booking) {
        if (!$booking->canBeDelete) {
            return redirect()->route('booking.my')->with('error', "Impossible d'annuler cette réservation");
        }
        $booking->delete();
        return redirect()->route('booking.my')->with('success', 'Réservation annulée !');
    }

    public function randomPlace(Request  $request) {
        $date = $request->get('day') == 'today' ? Carbon::now() : Carbon::now()->addDay();
        $bookings = Booking::with('table')->with('slot')->where('slot_id', $request->get('slot'))->whereDate('booked_for', $date)->get();

        $mode = $request->get('mode');
        $room = [];

        foreach (Table::all() as $table) {
            $room[$table->id] = [];
            for ($i = 0; $i != $table->maxPlaces; $i++) {
                $room[$table->id][$i + 1] = $bookings->where('table_id', $table->id)->where('table_place', $i +1 )->first() ? true : false;
            }
        }

        $br = false;
        foreach ($room as $table) {
            foreach ($table as $seat) {
                if ($seat == false) {
                    $br = true;
                    break;
                }
            }
            if ($br == true) {
                break;
            }
        }
        if ($br == false) {
            return response()->json(['message' => 'Aucune places disponibles'], 422);
        }

        $place = null;
        if ($mode == self::RANDOM) {
            for ($nbr = array_rand($room, 1); $place == null; $nbr = array_rand($room, 1)) {
                $table = $room[$nbr];
                foreach ($table as $k => $seat) {
                    if ($seat == false) {
                        $place = $nbr . '_' . $k;
                        break;
                    }
                }
                if ($place) {
                    break;
                }
            }
        }
        if ($mode == self::SIDE_TO) {
            $tmp = [];
            $users = User::select('id')->where('school', \Auth::user()->school)->get();
            foreach ($users as $user) {
                $tmp[] = $user->id;
            }
            $onlyMySchool = $bookings->whereIn('user_id', $tmp);
            foreach ($onlyMySchool as $booking) {
                if (isset($room[$booking->table->id][$booking->table_place + 1])) {
                    if ($room[$booking->table->id][$booking->table_place + 1] == false) {
                        $place = $booking->table->id . '_' . ($booking->table_place + 1);
                        break;
                    }
                }
                if (isset($room[$booking->table->id][$booking->table_place - 1])) {
                    if ($room[$booking->table->id][$booking->table_place - 1] == false) {
                        $place = $booking->table->id . '_' . ($booking->table_place - 1);
                        break;
                    }
                }
            }
        }
        if ($mode == self::NOT_SIDE_TO) {
            $tmp = [];
            $users = User::select('id')->where('school', \Auth::user()->school)->get();
            foreach ($users as $user) {
                $tmp[] = $user->id;
            }
            $onlyMySchool = $bookings->whereNotIn('user_id', $tmp);
            foreach ($onlyMySchool as $booking) {
                if (isset($room[$booking->table->id][$booking->table_place + 1])) {
                    if ($room[$booking->table->id][$booking->table_place + 1] == false) {
                        $place = $booking->table->id . '_' . ($booking->table_place + 1);
                        break;
                    }
                }
                if (isset($room[$booking->table->id][$booking->table_place - 1])) {
                    if ($room[$booking->table->id][$booking->table_place - 1] == false) {
                        $place = $booking->table->id . '_' . ($booking->table_place - 1);
                        break;
                    }
                }
            }
        }
        if ($place == null) {
            return response()->json(['message' => "Place introuvable merci  d'en choisir une manuellement"], 422);
        }
        return response()->json(['seat' => $place]);
    }

    public function store(BookingRequest $request) {
        $seatData = explode('_', $request->get('place'));
        $date = $request->get('day') == 'today' ? Carbon::now() : Carbon::now()->addDay();
        $slot = Slot::find($request->get('slots'));

        $limitTime = Carbon::createFromFormat('H:i', $slot->start_at->format('H:i'))->subMinutes(10);
        if ($date->greaterThan($limitTime)) {
            return response()->json(['message' => "Réservation impossible;, vous pouvez reserver jusqu'à 10min avant."], 422);
        }

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
