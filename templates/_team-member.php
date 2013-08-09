<section id="post-<?php the_ID(); ?>" <?php post_class('team-member span3'); ?>>
    <?php if(has_post_thumbnail()): ?>
        <?php the_post_thumbnail('team-small'); ?>
    <?php endif ?>
    <h5 class="name"><?php the_title() ?></h5>
    <?php if(BebelUtils::getCustomMeta('member_position', false, get_the_ID())): ?>
        <div class="position"><?php echo BebelUtils::getCustomMeta('member_position', false, get_the_ID()) ?></div>
    <?php endif; ?>
    <p class="description"><?php echo get_the_content() ?></p>
    <div class="social-icons">
        <a href="#"><i class="icon-linkedin icon-large"></i></a>
        <a href="#"><i class="icon-twitter icon-large"></i></a>
        <a href="#"><i class="icon-facebook icon-large"></i></a>
        <a href="#"><i class="icon-google-plus icon-large"></i></a>
    </div>
</section>