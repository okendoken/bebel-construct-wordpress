<?php get_header(); //template name: Contact Page ?>
     
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <!--Contact Content-->
    <div class="top-titles">
        <h2><?php the_title(); ?></h2>
        <h3><?php echo CircleLaw_option('contact-page-title'); ?></h3>
    <div class="clear"></div>
    </div>
    <div id="contact">
        <?php if (CircleLaw_option('contact-page-map') != ""): ?>
        <div class="google-map"><iframe width="100%" height="208" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo CircleLaw_option('contact-page-map'); ?>&amp;output=embed"></iframe></div>
    <?php endif; ?>
            <h2><?php the_title(); ?></h2>
            <!--Send Message Form -->
            <iframe class="displaynone" name="hiddentarget" ></iframe>
            <form action="<?php echo get_stylesheet_directory_uri(); ?>/ajax.php?do=submit_contact" method="post" target="hiddentarget" enctype="multipart/form-data" style="position:relative; width:600px; float:left;">
            <input type="hidden" name="do" value="submit_contact" />
            <input type="hidden" name="_FF_" value="n" />
            <input id="____full_name____" name="name" type="text" class="inp" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';" value="<?php _e( 'Name:', 'CircleLaw' ); ?>">
            <div id="error____full_name____"></div>
            <input id="____email____" name="email" type="text" class="inp" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';" value="<?php _e( 'E-Mail:', 'CircleLaw' ); ?>">
            <div id="error____email____"></div>
            <input id="____phone____" name="phone" type="text" class="inp" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';" value="<?php _e( 'Subject:', 'CircleLaw' ); ?>">
            <div id="error____phone____"></div>
            <textarea name="message" rows="5" id="____note____" class="msg" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';"><?php _e( 'Message:', 'CircleLaw' ); ?></textarea>
            <div id="error____note____"></div>
            <div class="clear"></div>
            <input type="submit" onclick="return send_contact();" class="sub" value="<?php _e( 'send', 'CircleLaw' ); ?>">
            <div id="login-loading_2" class="displaynone contload"> 
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif" class="contloadi" border="0" width="16" height="16" alt="waite" /> 
            <span class="pending"><?php _e( 'Please wait', 'CircleLaw' ); ?></span> 
            </div>       
            </form>
            <!-- Contact Details -->
            <div class="contact-info"><?php echo CircleLaw_option('contact-page-info'); ?></div>
    <div class="clear"></div>
    </div>
    <!--Contact Content-->
    
    <?php endwhile; endif; ?>

<?php get_footer(); ?>