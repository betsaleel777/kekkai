$(document).ready(function() {
    const elt = document.getElementById('message');
    if (elt) {
        const message = elt.getElementsByTagName('span')[0].textContent
        const type = elt.getElementsByTagName('em')[0].textContent

        if (message) {
            new Noty({
                type: type,
                layout: 'topRight',
                theme: 'semanticui',
                text: message,
                timeout: '4000',
                closeWith: ['click'],
                animation: {
                    open: 'animated fadeInRight',
                    close: 'animated fadeOutRight'
                }
            }).show();
        }
    }
});
