!function($){
    $(function(){
        $("#generate-2x-image-for-all").click(function() {
            var $button = $(this);

            $.ajax({
                type: "POST",
                url: $button.data('uri'),
                data: {
                    action: 'bebel_do_ajax',
                    fn: 'generate_2x_images'
                },
                beforeSend: function( xhr ) {
                    $button.text('Loading...').css('opacity', '0.6');
                }
            }).done(function( msg ) {
                    var result = JSON.parse(msg);
                    if (result.successful){
                        alert('All done! You can use your regenerated retina images.')
                    } else {
                        alert('Something went wrong:' + result.message);

                    }
                    $button.text('Generate').css('opacity', '');
                });
        });
    });
}(jQuery);
