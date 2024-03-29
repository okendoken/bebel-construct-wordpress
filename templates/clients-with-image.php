<?php
$settings = BebelSingleton::getInstance('BebelSettings');

$postSlider = new BebelPostSlider(get_the_ID(), "horizontal-medium");
$postSlider->getImages();

BebelSingleton::addClass('postSlider', $postSlider);

get_template_part( 'templates/_navigation', get_post_format() );
get_template_part( 'templates/_carousel', get_post_format() ); ?>
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
            'post_type' => 'construct_client',
            'posts_per_page' => 1000
        ));
        if (have_posts()) {?>
            <div class="tabbable tabs-left clients">
                <ul id="clients" class="nav nav-tabs">
                    <?php
                    $active = true;
                    while (have_posts()) {
                        the_post();  ?>
                        <li<?php echo $active ? ' class="active"' : ''?>>
                            <?php
                            get_template_part( 'templates/_client-tab', get_post_format() );
                            ?>
                        </li>
                        <?php
                        $active = false;
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <?php
                    rewind_posts();
                    $active = true;
                    while (have_posts()) {
                        the_post();?>
                        <div class="tab-pane<?php echo $active ? ' active visible' : ''?>" id="client-<?php echo get_the_ID()?>">
                            <?php
                            get_template_part( 'templates/_client', get_post_format() );
                            ?>
                        </div>
                        <?php
                        $active = false;
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