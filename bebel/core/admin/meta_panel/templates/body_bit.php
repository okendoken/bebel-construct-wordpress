<?php

  $style = ($j > 1) ? ' style="display:none"' : '';
 

?>
<div id="bebel_admin_meta_panel_tabs-<?php echo $j ?>" class="grid_10"<?php echo $style ?>>


  <?php
        foreach($this->modules['widgets'] as $key => $widget)
        {
          if($widget['menu_item'] == $base && (in_array($this->post_type_raw, $widget['scope']) || in_array('global', $widget['scope'])))
          {

            // include the needed template

            // same again, if its a core module, load directly from core
            // otherwise, check if it exists on bundle - but this time throw exception
            // if not found.

            $core_widget = get_template_directory().BebelUtils::getCorePath().'/admin/meta_panel/widgets/'.$widget['template'].'.php';

            if($module['bundle'] == 'core')
            {
              include($core_widget);
            }else {
              $bundle_widget = get_template_directory().BebelUtils::getBundlePath().'/'.$module['bundle'].'/admin/meta_panel/widgets/'.$widget['template'].'.php';
              $file = file_exists($bundle_widget)
                      ? $bundle_widget
                      : $core_widget;

              include($file);
            }
          }
        }
        ?>

</div><br class="clear" />