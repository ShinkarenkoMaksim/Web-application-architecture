<?php


namespace App\Repositories;

use App\User;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth;
use Laravel\Socialite\Two\User as UserOAuth2;

class UserRepository
{
    public function getUserBySocId(UserOAuth2 $user, string $socName)
    {
        $userInSystem = User::query()
            ->where('id_in_soc', $user->id)
            ->where('type_auth', $socName)
            ->first();
        if (empty($userInSystem)) {
            $userInSystem = new User();
            $userInSystem->fill([
                'name' => !empty($user->getName()) ? $user->getName() : '',
                'email' => ($socName == 'vk') ? $user->accessTokenResponseBody['email'] : $user->getEmail(),
                'password' => '',
                'id_in_soc' => !empty($user->getId()) ? $user->getId() : '',
                'type_auth' => $socName,
                'avatar' => !empty($user->getAvatar()) ? $user->getAvatar() : '',
            ]);
            $userInSystem->save();
        }

        return $userInSystem;
    }
}
