export function PhotosGallery() {
    let photosModal = $('#photos-modal');
    let mainMask = $('#main-mask');

    photosModal.find('.close').click(evt => {
        photosModal
            .removeClass('in')
            .removeAttr('style')
            .find('img')
                .removeAttr('alt', 'src');

        mainMask
            .removeClass('mask--show')
            .find('.mask__content')
                .removeClass('mask__content--show');
    });

    $('.photos .photo:not(.is-album)').click(evt => {
        evt.preventDefault();

        let src = evt.target.src.split('?')[0];

        mainMask
            .addClass('mask--show')
            .find('.mask__content')
                .addClass('mask__content--show');

        photosModal
            .find('img')
                .attr({
                    alt: evt.target.alt,
                    src: src
                })
                .on('load', () => {
                    photosModal
                        .css({
                            display: 'block',
                            'z-index': 10000
                        })
                        .addClass('in');
                });
    });
}