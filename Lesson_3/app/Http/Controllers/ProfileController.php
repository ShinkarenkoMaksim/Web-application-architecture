<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use const http\Client\Curl\AUTH_ANY;

class ProfileController extends Controller
{

    public function modify(Request $request, User $user)
    {
        if ($request->isMethod('get'))
            return view('profile', ['user' => Auth::user(),]);
        elseif ($request->isMethod('post'))
            return $this->update($user, $request);
    }


    private function update(User $user, Request $request)
    {
        $errors = [];

        if ((Hash::check($request->post('password'), Auth::user()->password)) && Auth::id() == $user->id) {

            $this->validate($request, $this->validateRules($user), [], User::attributeNames());

            $user->fill([
                'name' => $request->post('name'),
                'email' => $request->post('email'),
                'password' => Hash::make($request->post('new_password')),
            ]);

            $user->save();

            return redirect()->route('myProfile')->with('success', 'Данные успешно изменены');
        } else {
            $errors['password'][] = 'Неверно введен текущий пароль';
        }

        $request->flash();
        return redirect()->route('myProfile')->withErrors($errors);

    }

    public function validateRules()
    {
        return [
            'name' => 'required|string|max:10',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'required',
            'new_password' => 'required|string|min:3|confirmed'
        ];
    }
}
