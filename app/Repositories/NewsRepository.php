<?php
namespace App\Repositories;

use App\Models\News;

class NewsRepository {
    public function get($id = null) {
        if (null != $id) {
            return News::find($id);
        } else {
            return News::all();
        }
    }
}
