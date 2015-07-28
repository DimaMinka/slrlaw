/**
 * faq.js
 *
 * support for dropdown faq.
 *
 */

( function($) {
    $( document ).ready(function() {
        $('.sg-faq-toggler').on('click', function () {
            $(this).toggleClass('active');
        });
    });
} )(jQuery);