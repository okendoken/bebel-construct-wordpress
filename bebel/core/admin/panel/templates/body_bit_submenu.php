<?php $submenu_unique_id = uniqid(); ?>
<script tyle="text/javascript">
  <!--
    jQuery(document).ready(function() {
      jQuery('#bebel_admin_panel_submenu_tabs<?php echo $submenu_unique_id ?>').btabs({"debug": false, "effect": "fade", "count": <?php echo $this->getSubmenuCount($base) ?>,"linkActiveStateClass": "bebel_admin_panel_submenu_container_active", "tabNavigationClass" : "submenu"});
      
    });
  -->
</script>

<div id="bebel_admin_panel_submenu_tabs<?php echo $submenu_unique_id ?>" class="grid_24 alpha">
  <div class="grid_4 alpha submenu-container">
    <div class="bebel_admin_panel_submenu_container">
      <a href="#" class="menu-top"><?php _e('Submenu', $this->settings->getPrefix()) ?></a>
      <ul class="submenu">
        <?php echo $this->getSubmenu($base, $submenu_unique_id); ?>
      </ul> <br class="clear" />
    </div>

  </div>
  <div class="grid_20 omega">
    <?php
      $j = 0;
      foreach($this->getSubmenuEntries() as $submenu):
              $j++;
    ?>
      <div id="bebel_admin_panel_submenu_tabs<?php echo $submenu_unique_id ?>-<?php echo $j; ?>" class=" bebel_admin_panel_main_container">
        <?php
        foreach($module['widgets'] as $key => $widget)
        {
          if($widget['submenu'] == $submenu) {

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
                      ? $bundle_widget
                      : $core_widget;
              include($file);
            }
          }
        }
        ?>
        <br class="clear" />
    </div>
    <?php endforeach; ?>
    
  </div>
</div>