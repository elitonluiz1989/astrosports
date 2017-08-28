<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Repositories\DefaultRepository;

class ContactController extends Controller
{
    /**
     * @var DefaultRepository
     */
    private $contacts;

    /**
     * ContactController __construct
     * @param DefaultRepository $contacts
     */
    public function __construct(DefaultRepository $contacts) {
        $this->contacts = $contacts;
        $this->contacts->model(new Contact);
    }

    /**
     * @param  string $subject
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($subject = null) {
        $data = [
            'telephones'    => $this->contacts->get('telephone'),
            'emails'        => $this->contacts->get('email'),
            'subjects'      => $this->contacts->get('subjects'),
            'subjectChosen' => $subject,
            'localization'  => $this->contacts->get('localization')
        ];

        return view('contact', $data);
    }
}
