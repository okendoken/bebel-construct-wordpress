<?php

  $categories = get_categories();
  $values = $this->getOption($key);
  if(empty($values))
  {
    $values = array();
  }
?>
<h4 class="widget_title_top"><label for="<?php echo $this->get_field_id($key) ?>"><?php echo $widget['title'] ?></label></h4>

<div class="widget_widget">
  <?php
    foreach($categories as $category):
      $checked = in_array($category->term_id, $values) ? 'checked="checked"' : '';
  ?>
  <input type="checkbox" <?php echo $checked ?> name="<?php echo $this->get_field_name($key) ?>[]" value="<?php echo $category->term_id; ?>" id="<?php echo $this->get_field_id($key).$category->term_id ?>" /> <label for="<?php echo $this->get_field_id($key).$category->term_id ?>"><?php echo $category->name; ?></label><br />
  <?php
    endforeach; 
  ?>
  <p class="help"><?php echo $widget['description']?></p>
</div>


<br class="clear" />