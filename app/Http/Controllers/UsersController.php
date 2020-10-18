<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct() {
        $this->authorizeResource(User::class, 'user');
    }

    public function index() {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('users.index', compact('users'));
    }

    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request) {
        $update = new UpdateUserProfileInformation();
        $update->update($user, $request->all());
        $user->update($request->only('role'));
        return redirect()->route('users.index')->with('success', "{$user->name} {$user->lastname} has been updated");
    }
}
