$(document).ready(function () {
    if (window.innerWidth < 750) {
        // Footer Menu-------------------------------------
        $('.company-button').after().click(function () {
            $('.company-list').toggle();
        });
        $('.help-button').after().click(function () {
            $('.help-list').toggle();
        });
        $('.misc-button').after().click(function () {
            $('.misc-list').toggle();
        });
    }


















});
