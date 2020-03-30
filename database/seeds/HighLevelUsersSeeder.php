<?php

use App\Models\User;
use App\Models\UserRole;
use App\Models\UserGrant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HighLevelUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create webmaster user        
        if (!empty(env("WEBMASTER_USERNAME"))) {
            DB::transaction(function() {
                $user = User::firstOrNew(['username' => trim(env("WEBMASTER_USERNAME"))]);
                $user->name = trim(env("WEBMASTER_NAME"));
                $user->avatar = trim(env("WEBMASTER_AVATAR")) ?? null;
                $user->password = trim(env("WEBMASTER_PASSWORD"));

                if (!empty(env("WEBMASTER_GRANT"))) {
                    $grantName = trim(env("WEBMASTER_GRANT"));
                    $grant = UserGRant::firstOrNew(['name' => $grantName]);
                    $grant->save();

                    if (!empty(env("WEBMASTER_ROLE"))) {
                        $roleName = trim(env("WEBMASTER_ROLE"));
                        $role = UserRole::firstOrNew(['name' => $roleName]);
                        $role->grant_id = $grant->id;
                        $role->save();
                        
                        $user->role_id = $role->id; 
                    }    
                }

                $user->save();
            });
        }
    }
}
