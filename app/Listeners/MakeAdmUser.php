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
        $hasUser = User::where('username', env('ADM_USERNAME'))->first();

        if (null == $hasUser) {
            factory('App\Models\User')->create([
                'username' => env('ADM_USERNAME'),
                'name' => env('ADM_NAME'),
                'password' => bcrypt(env('ADM_PASSWORD')),
                'role' => function () {
                    return factory('App\Models\UserRole')->create([
                        'name' => "adminstrador"
                    ])
                        ->id;
                }
            ]);
        }
    }
}
