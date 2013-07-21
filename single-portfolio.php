<?php get_header(); ?>
     
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <!--Page Content-->
    <div id="page">
        <!--Portfolio Slider-->
        <div id="portfolio-slider">
                <?php
                $custom = get_post_custom($post->ID);
                $kgalleryp = unserialize( $custom["kboxgalleryp"][0] );
                $kgalleryp = array_reverse($kgalleryp);
                if( $kgalleryp ):
                    if (count($kgalleryp) > 1) {
                        echo '<ul class="bjqs">';
                    }else{
                        echo '<ul class="bjqss">';
                    }
                foreach( $kgalleryp as $galimg ): 
                ?>
                <li>
                    <div class="thumb">
                        <img src="<?php img_resize($galimg,344,507) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>">
                        <div class="thumb-hover">
                            <a href="<?php echo $galimg; ?>" rel="prettyPhoto[gallery]"></a>
                        </div>
                    </div>
                </li>
                <?php 
                endforeach; 
                endif; 
                ?>
            </ul>
        </div>
        <!--Portfolio Slider-->
        <h2 class="title"><?php echo get_the_title(); ?></h2>
        <div id="scroll" class="content">
            
            <?php the_content() ?>

            <!-- AddThis Button BEGIN -->
            <?php if (CircleLaw_option('addthis-buttons-portfolio') == "true"): ?>
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
    <!--Page Content-->

  <?php endwhile; endif; ?>

<?php get_footer(); ?>