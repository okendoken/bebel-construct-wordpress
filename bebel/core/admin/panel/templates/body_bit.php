<?php

  $style = ($i > 1) ? ' style="display:none"' : '';

?>
<div id="bebel_admin_panel_tabs-<?php echo $i ?>" class="grid_24"<?php echo $style ?>>
  <input type="submit" name="submit" class="button-primary" style="float: right; margin-bottom: 15px;" value="<?php _e('Save your changes!', $this->settings->getPrefix()) ?>" />
  <br class="clear" />
  <?php  
  if($this->hasSubmenu($base))
  {
    
    $core_submenu = get_template_directory().BebelUtils::getCorePath().'/admin/panel/templates/body_bit_submenu.php';
    if($module['bundle'] == 'core')
    {
      include($core_submenu);
    }else {
      $bundle_submenu = get_template_directory().BebelUtils::getBundlePath().'/'.$module['bundle'].'/admin/panel/templates/body_bit_submenu.php';
      $file = file_exists($bundle_submenu)
                    ? $bundle_submenu
                    : $core_submenu;

      include($file);
      
    }
  }

  ?>
  
  <input type="submit" name="submit" class="button-primary" style="float: right; margin-top: 15px;" value="<?php _e('Save your changes!', $this->settings->getPrefix()) ?>" />
</div>