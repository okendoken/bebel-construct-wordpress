<?php
$settings = BebelSingleton::getInstance('BebelSettings');

$postSlider = new BebelPostSlider(get_the_ID(), "horizontal-medium");
$postSlider->getImages();

BebelSingleton::addClass('postSlider', $postSlider);

get_template_part( 'templates/_navigation', get_post_format() );
get_template_part( 'templates/_carousel', get_post_format() ); ?>
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
            <div class="text-align-center">
                <ul class="pagination">
                    <?php echo bebelUtils::getNumberedPagination($wp_query->max_num_pages, $paged, 3, '', 'active'); ?>
                </ul>
            </div>
        <?php
        }
        ?>
    </section>
<?php
bebelThemeUtils::getPageFooterTemplate();