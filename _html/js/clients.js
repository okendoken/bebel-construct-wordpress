$(function(){
    $("#clients").tabCollapse();
    $('a[data-toggle="tab"]').on('shown', function (e) {
        var $link = $(e.target),
            $tabPane = $($link.attr("href")),
            $previousTabPane = $($(e.relatedTarget).attr("href"));
        setTimeout(function(){
            $previousTabPane.removeClass('visible');
            $tabPane.addClass("visible");
        }, 0);
    })
});