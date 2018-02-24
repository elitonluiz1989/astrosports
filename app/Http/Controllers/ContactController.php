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
     * @var array
     */
    private $data = [];

    /**
     * ContactController __construct
     * @param DefaultRepository $contacts
     */
    public function __construct(DefaultRepository $contacts) {
        $this->contacts = $contacts;
        $this->contacts->model(new Contact);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function email(Request $request) {
        $this->data['subject'] = $request->get('assunto') ?? 'matricula';

        return $this->index();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $this->data['telephones'] = $this->contacts->get('telephone');
        $this->data['emails'] = $this->contacts->get('email');
        $this->data['localization'] = $this->contacts->get('localization');

        return view('contact', $this->data);
    }

    public function sendEmail(SendEmailResquest $sendEmail) {
        Mail::to(env('MAIL_TO_ADDRESS'))
            ->send(new ContactMail($sendEmail->all()));

        return 'E-mail enviado com sucesso.';
    }
}
