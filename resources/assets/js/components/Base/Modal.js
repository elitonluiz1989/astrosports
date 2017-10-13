export function Modal(selector) {
    this.element = $(selector);
    this.mask = $('#main-mask');
    this.content = [];

    this.hideMask = () => {
        this.mask
            .removeClass('mask--show')
            .find('.mask__content')
            .removeClass('mask__content--show');
    };

    this.setCloseButton = () => {
        this.element.find('.close').click(evt => {
            this.element
                .removeClass('in')
                .removeAttr('style')
                .find('img')
                .removeAttr('alt', 'src');

            this.hideMask();

            $.each(this.content, (index, element) => {
                let attrsList = Object.getOwnPropertyNames(element.attrs).join(' ');

                this.element.find(element.selector)
                    .removeAttr(attrsList);
            })
        });
    };

    this.setModalContent = () => {
        $.each(this.content, (index, element) => {
            this.element.find(element.selector)
                .attr(element.attrs)

            if (!this.waitLoad && element.waitLoad) {
                this.waitLoad = element.selector;
            }
        })
    };

    this.setModalToShow = () => {
        this.mask.find('.loader').removeClass('loader--show');

        this.element.css({
                display: 'block',
                'z-index': 10000
            })
            .addClass('in');
    };

    this.showMask = () => {
        this.mask.addClass('mask--show')
            .find('.mask__content')
            .addClass('mask__content--show')
            .find('.loader')
                .addClass('loader--show');
    };

    this.showModal = () => {
        this.showMask();

        this.setModalContent();

        this.setModalToShow();
    };
}