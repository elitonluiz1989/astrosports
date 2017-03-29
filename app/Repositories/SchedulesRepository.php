<?php
namespace App\Repositories;

class SchedulesRepository {
    public function all() {
        return [
            "01:00" => [
                "Polo 001" => [ "Categoria 001" ]
            ],
            "02:00" => [
                "Polo 002" => [ "Categoria 002" ],
                "Polo 004" => [ "Categoria 004" ]
            ],
            "03:00" => [
                "Polo 003" => [
                    "Categoria 003",
                    "Categoria 004"
                ],
            ],
            "04:00" => [
                "Polo 004" => [ "Categoria 004" ]
            ],
            "05:00" => [
                "Polo 001" => [ "Categoria 001" ],
                "Polo 003" => [
                    "Categoria 003",
                    "Categoria 004"
                ],
                "Polo 005 " => [ "Categoria 005" ]
            ]
        ];
    }
}
