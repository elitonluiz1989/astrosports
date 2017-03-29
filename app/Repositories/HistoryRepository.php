<?php
namespace App\Repositories;

use App\Models\History;

class HistoryRepository {
    public function get($id) {
        if (null != $id) {
            return History::find($id);
        } else {
            return History::all();
        }
    }
}
