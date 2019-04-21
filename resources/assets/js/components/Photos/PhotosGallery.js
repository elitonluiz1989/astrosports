import {Modal} from "../Base/Modal";

export function PhotosGallery() {
    let modal = new Modal('#photos-modal');

    $('.photos .photo:not(.is-album)').click(evt => {
        evt.preventDefault();

        modal.content = [{
            selector: 'img',
            attrs: {
                alt: evt.target.alt,
                src: evt.target.src
            }
        }];

        modal.show();
    });
}