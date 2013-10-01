/**
 * Cross-browser wrapper for jQuery css method
 * @param $element
 * @param property
 * @param value
 */
function css($element, property, value){
    $element.css('-webkit-' + property, value);
    $element.css('-moz-' + property, value);
    $element.css('-o-' + property, value);
    $element.css(property, value);
}

!function ($){
    $(function(){
        /***********************************/
        /*       Smooth scroll to top      */
        /***********************************/

        $(".to-top-link").click(function() {
            $("html, body").animate({ scrollTop: 0 }, "fast");
            return false;
        });

        /***********************************/
        /*           Menu toggle           */
        /***********************************/

        /*   Move logo down when menu opened */
        var $menu = $(".navbar-main");
        $menu.on('show.bs.collapse', function(){
            var $this = $(this);
            if ($(window).width() < 768){
                var $logo = $('.logo'),
                    $menuItems = $menu.find('ul > li'),
                    lastChildMargin = parseInt($menu.find('ul > li:last-child').css('margin-bottom')),
                    menuHeight = $menuItems.height() * $menuItems.length + lastChildMargin;
                $logo.css("top", parseInt($logo.css('top')) + menuHeight);
            }
        });

        $menu.on('hide.bs.collapse', function(){
            if ($(window).width() < 768){
                $('.logo').css("top", '');
            }
        });
    });
}(window.jQuery);