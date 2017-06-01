<?php
namespace App\Repositories;

use App\Models\About;

/**
 * Class AboutRepository
 */
class AboutRepository {
    /**
     * AboutRepository get
     * @param string $search
     */
    public static function get($search = null)
    {
        if (null != $search) {
            About::find($search);
        } else {
            About::all();
        }
    }
}
