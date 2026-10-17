/*
 * script.js initialises every theme plugin unconditionally. Pages served with the
 * lighter bundle (see bin/bundle-assets.sh) leave some plugins out, so give the
 * missing ones a no-op that keeps the jQuery chain intact.
 */
(function ($) {
    'use strict';

    ['magnificPopup', 'isotope', 'masonry', 'imagesLoaded', 'appear', 'inputarrow'].forEach(function (name) {
        if (typeof $.fn[name] !== 'function') {
            $.fn[name] = function () {
                return this;
            };
        }
    });
})(jQuery);
