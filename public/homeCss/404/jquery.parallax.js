(function ( $ ) {
    var parseImage = function (image) {
        var defaults = {
            pos: {x: 0, y: 0},
            speed: {x: 0, y: 0},
        };

        if ($.type(image) == 'string') {
            return $.extend(defaults, {
                src: image
            });
        }

        if ($.type(image) == 'object') {
            return $.extend(true, defaults, image);
        }

        throw 'Error parsing the argument: ' + image;
    };

    var toBackgroundPosition = function (x, y) {
        return Math.floor(x) + 'px ' + Math.floor(y) + 'px';
    };

    var toUrl = function (url) {
        return 'url(' + url + ')';
    };

    var windowCoordinates = function () {
        var $window = $(window);

        return {
            left: $window.scrollLeft(),
            right: $window.scrollLeft() + $window.width(),
            top: $window.scrollTop(),
            bottom: $window.scrollTop() + $window.height()
        };
    };

    var elementCoordinates = function ($element) {
        return {
            left: $element.offset().left,
            right: $element.offset().left + $element.outerWidth(),
            top: $element.offset().top,
            bottom: $element.offset().top + $element.outerHeight()
        };
    };

    $(window).on('scroll resize', function () {
        var w = windowCoordinates();

        $('.parallax-background').each(function (i, background) {
            var $background = $(background);

            var e = elementCoordinates($background);
            var image = $background.data('parallax-image');

            $background.css('background-position', function () {
                var x = image.pos.x + (w.left - e.left) * image.speed.x;
                var y = image.pos.y + (w.top - e.top) * image.speed.y;
                return toBackgroundPosition(x, y);
            });
        });
    });

    $.fn.parallax = function (image) {
        image = parseImage(image);

        var style = {
            backgroundImage: toUrl(image.src),
            backgroundRepeat: 'no-repeat',
            backgroundPosition: toBackgroundPosition(image.pos.x, image.pos.y)
        };

        $(this).each(function () {
            $(this).wrap(function () {
                return $('<div></div>').data('parallax-image', image).addClass('parallax-background').css(style);
            });
        });

        return this;
    };
})(jQuery);
