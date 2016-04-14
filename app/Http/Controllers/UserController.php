<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(Authenticatable $user)
    {
        return $this->responseFactory->view('users.settings', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|between:2,255',
            'email'    => "required|email|unique:users,email,{$request->user()->id}",
            'password' => 'min:8'
        ]);

        /** @var \App\User $user */
        $user = $request->user();
        $user->fill($request->only('name', 'email'));

        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        Auth::guard()->login($user);

        return $this->responseFactory->redirectToRoute('settings');
    }
}
