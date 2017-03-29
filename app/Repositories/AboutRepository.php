<?php
namespace App\Repositories;

class AboutRepository {
    public function all() {
        return [
            'history' => [
                'title' => 'Lorem ipsum',
                'author' => 'Algum Cara',
                'data' => '00-00-000 00:00:00',
                'cover' => 'http://pre00.deviantart.net/ce3d/th/pre/i/2013/162/a/4/green_grass_on_a_background_beautiful_sunset_by_macinivnw-d68ovg0.jpg',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu dignissim tortor. Sed in hendrerit metus, eget egestas dolor. In vel consequat tellus, ac cursus erat. Aenean tempor tellus congue eros feugiat, a sagittis dui tempus. Praesent tristique venenatis ullamcorper. Nullam commodo sodales bibendum. Donec accumsan lobortis ligula, id ornare odio pharetra nec. Vestibulum placerat sed neque sed dignissim. Proin dapibus augue quis nisl lobortis posuere. Curabitur nibh nibh, accumsan bibendum justo sed, dapibus laoreet neque. Praesent et elit dignissim, suscipit neque pellentesque, consequat dolor. Proin aliquam, odio sit amet vulputate luctus, nulla dui commodo magna, at pellentesque mauris nisl ultricies tellus. Vivamus sed urna tortor.'
            ],
        ];
    }
}
