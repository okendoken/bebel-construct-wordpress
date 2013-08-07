<?php
  $title = isset($widget['options']['first']) ? $widget['options']['first'] : 'Template';
?>
<div class="widget_title">
  <h4><?php echo $widget['title'] ?></h4>
</div>

<div class="widget_widget">
  <select name="<?php echo $this->settings->getPrefix().'_'.$key ?>">
    
      <?php echo BebelUtils::createListByOptions($this->getOption($key), $widget['options']['options'], $title); ?>
  </select>
  <p class="help"><?php echo $widget['description']?></p>
</div>


<div class="clear" > </div>

