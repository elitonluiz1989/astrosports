<?php
namespace App\Repositories;

class PhotosRepository {
    public function all() {
        return [
            [
                'src' => 'http://assets.barcroftmedia.com.s3-website-eu-west-1.amazonaws.com/assets/images/recent-images-11.jpg',
                'description' => ' Nullam a nisi in orci egestas finibus. Sed feugiat pretium mi semper sagittis.'
            ],
            [
                'src' => 'https://www.nasa.gov/sites/default/files/styles/image_card_4x3_ratio/public/thumbnails/image/pia20645_main.jpg?itok=dLn7SngD',
                'description' => ' Mauris auctor mi vitae tortor feugiat vehicula. Nullam a nisi in orci egestas finibus. Sed feugiat pretium mi semper sagittis.'
            ],
            [
                'src' => 'http://publicdomainarchive.com/wp-content/uploads/2017/01/public-domain-images-free-stock-photos001-1000x750-167066_1000x675.jpg',
                'description' => ' Mauris auctor mi vitae tortor feugiat vehicula. Sed feugiat pretium mi semper sagittis. Nullam a nisi in orci egestas finibus. Sed feugiat pretium mi semper sagittis.'
            ],
            [
                'src' => 'http://www.planwallpaper.com/static/images/beautiful-sunset-images-196063.jpg',
                'description' => ' Mauris auctor mi vitae tortor feugiat vehicula. Nullam a nisi in orci egestas finibus.'
            ],
            [
                'src' => 'http://www.jqueryscript.net/images/Dynamic-Horizontal-Vertical-Image-Slider-Plugin-slideBox.jpg',
                'description' => ' Mauris auctor mi vitae tortor feugiat vehicula. Nullam a nisi in orci egestas finibus. Sed feugiat pretium mi semper sagittis.'
            ],
        ];
    }
}
