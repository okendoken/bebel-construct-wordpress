!function ($){
    $(function(){
        var sliderApi = document.mainRevSliderApi;
        if (sliderApi){
            sliderApi.bind("revolution.slide.onloaded",function (e) {
            });
        }
    });
}(window.jQuery);