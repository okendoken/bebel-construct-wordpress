<div id="bebel_admin_panel_tabs" class="container_24">
  <?php

  // create menu
  $this->createMenu();

  $i = 0;
  // checks if the loaded module is from a bundle, and if so, has a special body_bit file.
  foreach($this->modules as $base => $module)
  {
    $i++;
    $core_file = get_template_directory().BebelUtils::getCorePath().'/admin/panel/templates/body_bit.php';
    if($module['bundle'] == 'core')
    {
      include($core_file);
    }else {
      $bundle_file = get_template_directory().BebelUtils::getBundlePath().'/'.$module['bundle'].'/admin/panel/templates/body_bit.php';
      $file = file_exists($bundle_file)
              ? $file
              : $core_file;
      
      include($file);
      
      
    }
    
  }
  ?>
</div>