<?php
//template name: Left Sidebar
get_header(); ?>
     
	<?php if (have_posts()) : while (have_posts()) : the_post();
    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
    $large_image = $large_image[0]; ?>
<style type="text/css">
#page {
	height: auto;
    padding-bottom: 20px;
    padding-top: 40px;
}
#page .content {
    height: auto;
}
#page .thumb {
    float: none;
    margin-bottom: 30px;
}
#page .thumb img {
    box-shadow: 0 1px 8px -2px #888888;
    height: auto;
    margin-left: 0;
    margin-right: 0;
    width: auto;
}
.sidel {
    float: right;
    width: 590px;
}
.sidebar {
    float: left;
    width: 300px;
}
#page h2.title {
	padding-top: 0;
}
</style>
	    <!--Page Content-->
	    <div id="page">
	        <div class="sidel">
		        <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
		        <div class="thumb"><img src="<?php img_resize($large_image,590,240) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"></div>
		        <?php endif; ?>
		        <h2 class="title"><?php the_title(); ?></h2>
		        <div class="content">
		        	<?php the_content(); ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
			<div class="clear"></div>
	    </div>
	    <!--Page Content-->

    <?php endwhile; endif; ?>

<?php get_footer(); ?>