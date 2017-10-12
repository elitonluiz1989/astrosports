import {Modal} from "../Base/Modal";

export function PhotosGallery() {
    let modal = new Modal('#photos-modal');

    modal.setCloseButton();

    $('.photos .photo:not(.is-album)').click(evt => {
        evt.preventDefault();

        let src = evt.target.src.split('?')[0];

        $('html, body').animate({scrollTop: 290}, 500);

        modal.content = [{
            selector: 'img',
            attrs: {
                alt: evt.target.alt,
                src: src
            },
            waitLoad: true
        }];
        
        modal.showModal();
    });
}