<?php
get_template_part( 'templates/_navigation-no-image'); ?>
    <section id="page-<?php echo $post ? get_the_ID() : 'no-results'; ?>" class="page-content">
        <h4 class="page-title"><?php the_title() ?></h4>
        <?php
        query_posts(array(
            'post_type' => 'post',
            'paged' => $paged
        ));
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part( 'templates/_blog-article', get_post_format() );
            }
        }
        global $wp_query;
        if ($wp_query->max_num_pages > 1){?>
            <div class="pagination text-align-center">
                <ul>
                    <?php echo bebelUtils::getNumberedPagination($wp_query->max_num_pages, $paged, 3, '', 'active'); ?>
                </ul>
            </div>
        <?php
        }
        ?>
    </section>
<?php
bebelThemeUtils::getPageFooterTemplate();