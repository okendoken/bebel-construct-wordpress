<?php
//template name: Full Height(Not Boxed).
get_header(); ?>
     
	<?php if (have_posts()) : while (have_posts()) : the_post();
    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
    $large_image = $large_image[0]; ?>
<style type="text/css">
#page {
	height: auto;
	padding-bottom: 20px;
}
#page .content {
    height: auto;
}
#page .thumb {
    float: none;
}
#page .thumb img {
    box-shadow: 0 5px 10px -5px #888888;
    height: auto;
    margin-left: -40px;
    margin-right: 0;
    width: auto;
}
</style>
	    <!--Page Content-->
	    <div id="page">
	        <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
	        <div class="thumb"><img src="<?php img_resize($large_image,1000,390) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"></div>
	        <?php endif; ?>
	        <h2 class="title"><?php the_title(); ?></h2>
	        <div class="content">
	        	<?php the_content(); ?>
			</div>
	    </div>
	    <!--Page Content-->

    <?php endwhile; endif; ?>
    
<?php get_footer(); ?>