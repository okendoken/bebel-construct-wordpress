<?php get_header(); //template name: Team ?>
     
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <!--Team-->
    <div class="top-titles">
        <h2><?php echo CircleLaw_option('team-title'); ?></h2>
        <h3><?php echo CircleLaw_option('team-title-desc'); ?></h3>
    <div class="clear"></div>
    </div>
    <div id="team">
        
    <?php
    $per_page = CircleLaw_option('number_of_team');
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $wpbp = new WP_Query(array( 'meta_key' => 'person_order', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'post_type' => 'team', 'posts_per_page' => $per_page, 'paged' => $paged ) );
    if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
    $large_image = $large_image[0];
    ?>
        <!--Post-->
        <div class="single-team">
            <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
            <div class="t-thumb"><img src="<?php img_resize($large_image,206,206) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"></div>
            <?php endif; ?>
            <a href="mailto:<?php echo get_post_meta($post->ID, 'person_email', true); ?>" class="e-mail">
                <span class="email"></span></a>
            <h2><?php echo get_the_title(); ?></h2>
            <div class="details"><?php echo get_post_meta($post->ID, 'person_description', true); ?></div>
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