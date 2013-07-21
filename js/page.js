$(function(){

    /***********************************/
    /*      Carousel Progress Bar      */
    /***********************************/
    var $carousel = $("#home-carousel"),
        $progressBar = $("#home-carousel-progress").find('.bar'),
        data = $carousel.data('carousel'),
        $controlLinks = $("a[href='#home-carousel']");

    if (!data) $carousel.carousel($carousel.data());

    var interval = $carousel.data('carousel').options.interval;

    css($progressBar, 'animation-duration', interval + 'ms');

    function pauseProgressBar(){
        css($progressBar, 'animation-play-state', 'paused');
    }

    function restartProgressBar(){
        css($progressBar, 'animation', 'none');
        setTimeout(function(){
            css($progressBar, 'animation-play-state', 'running');
            css($progressBar, 'animation', '');
            css($progressBar, 'animation-duration', interval + 'ms');
        }, 0);
    }

    $carousel.on('mouseenter', pauseProgressBar)
        .on('mouseleave', restartProgressBar);

    $controlLinks.click(restartProgressBar);

    /***********************************/
    /*      Footer Responsiveness      */
    /***********************************/

});