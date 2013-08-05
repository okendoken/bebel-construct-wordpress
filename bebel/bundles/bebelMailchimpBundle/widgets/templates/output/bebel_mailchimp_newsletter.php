<?php
$title = apply_filters('widget_title', empty($values['title']) ? __('Newsletter') : $values['title'], $values, $this->id_base);
$description = apply_filters('widget_description', empty($values['description']) ? __('Get Notifications') : $values['description'], $values, $this->id_base);
?>

<?php if ( $title ) echo $before_title . $title . $after_title; ?>
    
    
    <div class="bebel_mailchimp_newsletter_response">
        
    </div>
    
    <form action="<?php echo $values['url'] ?>" id="mailchimp_signup_newsletter_<?php echo $values['randid'] ?>">
        <div class="bebel_mailchimp_newsletter_center">    
            <div class="bebel_mailchimp_newsletter_input">
                <input type="email" class="email_<?php echo $values['randid'] ?>" name="email_<?php echo $values['randid'] ?>"  placeholder="<?php echo __('yourname@yourmail.com:', $this->settings->getPrefix()); ?>" required />
            </div>
        
            <input type="submit" class="bebel_mailchimp_newsletter_submit" value="<?php _e('sign up', $this->settings->getPrefix()) ?>" /><br class="clear" />
        </div>
    </form>
    
    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/ajax-loader.gif" id="mailchimp_progress" alt="loading.." />
    <p class="divider"></p>
    
    
    <script type="text/javascript">
    jQuery(function($){
                
        $("#mailchimp_signup_newsletter_<?php echo $values['randid'] ?>").find(".bebel_mailchimp_newsletter_submit").click(function() {
            
            $.ajax({
                type: "POST",
                url: "<?php echo $values['url_ajax'] ?>",
                data: "email="+$(".email_<?php echo $values['randid'] ?>").val(),
                beforeSend: function( xhr ) {
                    $('#mailchimp_progress').show();
                }
            }).done(function( msg ) {
                    alert(msg);
                $(".bebel_mailchimp_newsletter_response").html(msg);
                $(".bebel_mailchimp_newsletter_response").fadeIn(400);
                $('#mailchimp_progress').hide();

                // if somebody can't wait, let him click it away
                $(".bebel_mailchimp_newsletter_response").click(function() {
                    $(this).fadeOut();
                });
                setTimeout(function(){
                        $(".bebel_mailchimp_newsletter_response").fadeOut(1000);
                },3500);


            });
            
            return false;
        });

    });
    </script>
    

    