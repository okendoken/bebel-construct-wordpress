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
            if ( is_day() ) :
                printf( __( 'Daily Archives: %s', $settings->getPrefix()  ), '<span>' . get_the_date() . '</span>' );
            elseif ( is_month() ) :
                printf( __( 'Monthly Archives: %s', $settings->getPrefix()  ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', $settings->getPrefix()  ) ) . '</span>' );
            elseif ( is_year() ) :
                printf( __( 'Yearly Archives: %s', $settings->getPrefix() ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', $settings->getPrefix()  ) ) . '</span>' );
            else :
                _e( 'Archives', 'twentytwelve' );
            endif;
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
        }
        ?>
    </section>
<?php
bebelThemeUtils::getPageFooterTemplate();
bebelThemeUtils::getLogoTemplate(true);

get_footer();