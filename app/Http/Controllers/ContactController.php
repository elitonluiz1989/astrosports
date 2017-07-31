<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Repositories\DefaultRepository;

class ContactController extends Controller
{
    private $contacts;
    private $view;

    public function __construct(DefaultRepository $contacts) {
        $this->contacts = $contacts;
        $this->contacts->model(new Contact);
    }

    public function index() {
        $data = [
            'telephones'    => $this->contacts->get("telephone"),
            'emails'        => $this->contacts->get("email"),
            'localization'  => $this->contacts->get("localization")
        ];

        return view('contact', $data);
    }
}
