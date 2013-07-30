<?php

/*
 * scans a folder
 */

$folder = $widget['options']['folder'];
$absurl = $widget['options']['absurl'];
$scan = scandir($folder);

$elements = count($scan);
$options = array();


for($q=0;$q<$elements;$q++)
{
    if($scan[$q] != '.' && $scan[$q] != '..')
    {
        
        $replace = array('.jpg', '.png', '.gif', '.jpeg');
        
        $value = str_replace($replace, '', strtolower($scan[$q]));
        
        $options[] = array('name' => $value, 'filename' => $scan[$q]);
        
        
    }
    
}

$values = $this->settings->get($key);

?>

<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>

<div class="grid_15 omega">
  <div class="widget">
      <input type="hidden" value="<?php echo $absurl ?>" name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>][absurl]" />
      <?php foreach($options as $option => $value): ?>
      <div style="width: 500px;">
          <img style="float: left; margin: 2px 0px; margin-right: 10px" src="<?php echo trailingslashit($absurl).$value['filename'] ?>" alt="<?php echo $value['name'] ?>" />
          <input type="hidden" value="<?php echo $value['filename'] ?>" name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>][<?php echo $value['name'] ?>][file]" />
          
          <input type="text" value="<?php echo isset($values[$value['name']]['url']) ? $values[$value['name']]['url'] : '' ?>" name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>][<?php echo $value['name'] ?>][url]" />
          (<?php _e(sprintf('Enter URL to your %s profile / page here)', $value['name']),$this->settings->getPrefix()) ?><br class="clear" />
          
      </div>
      
      <?php endforeach; ?>
    
    <p class="help"><?php echo $widget['description']?></p>
  </div>
</div>


<br class="clear" />
