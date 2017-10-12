import {Modal} from "../Base/Modal";

export function VideosModal() {
    let modal = new Modal('#videos-modal');
    let contentAttrs = {
        width: 800,
        height: 400,
        src: null,
        frameborder: 0,
        allowfullscreen: '',
        style: 'width: 100%'
    };

    modal.setCloseButton();

    $('#videos .videos__item').click(evt => {
        evt.preventDefault();

        let src = evt.target.parentElement.href.replace('http://youtube.com/watch?v=', 'https://www.youtube.com/embed/');
        contentAttrs.src = src.split('&')[0];

        modal.content = [{
            selector: 'iframe',
            attrs: contentAttrs
        }];

        modal.showMask();

        modal.showModal();
    });
}