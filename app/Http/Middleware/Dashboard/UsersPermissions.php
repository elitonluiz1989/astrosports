<?php

namespace App\Http\Middleware\Dashboard;

use App\Handlers\Dashboard\UserPermissionHandler;
use Closure;

class UsersPermissions
{
    use UserPermissionHandler;

    private $responseMessages = "[show-user]Usuário sem permissão.";

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
        if ($grant == "webmaster" && !$this->isWebmaster()) {
            return response()->json($this->responseMessages, 422);
        }

        if ($grant == "adm" && !$this->isWebmaster() && !$this->isAdministrator()) {
            return response([$this->responseMessages], 422);
        }

        return $next($request);
    }
}
