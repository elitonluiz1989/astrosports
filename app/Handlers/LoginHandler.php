<?php


namespace App\Handlers;


use App\Models\User;
use Illuminate\Support\Facades\Artisan;

trait LoginHandler
{
    public function hasWebmaster()
    {
        $hasWebmaster = User::all()->first(function($user) {
            return $user->role->name == 'webmaster';
        });

        if (null == $hasWebmaster) {
            $username = trim(env('WEBMASTER_USERNAME')) ?? null;
            $name = trim(env('WEBMASTER_NAME')) ?? null;
            $avatar = trim(env('WEBMASTER_AVATAR')) ?? null;
            $password = bcrypt(trim(env('WEBMASTER_PASSWORD'))) ?? null;
            $password2 = env('WEBMASTER_PASSWORD') ?? null;
            $role = trim(env('WEBMASTER_ROLE')) ?? null;
            $grant = trim(env('WEBMASTER_GRANT')) ?? null;

            if (null != $username) {
                // Create webmaster user
                $user = [
                    'username' => $username,
                    'name' => $name,
                    'avatar' => $avatar,
                    'password' => $password
                ];

                if (null != $role && null != $grant) {
                    $user['role_id'] = factory('App\Models\UserRole')->create([
                        'name' => trim(env("WEBMASTER_ROLE")),
                        'grant_id' => function () {
                            return factory('App\Models\UserGrant')->create([
                                'name' => trim(env("WEBMASTER_GRANT"))
                            ])->id;
                        }
                    ])->id;
                }

                factory('App\Models\User')->create($user);
            }
        }
    }
}