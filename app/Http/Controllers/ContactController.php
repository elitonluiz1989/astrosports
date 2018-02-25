<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
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
     * @var array
     */
    private $data = [];

    private $view;

    /**
     * ContactController __construct
     * @param DefaultRepository $contacts
     */
    public function __construct(DefaultRepository $contacts) {
        $this->contacts = $contacts;
        $this->contacts->model(new Contact);
        $this->view = 'contact';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function email(Request $request) {
        $this->recordsHandler();

        $this->data['subject'] = $request->get('assunto') ?? 'matricula';

        return view($this->view, $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $this->recordsHandler();

        return view($this->view, $this->data);
    }

    /**
     * @param SendEmailRequest $sendEmail
     * @return string
     */
    public function sendEmail(SendEmailRequest $sendEmail) {
        Mail::to(env('MAIL_TO_ADDRESS'))
            ->send(new ContactMail($sendEmail->all()));

        return 'E-mail enviado com sucesso.';
    }

    private function recordsHandler() {
        $this->data['telephones'] = $this->contacts->get('telephone');
        $this->data['emails'] = $this->contacts->get('email');
        $this->data['localization'] = $this->contacts->get('localization');
        $this->data['subject'] = null;
    }
}
