<h5><?php the_title()?></h5>
<?php if(has_post_thumbnail()): ?>
    <?php the_post_thumbnail('clients-preview'); ?>
<?php endif ?>
<?php the_content() ?>
<?php if(BebelUtils::getCustomMeta('client_website', false, get_the_ID())): ?>
    <a href="<?php echo BebelUtils::outputUrl(BebelUtils::getCustomMeta('client_website', false, get_the_ID())) ?>" class="clients-website">visit clients website</a>
<?php endif; ?>