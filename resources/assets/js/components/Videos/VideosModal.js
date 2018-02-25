import {Modal} from "../Base/Modal";

export function VideosModal() {
    let modal = new Modal('#videos-modal');
    let contentAttrs = {
        width: 600,
        height: 400,
        src: null,
        frameborder: 0,
        allowfullscreen: '',
        style: 'width: 100%'
    };

    modal.waitContentLoad = true;

    if (window.navigator.maxTouchPoints || 'ontouchstart' in document) {
        contentAttrs.height = 200;
    }

    $('#videos .videos__item').click(evt => {
        evt.preventDefault();

        let src = evt.target.parentElement.href.replace('http://youtube.com/watch?v=', 'https://www.youtube.com/embed/');
        contentAttrs.src = src.split('&')[0];

        modal.content = [{
            selector: 'iframe',
            attrs: contentAttrs
        }];

        modal.show();

        // hide modal mask when content is loaded
        let  iframe = modal.modal.find('iframe').get(0);
        let iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

        if (iframeDoc.readyState  === 'complete') {
            iframe.onload = function() {
                modal.hideMask();
            }
        }

    });
}