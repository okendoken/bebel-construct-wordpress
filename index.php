<?php get_header(); ?>

<!-- HomePage -->
<div id="homepage">
  
  <ul id="circles">
      <?php
      $per_page = CircleLaw_option('number_home');
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $wpbp = new WP_Query(array( 'meta_key' => 'item_order', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'post_type' => 'homepage', 'posts_per_page' => CircleLaw_option('number_home') ) );
      if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
      $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
      $large_image = $large_image[0];
      ?>

  <!-- Cicles -->
  <li class="circle">
    <span class="shadow"></span>
    <a href="<?php echo get_post_meta($post->ID, 'item_url', true); ?>" class="c-img">
      <span class="c-imgg"><img src="<?php img_resize($large_image,305,305) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"></span></a>
    <div class="c-details">
      <div class="c-content">
        <h2><?php the_title() ?></h2>
        <div class="det"><?php echo get_post_meta($post->ID, 'item_description', true); ?></div>
      </div>
    <a href="<?php echo get_post_meta($post->ID, 'item_url', true); ?>"></a>
    </div>
    <div class="clear"></div>
  </li>
  <!-- Cicles -->

      <?php endwhile; endif; ?>
  </ul>
      <?php if (CircleLaw_option('number_home') > 2){ ?>
        <div id="pages">
          <a id="prev2" class="prev" href="#"></a>
          <a id="next2" class="next" href="#"></a>
        </div>
        <div class="clear"></div>
      <?php } ?>
</div>

<?php get_footer(); ?>