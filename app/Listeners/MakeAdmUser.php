<?php

namespace App\Listeners;

use App\Events\OnShowLogin;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
                    'username' => env("{$user}_USERNAME"),
                    'name' => env("{$user}_NAME"),
                    'avatar' => env("{$user}_AVATAR") ?? null,
                    'password' => bcrypt(env("{$user}_PASSWORD")),
                    'role' => function () use ($user) {
                        return factory('App\Models\UserRole')->create([
                            'name' => str_replace('adm', 'administrador', strtolower($user))
                        ])->id;
                    },
                ]);
            }
        }
    }
}
