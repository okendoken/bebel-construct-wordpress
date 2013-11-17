<?php
get_header();
$settings = BebelSingleton::getInstance('BebelSettings');
?>
    <!--Start Header-->
    <header>
        <?php bebelThemeUtils::getLogoTemplate(false, false); ?>
    </header><!--End Header-->
    <!--Start Main Content-->
<div class="content">
<?php
get_template_part( 'templates/_navigation-no-image' ); ?>
    <section id="page-<?php echo $post ? get_the_ID() : 'no-results'; ?>" class="page-content">
        <h4 class="page-title"><?php
            printf( __( 'Search results for: %s', $settings->getPrefix() ), '<span>' . get_search_query() . '</span>' );
            ?></h4>
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part( 'templates/_blog-article', get_post_format() );
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
        } else {?>
            <article id="post-0" class="post no-results not-found">
                <header class="entry-header">
                    <h2 class="entry-title"><?php _e( 'Nothing Found', $settings->getPrefix() ); ?></h2>
                </header>

                <div class="entry-content">
                    <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', $settings->getPrefix() ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-0 -->
        <?php
        }
        ?>
    </section>
<?php
bebelThemeUtils::getPageFooterTemplate();
bebelThemeUtils::getLogoTemplate(true);

get_footer();