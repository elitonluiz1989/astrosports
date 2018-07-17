<?php

namespace App\Handlers\Dashboard;

use Illuminate\Support\Facades\Auth;

trait UserPermissionHandler
{
    private function getAuthUserGrant()
    {
        return Auth::user()->role;
    }

    public function isWebmaster()
    {
        return $this->getAuthUserGrant() == 1;
    }

    public function isAdministrator()
    {
        return $this->getAuthUserGrant() == 2;
    }

    public function isUser()
    {
        return $this->getAuthUserGrant() == 3;
    }
}