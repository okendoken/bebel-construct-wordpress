!function ($){
    $(function(){
        var sliderApi = document.mainRevSliderApi;
        if (sliderApi){
            sliderApi.bind("revolution.slide.onloaded",function (e) {
                $('.nav-links [data-slide]').click(function(){
                    sliderApi['rev' + $(this).data('slide')]();
                    return false;
                })
            });
        }
    });
}(window.jQuery);