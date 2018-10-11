<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index($page = 'usuarios')
    {
        $data = [
            'currentPage' => $page
        ];

        return view('dashboard.index', $data);
    }
}
