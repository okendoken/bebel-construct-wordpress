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
        <?php the_content(__('more...', BebelSingleton::getInstance('BebelSettings')->getPrefix()))?>
    </div>
</section>