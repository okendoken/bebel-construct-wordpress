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
get_template_part( 'templates/_navigation-no-image', get_post_format() ); ?>
    <section id="page-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
        <h4 class="page-title"><?php single_cat_title(); ?></h4>
        <?php
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

get_footer();