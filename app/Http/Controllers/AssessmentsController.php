<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessmentsController extends Controller
{
    private $view;

    public function __construct(ViewHelper $view) {
        $this->view = $view;

        $this->view->setVar('view', 'assessments');
    }

    public function index() {
        return $this->view->render();
    }
}
