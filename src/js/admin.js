(function ($) {
    'use strict';

    $(document).ready(function () {
        $( document ).ajaxComplete(function() {
            var vossSetDefault = $('.voss-set-default input[type="checkbox"]');
            if (!vossSetDefault.prop('checked')) {
                vossSetDefault.trigger('click');
            }
            function vossenDataAttr() {
                $('[data-bg]').each(function () {
                    var attr = $(this).attr('data-bg');
                    $(this).css('background-image', 'url(' + attr + ')' );
                });
                $('[data-color]').each(function () {
                    var attr = $(this).attr('data-color');
                    $(this).css('background-color', attr );
                });
            } vossenDataAttr();
        });
    });

}(jQuery));
