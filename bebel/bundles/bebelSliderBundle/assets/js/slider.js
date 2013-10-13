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

                function syncSliderMargin(){
                    var $sliderWrap = $progress.parents('.rev_slider_wrapper')
                    if ($(window).width() > 767 && $(window).width() < 992){
                        if (!$sliderWrap.data('initial-margin-top')){
                            var marginTop = parseInt($sliderWrap.css('margin-top'));
                            $sliderWrap.data('initial-margin-top', marginTop);
                            $sliderWrap.css('margin-top', marginTop * 536 / 800)
                        }
                    }
                    if ($(window).width() >= 992){
                        if ($sliderWrap.data('initial-margin-top')){
                            $sliderWrap.css('margin-top', $sliderWrap.data('initial-margin-top'));
                        }
                    }
                }

                function positionProgress(){
                    var $progressWrap = $progress.parent(),
                        $sliderWrap = $progress.parents('.rev_slider_wrapper');
                    $progressWrap.css('top','');
                    $progressWrap.css('top', parseInt($progressWrap.css('top')) - parseInt($sliderWrap.css('margin-top')));
                    $progressWrap.css('left','');
                    $progressWrap.css('left', - parseInt($sliderWrap.css('margin-left')));
                }

                syncSliderMargin();
                positionProgress();

                var timeout;
                $(window).resize(function(){
                    clearTimeout(timeout);
                    timeout = setTimeout(function(){
                        syncSliderMargin();
                        positionProgress();
                    }, 300);
                })
            });
        }
    });
}(window.jQuery);