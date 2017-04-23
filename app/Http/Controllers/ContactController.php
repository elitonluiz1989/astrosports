<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ContactRepository;

class ContactController extends Controller
{
    private $contacts;
    private $view;

    public function __construct(
        ContactRepository $contacts,
        ViewHelper $view
    ) {
        $this->contacts = $contacts;
        $this->view = $view;

        $this->view->setVar('view', 'contact');
    }

    public function index() {
        $this->view->setVar('telephones', $this->contacts->get("telephone"));
        $this->view->setVar('emails', $this->contacts->get("email"));
        $this->view->setVar('localization', $this->contacts->get("localization"));

        return $this->view->render();
    }
}
