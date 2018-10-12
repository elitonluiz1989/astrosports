<?php

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
        factory('App\Models\User')->create([
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
        ]);
    }
}
