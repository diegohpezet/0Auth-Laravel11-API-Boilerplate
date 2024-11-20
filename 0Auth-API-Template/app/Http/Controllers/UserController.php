<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->select(['id', 'name', 'email']);
        return response()->json($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user->only(['id', 'name', 'email']));
    }
}
