<?php get_header(); ?>

    <!--Blog Archive-->
    <div class="top-titles">
        <h2><?php echo CircleLaw_option('blog-title'); ?></h2>
        <h3><?php echo CircleLaw_option('blog-title-desc'); ?></h3>
    <div class="clear"></div>
    </div>
    <div id="blog">
        <div id="scroll" class="content">
            
            <?php if(have_posts()) : while(have_posts()) : the_post();
    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
    $large_image = $large_image[0];
            ?>
            <!--Post-->
            <div class="single-post<?php if (is_sticky()) echo " sticky"; ?>">
                <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
                <div class="thumb"><img src="<?php img_resize($large_image,104,104) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"></div>
                <?php endif; ?>
                <h2 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                <div class="date"><?php the_time(CircleLaw_option('date-format')); ?> <?php _e( 'by', 'CircleLaw' ) ?> <a href="<?php echo home_url()."?author=".get_the_author_meta('ID'); ?>" class="auther">
                <?php echo get_the_author(); ?></a> <?php _e( 'in', 'CircleLaw' ) ?> <?php the_category(', '); ?></div>
                <div class="details"><?php CircleLaw_excerpt(300); ?> <a href="<?php the_permalink() ?>"><?php _e( 'read more...', 'CircleLaw' ) ?></a></div>
            <div class="break"></div>
            </div>
            <!--Post-->
            <?php endwhile; endif;?>

        </div>
    </div>
    <?php CircleLaw_pagination(); ?>
    <div class="clear"></div>
    <!--Blog Archive-->

<?php get_footer(); ?>