<?php get_header(); ?>
     
	<?php if (have_posts()) : while (have_posts()) : the_post();
    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
    $large_image = $large_image[0]; ?>
    
    <!--Single Content-->
    <div id="page">
        <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
        <div class="thumb"><img src="<?php img_resize($large_image,344,507) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"></div>
        <?php endif; ?>
        <h2 class="title"><a href="single.html"><?php the_title(); ?></a></h2>
        <div class="date"><?php the_time(CircleLaw_option('date-format')); ?> <?php _e( 'by', 'CircleLaw' ) ?> <a href="<?php echo home_url()."?author=".get_the_author_meta('ID'); ?>" class="auther">
                <?php echo get_the_author(); ?></a> <?php _e( 'in', 'CircleLaw' ) ?> <?php the_category(', '); ?></div>
        <div id="scroll" class="content">

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php the_content(); ?>

            <!-- AddThis Button BEGIN -->
            <?php if (CircleLaw_option('addthis-buttons') == "true"): ?>
            <div class="social_network">
                <div class="addthis_toolbox addthis_default_style single-fo3">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                <a class="addthis_button_tweet"></a>
                <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                <a class="addthis_counter addthis_pill_style"></a>
                </div>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <!-- AddThis Button END -->

            <?php endwhile; endif; ?>

            <!--Tags-->
            <div align="left" class="tags_single">
                <?php
                echo get_the_tag_list('<p>'.__( 'Tags', 'CircleLaw' ).'&nbsp;&nbsp;&nbsp;','','</p><p></p>');
                ?>
            </div>
            <!--Tags-->
            
            <!--Comments-->
            <a name="comments"></a>
            <?php comments_template(); ?>
            <!--Comments-->

            </div>
            
        </div>

    </div>
    <!--Single Content-->

<?php get_footer(); ?>