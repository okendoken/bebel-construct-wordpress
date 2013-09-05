!function ($){
    $(function(){
        var $sliderApi = document.mainRevSliderApi;
        if ($sliderApi){
            $sliderApi.bind("revolution.slide.onloaded",function (e) {
                var $progress = $sliderApi.find('.tp-bannertimer');
                $progress.wrap('<div class="progress-wrap"></div>');
                $('.nav-links [data-slide]').click(function(){
                    $sliderApi['rev' + $(this).data('slide')]();
                    return false;
                });

                function positionProgress(){
                    var $progressWrap = $progress.parent(),
                        $sliderWrap = $progress.parents('.rev_slider_wrapper');
                    $progressWrap.css('top','');
                    $progressWrap.css('top', parseInt($progressWrap.css('top')) - parseInt($sliderWrap.css('margin-top')));
                    $progressWrap.css('left','');
                    $progressWrap.css('left', - parseInt($sliderWrap.css('margin-left')));
                }
                positionProgress();

                var timeout;
                $(window).resize(function(){
                    clearTimeout(timeout);
                    timeout = setTimeout(positionProgress, 300);
                })
            });
        }
    });
}(window.jQuery);