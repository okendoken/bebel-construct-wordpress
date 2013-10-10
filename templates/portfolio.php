<?php
$settings = BebelSingleton::getInstance('BebelSettings');
get_template_part( 'templates/_navigation-no-image', get_post_format() ); ?>
    <section id="page-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                ?>
                <h4 class="page-title">
                    <?php the_title() ?>
                    <small><?php echo get_the_content() ?></small>
                </h4>
            <?php
            }
        }
        query_posts(array(
            'post_type' => 'construct_portfolio',
            'paged' => get_query_var('paged'),
            'posts_per_page' => $settings->get('portfolio_per_page')
        ));
        if (have_posts()) {?>
            <div class="team">
                <?php
                $i = 0;
                $row_closed = true;
                while (have_posts()) {
                    the_post();
                    if ($i % 4 == 0){//for each fourth display .row-fluid?>
                        <div class="row">
                        <?php
                        $row_closed = false;
                    }

                    get_template_part( 'templates/_team-member', get_post_format() );

                    if ($i % 4 == 3){//for each fourth close .row-fluid?>
                        </div>
                        <?php
                        $row_closed = true;
                    }
                    $i++;
                }
                if (!$row_closed){// if some row went unnoticed
                    echo '</div>';
                }
                ?>
            </div>
            <?php
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
        wp_reset_query();
        wp_reset_postdata();

        ?>
    </section>
<?php
bebelThemeUtils::getPageFooterTemplate();