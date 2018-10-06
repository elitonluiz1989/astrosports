<?php

namespace App\Listeners;

use App\Events\OnShowLogin;
use App\Models\User;

class MakeAdmUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OnShowLogin  $event
     * @return void
     */
    public function handle(OnShowLogin $event)
    {
        $users = ['WEBMASTER', 'ADM'];

        foreach ($users as $user) {
            $hasUser = User::where('username', env("{$user}_USERNAME"))->first();

            if (null == $hasUser) {
                factory('App\Models\User')->create([
                    'username' => trim(env("{$user}_USERNAME")),
                    'name' => trim(env("{$user}_NAME")),
                    'avatar' => trim(env("{$user}_AVATAR")) ?? null,
                    'password' => bcrypt(trim(env("{$user}_PASSWORD"))),
                    'role_id' => function () use ($user) {
                        return factory('App\Models\UserRole')->create([
                            'name' => trim(str_replace('adm', 'administrador', strtolower($user))),
                            'grant_id' => function() use ($user) {
                                if (null != env("{$user}_GRANT")) {
                                    return factory('App\Models\UserGrant')->create([
                                        'name' => trim(env("{$user}_GRANT"))
                                    ])->id;
                                } else {
                                    return null;
                                }
                            }
                        ])->id;
                    },
                ]);
            }
        }
    }
}
