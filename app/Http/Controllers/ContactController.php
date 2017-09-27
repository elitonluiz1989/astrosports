<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailResquest;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Repositories\DefaultRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'subjectSelected' => $subject,
            'localization'  => $this->contacts->get('localization')
        ];

        return view('contact', $data);
    }

    public function sendEmail(SendEmailResquest $sendEmail) {

        Mail::to(env('MAIL_TO_ADDRESS'))
            ->send(new ContactMail($sendEmail->all()));

        return 'E-mail envidao com sucesso.';
    }
}
