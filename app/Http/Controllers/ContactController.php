<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ContactRepository;

class ContactController extends Controller
{
    private $contacts;

    public function __construct(ContactRepository $contacts) {
        $this->contacts = $contacts;
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
