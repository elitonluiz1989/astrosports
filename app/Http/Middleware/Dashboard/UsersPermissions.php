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
            abort(403, $accessDeniedMessage);
        }

        if ($grant == "adm" && !$this->isWebmaster() && !$this->isAdministrator()) {
            abort(403, $accessDeniedMessage);
        }

        return $next($request);
    }
}
