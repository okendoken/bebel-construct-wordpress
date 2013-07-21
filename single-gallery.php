<?php get_header(); ?>
     
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <!--Single Gallery-->
    <div id="single-gallery">
      
      <?php 
        $custom = get_post_custom($post->ID);
        $kgallery = unserialize( $custom["kboxgallery"][0] );
        $kgallery = array_reverse($kgallery);
        if (get_post_meta($post->ID, 'gallery_layout', true) == "gallery_layout_random"){
          $per = 6;
        }else{
          $per = 8;
        }
        $pages = ceil(count($kgallery)/$per);
        get_single_gallery($pages,$post->ID);
      ?>
      
      <div id="result"></div>
      <div id="loading"></div>

        <!--Pages-->
        <?php if ($pages > 1): ?>
        <div id="pages">
                
          <a href="#" class="next"></a>
          <div class="no-prev"></div>
          <div class="clear"></div>
          <span><div class="nowpage fleft"></div>/<?php echo $pages; ?> <?php _e( 'Pages', 'CircleLaw' ) ?></span>

        </div>
        <?php endif ?>
        <!--Pages-->

    <div class="clear"></div>
    </div>
    <!--Single Gallery-->

<?php endwhile; endif; ?>

<?php get_footer(); ?>