<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function store(Request $request)
	{
		$user = new User($request->all());
		$user->save();

		return response()->json([
			'user' => $user,
			'saved' => true
		]);
	}
}
