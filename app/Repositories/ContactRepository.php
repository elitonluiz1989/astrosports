<?php
namespace App\Repositories;

use App\Models\Contact;

class ContactRepository {
    public function get($id = null) {
        if (null != $id) {
            return Contact::find($id);
        } else {
            return Contact::all();
        }
    }
}
