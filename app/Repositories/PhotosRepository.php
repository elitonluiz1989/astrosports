<?php
namespace App\Repositories;

use App\Models\Photos;

class PhotosRepository {
    public function get($id = null) {
        if ($id == null) {
            return Photos::all();
        } else {
            return Photos::find($id);
        }
    }
}
