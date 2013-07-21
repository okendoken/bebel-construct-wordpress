<?php
//template name: Page Image Right
get_header(); ?>
     
	<?php if (have_posts()) : while (have_posts()) : the_post();
	$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
    $large_image = $large_image[0]; ?>
<style type="text/css">
#page {
    padding-right: 40px;
    padding-left: 30px;
}
#page .thumb {
    float: right;
}
#page .thumb img {
    box-shadow: -13px -5px 20px -15px #888888;
    margin-right: -40px;
    margin-left: 40px;
}
</style>
	    <!--Page Content-->
	    <div id="page">
	        <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
	        <div class="thumb"><img src="<?php img_resize($large_image,344,507) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"></div>
	        <?php endif; ?>
	        <h2 class="title"><?php the_title(); ?></h2>
	        <div id="scroll" class="content">
	        	<?php the_content(); ?>
			</div>
	    </div>
	    <!--Page Content-->

    <?php endwhile; endif; ?>
    
<?php get_footer(); ?>