<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginVK() {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return Socialite::with('vkontakte')->redirect();
    }

    public function responseVK(UserRepository $userRepository) {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $user = Socialite::driver('vkontakte')->user();
        $userInSystem = $userRepository->getUserBySocId($user, 'vk');
        Auth::Login($userInSystem);
        return redirect()->route('home');
    }

    public function loginFB() {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return Socialite::with('facebook')->redirect();
    }

    public function responseFB(UserRepository $userRepository) {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $user = Socialite::driver('facebook')->user();
        $userInSystem = $userRepository->getUserBySocId($user, 'fb');
        Auth::Login($userInSystem);
        return redirect()->route('home');
    }

}
