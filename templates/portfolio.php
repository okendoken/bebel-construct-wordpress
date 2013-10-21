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
            'paged' => get_query_var('paged')
        ));
        if (have_posts()) {?>
            <?php
            $tags = get_terms( $settings->getPrefix().'_portfolio-category');
            if ($tags) {
                $tags_string = "";
                if ($tags) {
                    foreach($tags as $tag) {
                        $tags_string .= ' '.$tag->name;
                    }
                }
                ?>
                <ul id="portfolio-filters" class="portfolio-filters">
                    <li><span class="filter active label" data-filter="<?php echo $tags_string ?>">
                            <?php echo __('All', $settings->getPrefix()) ?>
                    </span></li>
                    <?php foreach($tags as $tag) { ?>
                        <li><span href="#" class="filter label" data-filter="<?php echo $tag->name ?>"><?php echo $tag->name ?></span></li>
                    <?php } ?>
                </ul>
            <?php
            }
            ?>
            <div class="team" id="portfolio">
                <div class="row">
                    <?php
                    while (have_posts()) {
                        the_post();
                        get_template_part( 'templates/_portfolio-item', get_post_format() );
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        wp_reset_query();
        wp_reset_postdata();

        ?>
    </section>
<?php
bebelThemeUtils::getPageFooterTemplate();