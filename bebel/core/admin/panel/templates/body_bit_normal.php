
<?php

  foreach($module['widgets'] as $key => $widget)
  {

    // include the needed template

    // same again, if its a core module, load directly from core
    // otherwise, check if it exists on bundle - but this time throw exception
    // if not found.

    $core_widget = get_template_directory().BebelUtils::getCorePath().'/admin/panel/widgets/'.$widget['template'].'.php';

    if($module['bundle'] == 'core')
    {
      include($core_widget);
    }else {
      $bundle_widget = get_template_directory().BebelUtils::getBundlePath().'/'.$module['bundle'].'/admin/panel/widgets/'.$widget['template'].'.php';
      $file = file_exists($bundle_widget)
              ? $file
              : $core_widget;

      include($file);
    }



  }

  ?>