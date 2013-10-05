jQuery(function($){

    $("#mailchimp-newsletter-form").submit(function() {
        var $this = $(this);

        $.ajax({
            type: "POST",
            url: $this.attr('action'),
            data: {
                action: 'bebel_do_ajax',
                fn: 'mailchimp_subscribe',
                email: $this.find('#email').val()
            }
        }).done(function( msg ) {
                alert(msg);
            });

        return false;
    });

});