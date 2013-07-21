<?php get_header(); //template name: Portfolio ?>
     
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <!--Archive Gallery-->
    <div class="top-titles">
        <h2><?php echo CircleLaw_option('portfolio-title'); ?></h2>
        <h3><?php echo CircleLaw_option('portfolio-title-desc'); ?></h3>
    <div class="clear"></div>
    </div>
    <div id="portfolio">
        
    <?php
    $per_page = CircleLaw_option('number_of_portfolio');
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $wpbp = new WP_Query(array( 'meta_key' => 'area_order', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'post_type' => 'portfolio', 'posts_per_page' => $per_page, 'paged' => $paged ) );
    if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
    $large_image = $large_image[0];
    ?>
        <!--Post-->
        <div class="single-portfolio">
            <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
            <div class="thumb">
                <img src="<?php img_resize($large_image,300,440) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>">
                <div class="thumb-hover">
                    <a href="<?php the_permalink(); ?>"></a>
                </div>  
            </div>
            <?php endif; ?>
            <h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
            <div class="clear"></div>
            <div class="details"><?php CircleLaw_excerpt(80); ?></div>
        </div>
        <!--Post-->     
    <?php endwhile; endif; // END the Wordpress Loop ?>
    <?php wp_reset_query(); // Reset the Query Loop?>
    <?php CircleLaw_right_pagination($wpbp->max_num_pages); ?>

    <div class="clear"></div>
    </div>
    <!--Archive Gallery-->
    
    <?php endwhile; endif; ?>

<?php get_footer(); ?>