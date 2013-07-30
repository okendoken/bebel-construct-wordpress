    <?php

    // check layout
    switch($this->modules['meta_panel_type'])
    {
      /**
       * it is a flat menu. will not have any menu
       */
      case 'flat':
        echo $this->getSpecialfields();
        // flat page, no tabs needed
        $core_file = get_template_directory().BebelUtils::getCorePath().'/admin/meta_panel/templates/body_flat.php';
        if(!isset($module['uses_bundle_templates']) || $module['uses_bundle_templates'] == 'core')
        {
          include($core_file);
        }else {
          $bundle_file = get_template_directory().BebelUtils::getBundlePath().'/'.$module['bundle'].'/admin/meta_panel/templates/body_flat.php';
          $file = file_exists($bundle_file)
                  ? $bundle_file
                  : $core_file;

          include($file);
        }
        break;

      /**
       * it is a standard tab navigation menu.
       * has tabs on top
       */
      case 'tab':

        echo '<div id="bebel_admin_meta_panel_tabs">';
        wp_nonce_field('bebel-custom-fields', 'bebel-custom-fields_wpnonce', false, true);

        // create with menu
        $this->createMenu();

        $j = 0;
        // checks if the loaded module is from a bundle, and if so, has a special body_bit file.
        foreach($this->modules['menu_items'] as $base => $module)
        {
          if(in_array($this->post_type_raw, $module['scope']) || in_array('global', $module['scope']))
          {
            $j++;
            
            $core_file = get_template_directory().BebelUtils::getCorePath().'/admin/meta_panel/templates/body_bit.php';
            if($module['bundle'] == 'core')
            {
              include($core_file);
            }else {
              $bundle_file = get_template_directory().BebelUtils::getBundlePath().'/'.$module['bundle'].'/admin/meta_panel/templates/body_bit.php';
              $file = file_exists($bundle_file)
                      ? $bundle_file
                      : $core_file;

              include($file);
            }
          }
        }

        echo '</div>';
        
        break;
    }
    ?>