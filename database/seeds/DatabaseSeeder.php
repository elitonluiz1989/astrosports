<?php

use App\Models\User;
use App\Models\UserRole;
use App\Models\UserGrant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // Create webmaster user        
        if (!empty(env("WEBMASTER_USERNAME"))) {
            $role = null;

            if (!empty(env("WEBMASTER_GRANT"))) {
                $grantName = trim(env("WEBMASTER_GRANT"));
                $grant = UserGRant::firstOrNew(['name' => $grantName]);
                $grant->save();

                if (!empty(env("WEBMASTER_ROLE"))) {
                    $roleName = trim(env("WEBMASTER_ROLE"));
                    $role = UserRole::firstOrNew(['name' => $grantName]);
                    $role->grant_id = $grant->id;
                    $role->save();
                }    
            }
            
            $user = User::firstOrNew(['username' => trim(env("WEBMASTER_USERNAME"))]);
            $user->name = trim(env("WEBMASTER_NAME"));
            $user->avatar = trim(env("WEBMASTER_AVATAR")) ?? null;
            $user->password = bcrypt(trim(env("WEBMASTER_PASSWORD")));
            if (null != $role) {
                $user->role_id = $role->id; 
            }
            $user->save();
        }
        /*factory('App\Models\User')->create([
            'username' => trim(env("WEBMASTER_USERNAME")),
            'name' => trim(env("WEBMASTER_NAME")),
            'avatar' => trim(env("WEBMASTER_AVATAR")) ?? null,
            'password' => bcrypt(trim(env("WEBMASTER_PASSWORD"))),
            'role_id' => function () {
                return factory('App\Models\UserRole')->create([
                    'name' => trim(env("WEBMASTER_ROLE")),
                    'grant_id' => function() {
                        if (null != env("WEBMASTER_GRANT")) {
                            return factory('App\Models\UserGrant')->create([
                                'name' => trim(env("WEBMASTER_GRANT"))
                            ])->id;
                        } else {
                            return null;
                        }
                    }
                ])->id;
            },
        ]);*/
    }
}
