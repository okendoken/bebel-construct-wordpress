<div class="grid_4 push_1 alpha">
    <h4><?php echo $widget['title'] ?></h4>
</div>
<div class="grid_15 omega">
    <?php $url = site_url()."/wp-admin/admin-ajax.php"; ?>
    <div class="widget">
        <button id="generate-2x-image-for-all" data-uri="<?php echo $url; ?>" type="button" class="button-primary">
            <?php echo __('Regenerate', BebelSingleton::getInstance('BebelSettings')->getPrefix()); ?>
        </button>
        <p class="help"><?php echo $widget['description']?></p>
        <p class="help"><?php echo $widget['help'] ?></p>
    </div>

</div>