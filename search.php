<?php get_header(); ?>

    <!--Blog Archive-->
    <div id="blog">
        <div id="scroll" class="content">

	<?php if (have_posts()) : ?>
    
			<?php while (have_posts()) : the_post();
    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
    $large_image = $large_image[0]; ?>
            <!--Post-->
            <div class="single-post">
                <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
                <div class="thumb"><img src="<?php img_resize($large_image,150,145) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"></div>
                <?php endif; ?>
                <h2 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                <div class="date"><?php the_time(CircleLaw_option('date-format')); ?> <?php echo __( 'by', 'CircleLaw' ) ?> <a href="<?php echo home_url()."?author=".get_the_author_meta('ID'); ?>" class="auther">
                <?php echo get_the_author(); ?></a> <?php echo __( 'in', 'CircleLaw' ) ?> <?php the_category(', '); ?></div>
                <div class="details"><?php CircleLaw_excerpt(300); ?> <a href="<?php the_permalink() ?>"><?php _e( 'read more...', 'CircleLaw' ) ?></a></div>
            <div class="break"></div>
            </div>
            <!--Post-->
			<?php endwhile; ?>

	<?php else : ?>
		<h2><?php _e( 'no result found.', 'CircleLaw' ); ?></h2>
			<p><?php _e( 'try another word?', 'CircleLaw' ); ?></p>
   	 	<div class="searchgreen marg-top9"> <!--Search Form-->
            <form method="get" action="<?php echo home_url(); ?>">
            <input type="text" value="" name="s" class="greeninput" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';" value="<?php _e( 'Search..', 'CircleLaw' ); ?>">
            <input type="submit" value="<?php _e( 'Search..', 'CircleLaw' ); ?>" class="grennicon">
        	</form>
   	 	</div>
        
	<?php endif; ?>

        </div>
    </div>
    <!--Blog Archive-->

<?php get_footer(); ?>