export function Modal(selector) {

    this.modal = $(selector);
    this.mask = this.modal.find('.mask');
    this.content = [];
    this.waitContentLoad = false;

    this.hideMask = () => {
        this.mask
            .removeClass('mask--show')
            .find('.mask__content')
            .removeClass('mask__content--show');
    };

    this.setCloseButton = () => {
        this.modal.find('.close').click(evt => {
            this.modal
                .removeClass('in')
                .removeAttr('style')
                .find('img')
                .removeAttr('alt', 'src');

            this.hideMask();

            $.each(this.content, (index, element) => {
                let attrsList = Object.getOwnPropertyNames(element.attrs).join(' ');

                this.modal.find(element.selector)
                    .removeAttr(attrsList);
            })
        });
    };

    this.setModalContent = () => {
        $.each(this.content, (index, element) => {
            this.modal.find(element.selector)
                .attr(element.attrs);
        })
    };

    this.showMask = () => {
        this.mask.addClass('mask--show')
            .find('.mask__content')
            .addClass('mask__content--show')
            .find('.loader')
                .addClass('loader--show');
    };

    this.show = () => {
        this.showMask();

        this.setModalContent();

        this.modal.modal('show');

        if (!this.waitContentLoad) {
            let modalInterval = setTimeout(() => {
                this.hideMask();
            }, 1000);
        }
    };
}