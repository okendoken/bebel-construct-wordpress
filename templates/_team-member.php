<section id="post-<?php the_ID(); ?>" <?php post_class('team-member col-md-3 col-sm-6'); ?>>
    <?php if(has_post_thumbnail()): ?>
        <span data-picture data-alt="<?php the_title() ?>">
            <?php $small = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'team-small' );?>
            <span data-src="<?php echo $small[0] ?>"></span>
            <?php $large = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'team-large' );?>
            <span data-src="<?php echo $large[0] ?>" data-media="(max-width: 767px)"></span>
            <!-- Fallback content for non-JS browsers. Same img src as the initial, unqualified source element. -->
            <noscript>
                <?php the_post_thumbnail('team-small'); ?>
            </noscript>
        </span>
    <?php endif ?>
    <h5 class="name"><?php the_title() ?></h5>
    <?php if(BebelUtils::getCustomMeta('member_position', false, get_the_ID())): ?>
        <div class="position"><?php echo BebelUtils::getCustomMeta('member_position', false, get_the_ID()) ?></div>
    <?php endif; ?>
    <p class="description"><?php echo get_the_content() ?></p>
    <?php
    $twitter = BebelUtils::getCustomMeta('member_twitter', false, get_the_ID());
    $facebook = BebelUtils::getCustomMeta('member_facebook', false, get_the_ID());
    $linkedin = BebelUtils::getCustomMeta('member_linkedin', false, get_the_ID());
    $googple_plus = BebelUtils::getCustomMeta('member_googple_plus', false, get_the_ID());
    ?>
    <?php if ($twitter || $facebook || $linkedin || $googple_plus) { ?>
        <div class="social-icons">
            <?php if ($linkedin) {?>
                <a target="_blank" href="<?php echo BebelUtils::outputUrl($linkedin); ?>"><i class="icon-linkedin icon-large"></i></a>
            <?php } ?>
            <?php if ($twitter) {?>
                <a target="_blank" href="<?php echo BebelUtils::outputUrl($twitter); ?>"><i class="icon-twitter icon-large"></i></a>
            <?php } ?>
            <?php if ($facebook) {?>
                <a target="_blank" href="<?php echo BebelUtils::outputUrl($facebook); ?>"><i class="icon-facebook icon-large"></i></a>
            <?php } ?>
            <?php if ($googple_plus) {?>
                <a target="_blank" href="<?php echo BebelUtils::outputUrl($googple_plus); ?>"><i class="icon-google-plus icon-large"></i></a>
            <?php } ?>
        </div>
    <?php } ?>
</section>