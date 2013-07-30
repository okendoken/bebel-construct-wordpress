
 <?php
 
        foreach($this->modules['widgets'] as $key => $widget)
        {
          
        
            // include the needed template

            // same again, if its a core module, load directly from core
            // otherwise, check if it exists on bundle - but this time throw exception
            // if not found.

            $core_widget = get_template_directory().BebelUtils::getCorePath().'/admin/meta_panel/widgets/'.$widget['template'].'.php';

            if($this->modules['uses_bundle_templates'] == 'core')
            {
              include($core_widget);
            }else {
              

              $bundle_widget = get_template_directory().BebelUtils::getBundlePath().'/'.$this->modules['bundle'].'/admin/meta_panel/widgets/'.$widget['template'].'.php';
              
              $file = file_exists($bundle_widget)
                      ? $bundle_widget
                      : $core_widget;
               
              include($file);
            }
          
        }
        ?>