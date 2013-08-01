<?php

/**
 * contains all methods all widgets share.
 */
class BebelWidgetBase extends WP_Widget {

  protected 
      $core_widget_path = '',
      $settings,
      $scripts,
      $styles;
  
  public function __construct() 
  {
    
    $this->desc_name = BebelSingleton::getInstance('BebelSettings')->getThemeName().' '.$this->desc_name;
	parent::__construct($this->widget_name, $this->desc_name, $this->widget_ops);
    $this->core_widget_path = get_template_directory().BebelUtils::getCorePath().'/widgets/';
  }

  public function getOption($key)
  {
    return $this->values[$key];
  }

  public function buildForm()
  {
    $this->settings = BebelSingleton::getInstance('BebelSettings');

    foreach($this->setup as $key => $widget)
    {
      $this->loadTemplate($widget['template'], $widget, $key);
      
    }
  }

  /**
   * We might be including some templates in templates, and we don't
   * want to mess around with the path manually.
   *
   * @param string $template
   * @param array  $widget
   * @param string $key
   */
  protected function loadTemplate($template, $widget, $key)
  {
    // first check in core
      
    $filepath = $this->core_widget_path.'/templates/widgets/'.$template.'.php';
    if(isset($widget['bundle']))
    {
      $filepath_bundle = get_template_directory().BebelUtils::getBundlePath().'/'.$widget['bundle'].'/widgets/templates/widgets/'.$template.'.php';
     
      // check if widget exists in bundle path. if not, check if default one exists. if not, throw exception
      if(file_exists($filepath_bundle))
      {
        $filepath = $filepath_bundle;
      }
    }
    if(!file_exists($filepath))
    {
      throw new BebelException(sprintf("Sorry, you are trying to load a template (<strong>%s</strong>) that does exist neither in a bundle (<strong>%s</strong>) nor in the core. The responsible widget for this is <strong>%s</strong>", $template, $widget['bundle'], $key));
    }

    include($filepath);

  }


	public function update($new_instance, $old_instance) 
    {
        $instance = $old_instance;

        foreach($this->setup as $key => $widget) {

            $instance[$key]  = is_array($new_instance[$key]) ? $new_instance[$key] : strip_tags($new_instance[$key]);
        }
		return $instance;
	}


	public function form($instance) 
    {
        $default_values = array();
        foreach($this->setup as $key => $widget)
        {
        $default_values[$key] = isset($widget['options']['default']) ? $widget['options']['default'] : '';
        }
        $instance = wp_parse_args((array) $instance, $default_values);


        $this->values = $instance;

        echo "<div>";
        $this->buildForm();
        echo "</div>";
    }

  public function renderOutput($param)
  {
    $this->settings = BebelSingleton::getInstance('BebelSettings');
    extract($param,  EXTR_SKIP); // I don't like this ....
    
    $filepath = $this->core_widget_path.'/templates/output/';
    if(isset($this->widget_settings['bundle']))
    {
      $filepath_bundle = get_template_directory().BebelUtils::getBundlePath().'/'.$this->widget_settings['bundle'].'/widgets/templates/output/';
      if(file_exists($filepath_bundle))
        {
          $filepath = $filepath_bundle;
        }
    }
    if(!file_exists($filepath))
    {
      throw new BebelException(sprintf('Sorry, you are trying to load a template (<strong>%s</strong>) that does exist neither in a bundle (<strong>%s</strong>) nor in the core. The responsible widget for this is <strong>%s</strong>', $this->widget_ops['classname'], $this->widget_settings['bundle'], $key));
    }

    
    
    include($filepath.$this->widget_ops['classname'].'.php');
  }

}