<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Table;
use Carbon\Carbon;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Table::class, 'table');
    }

    public function index() {
        $tables = Table::all();
        return view('tables.index', compact('tables'));
    }

    public function store(Request $request) {
        $table = Table::create($request->all());
        return redirect()->route('tables.index')->with('success', 'The table ' . $table->name . ' has been created.');
    }

    public function edit(Table $table) {
        return view('tables.edit', compact('table'));
    }

    public function update(Table $table, Request $request) {
        $table->update($request->all());
        return redirect()->route('tables.index')->with('success', 'The table ' . $table->name . ' has been updated.');
    }

    public function destroy(Table $table) {
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'The table ' . $table->name . ' has been destroyed.');
    }

    public function apiIndex(Request $request) {
        $q = Table::select('id', 'name', 'maxPlaces')->get();
        $slot = Slot::find($request->get('slot'));
        $date = ($request->get('date') != 'tomorrow') ? Carbon::now() : Carbon::now()->add(1, 'day');
        $tables = [];

        foreach ($q as $k => $table) {
            $tables[$k]['id'] = $table->id;
            $tables[$k]['name'] = $table->name;
            $tables[$k]['maxPlaces'] = $table->maxPlaces;
            $tables[$k]['map'] = $this->getMapAttribute($table, $slot, $date);
        }

        return response()->json($tables);
    }

    public function place_is_empty($bookings, $nbr, Slot $slot) {
        foreach ($bookings as $booking) {
            if ($booking->table_place == $nbr && $booking->slot_id == $slot->id) {
                return false;
            }
        }
        return (true);
    }

    public function getMapAttribute(Table $table, Slot $slot, Carbon $date) {
        $tmp = [];
        $bookings = $table->bookings()->whereDate('booked_for', $date)->get();
        for ($i = 0; $table->maxPlaces != $i; $i++) {
            $val = $i + 1;
            $l =  $this->place_is_empty($bookings, $val, $slot) ? 'a' : 'c' ;
            $tmp[] = "{$l}[{$table->id}_{$val},$val]";
        }

        $array = array_chunk($tmp, round($table->maxPlaces / 2));

        return implode('', $array[0]) . '#' . implode('', $array[1]);
    }
}
