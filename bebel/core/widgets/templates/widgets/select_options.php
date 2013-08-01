<h4 class="widget_title_top"><label for="<?php echo $this->get_field_id($key) ?>"><?php echo $widget['title'] ?></label></h4>

<div class="widget_widget">
  <select id="<?php echo $this->get_field_id($key) ?>" name="<?php echo $this->get_field_name($key) ?>">
    <?php echo BebelUtils::createListByOptions($this->getOption($key), $widget['options']['options'], $widget['options']['first']); ?>
  </select>
  <p class="help"><?php echo $widget['description']?></p>
</div>


<br class="clear" />