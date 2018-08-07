<?php

namespace App\Http\Middleware\Dashboard;

use App\Handlers\Dashboard\UserPermissionHandler;
use Closure;

class UsersPermissions
{
    use UserPermissionHandler;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param string $grant
     * @return mixed
     */
    public function handle($request, Closure $next, $grant)
    {
        $accessDeniedMessage = config("dashboard.users.accessDeniedMessage");

        if ($grant == "webmaster" && !$this->isWebmaster()) {
            return response($accessDeniedMessage, 403);
        }

        if ($grant == "adm" && !$this->isWebmaster() && !$this->isAdministrator()) {
            return response($accessDeniedMessage, 403);
        }

        return $next($request);
    }
}
