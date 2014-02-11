<section class="post-preview">
    <?php if ( has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-preview-image">
            <span data-picture data-alt="<?php the_title() ?>">
                <?php $small = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog-preview-small' );?>
                <span data-src="<?php echo $small[0] ?>"></span>
                <?php $large = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog-preview-large' );?>
                <span data-src="<?php echo $large[0] ?>" data-media="(max-width: 767px)"></span>
                <!-- Fallback content for non-JS browsers. Same img src as the initial, unqualified source element. -->
                <noscript>
                    <?php the_post_thumbnail('blog-preview-small'); ?>
                </noscript>
            </span>
        </a>
    <?php endif; ?>
    <div class="description">
        <h5 class="title"><a href="#"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title()?></a></h5>
        <?php
        global $more;
        $more = 0;
        ?>
        <?php the_content(__('more...', 'bebel'))?>
        <?php
        $categories = get_the_category();
        $separator = ' ';
        $output = '';
        if($categories){
            foreach($categories as $category) {
                $output .= '<a href="'.get_category_link( $category->term_id )
                    .'" title="' . esc_attr( sprintf( __( "View all posts in %s", BebelSingleton::getInstance('BebelSettings')->getPrefix() ), $category->name ) ) . '">'
                    .$category->cat_name.'</a>'.$separator;
            }
        }
        ?>
        <div class="post-preview-info">
            <div class="row">
                <div class="col-sm-7 col-sm-offset-2 col-xs-10">
                    <span class="category-link">
                        <i class="icon-inbox"></i>
                                <?php echo __('posted in', 'bebel')?>
                                <?php echo trim($output, $separator);?>
                    </span>
                </div>
                <div class="col-sm-3 col-xs-10">
                    <span class="comments-link">
                        <i class="icon-comments"></i>
                        <a href="<?php the_permalink(); ?>#comments" title="<?php the_title_attribute(); ?>">
                            <?php comments_number(
                                __('No Comments', 'bebel'),
                                __('One Comment', 'bebel'),
                                __('% Comments', 'bebel')); ?>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>