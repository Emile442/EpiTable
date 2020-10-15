<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TablesController extends Controller
{
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
}
