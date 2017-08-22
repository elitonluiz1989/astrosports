<?php

namespace App\Repositories;

use App\Repositories\DefaultRepository as Repo;

class AdvertisingRepository {
    public function get($id = nulll) {
        $repo = new Repo(New Advertising);

        if (null != $id) {
            $records = $repo->get();
        } else {
            $records = $repo->get($id);
        }

        return $this->manageAdvertisingRecord($records);
    }

    private function manageAdvertisingRecord(Collection $records) {
        $f =  $records->map(function($record) {
            $record->alt = $record->name;
            return $record;
        });

        dd($f);
    }
}
