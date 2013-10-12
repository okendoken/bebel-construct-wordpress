!function($){
    $(function(){
        $("#contact-map").gmap3({
            marker:{
                address: window.contactFormAddress || 'Minsk'
            },
            map:{
                options:{
                    zoom: 17,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            }
        });

        $("#contact-form").submit(function() {
            var $this = $(this);

            $.ajax({
                type: "POST",
                url: $this.attr('action'),
                data: {
                    action: 'bebel_do_ajax',
                    fn: 'send_contact_form',
                    email: $this.find('#email').val(),
                    subject: $this.find('#subject').val(),
                    name: $this.find('#name').val(),
                    message: $this.find('#message').val()
                }
            }).done(function( msg ) {
                    $("#messages").html('').append(msg);
                });

            return false;
        });
    });
}(jQuery);