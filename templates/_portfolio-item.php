<?php
$settings = BebelSingleton::getInstance('BebelSettings');
$post_tags = get_the_terms( $post->ID, $settings->getPrefix().'_portfolio-category');
$post_tags_string = "";
if ($post_tags) {
    foreach($post_tags as $tag) {
        $post_tags_string .= $tag->name . ' ';
    }
}
?>
<section id="post-<?php the_ID(); ?>" <?php post_class('team-member portfolio-item col-md-4 col-sm-6 '.$post_tags_string); ?>>
    <?php
    $website = BebelUtils::getCustomMeta('portfolio_website', false, get_the_ID());
    ?>
    <?php if(has_post_thumbnail()): ?>
        <?php if ($website) { ?>
            <a target="_blank" href="<?php echo BebelUtils::outputUrl($website); ?>">
        <?php } ?>
            <span data-picture data-alt="<?php the_title() ?>">
                <?php $small = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'portfolio-small' );?>
                <span data-src="<?php echo $small[0] ?>"></span>
                <?php $large = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'portfolio-large' );?>
                <span data-src="<?php echo $large[0] ?>" data-media="(max-width: 767px)"></span>
                <!-- Fallback content for non-JS browsers. Same img src as the initial, unqualified source element. -->
                <noscript>
                    <?php the_post_thumbnail('portfolio-small'); ?>
                </noscript>
            </span>
        <?php if ($website) { ?>
            </a>
        <?php } ?>
    <?php endif ?>
    <h5 class="name"><?php the_title() ?></h5>
    <p class="description"><?php echo get_the_content() ?></p>
    <?php if ($website) { ?>
        <div class="website">
            <a target="_blank" href="<?php echo BebelUtils::outputUrl($website); ?>">
                <?php echo __('See Portfolio Item', BebelSingleton::getInstance('BebelSettings')->getPrefix()) ?>
            </a>
        </div>
    <?php } ?>
</section>