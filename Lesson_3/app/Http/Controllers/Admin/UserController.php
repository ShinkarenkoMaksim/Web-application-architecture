<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->paginate(12);
        return view('admin.users', ['users' => $users]);
    }

    public function edit(User $user)
    {
        return view('admin.modifyUser', [
            'user' => $user,
        ]);
    }

    public function update(User $user, Request $request)
    {
        $errors = [];

        $this->validate($request, $this->validateRules($user), [], User::attributeNames());
        if ((Auth::user() != $user) || (Hash::check($request->post('password'), $user->password))) {
            $user->fill([
                'name' => $request->post('name'),
                'password' => Hash::make($request->post('new_password')),
                'email' => $request->post('email'),
                'is_admin' => $request->post('is_admin') == true
            ]);
            $user->save();
            return redirect()->route('admin.users.index')->with('success', 'Данные успешно изменены');
        } else {
            $errors['password'][] = 'Неверно введен текущий пароль';
        }
        return redirect()->route('admin.users.index')->withErrors($errors);


    }

    public function destroy(User $user)
    {
        $user->delete();
        if ($user) {
            return redirect()->route('admin.users.index')->with('success', 'Пользователь удален');
        } else {
            return redirect()->route('admin.users.index')->with('error', 'Ошибка удаления');
        }
    }

    public function validateRules($user)
    {
        return [
            'name' => 'required|string|max:10',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => Auth::user() == $user ? 'required' : '',
            'new_password' => 'nullable|string|min:3|confirmed'
        ];
    }

    public function validateRulesAlt($user)
    {
        return [
            'name' => 'required|string|max:10',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ];
    }
}
