<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $tables = Table::all();
        $bookingToday = Booking::where('user_id', \Auth::user()->id)->whereDate('booked_for', Carbon::now())->first();
        $bookingTomorrow = Booking::where('user_id', \Auth::user()->id)->whereDate('booked_for', Carbon::now()->addDay())->first();
        return view('home', compact('tables', 'bookingToday', 'bookingTomorrow'));
    }
}
