<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;

class SlotsController extends Controller
{
    public function index() {
        $slots = Slot::orderBy('start_at', 'ASC')->get();
        return view('slots.index', compact('slots'));
    }

    public function store(Request $request) {
        $slot = Slot::create($request->all());
        return redirect()->route('slots.index')->with('success', 'The slot ' . $slot->start_at->format('H:i') . '-' .  $slot->end_at->format('H:i') . ' has been created.');
    }

    public function edit(Slot $slot) {
        return view('slots.edit', compact('slot'));
    }

    public function update(Slot $slot, Request $request) {
        $slot->update($request->all());
        return redirect()->route('slots.index')->with('success', 'The slot ' . $slot->start_at->format('H:i') . '-' .  $slot->end_at->format('H:i') . ' has been updated.');
    }

    public function destroy(Slot $slot) {
        $slot->delete();
        return redirect()->route('slots.index')->with('success', 'The slot ' . $slot->start_at->format('H:i') . '-' .  $slot->end_at->format('H:i') . ' has been destroyed.');
    }
}
