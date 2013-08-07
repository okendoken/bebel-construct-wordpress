<?php


/**
 * This class takes care of the most basic stuff WordPress needs to run
 * Filters, Actions, Theme Support, ...
 *
 *
 */
class BebelWordPress
{

  protected
    $filters = array(),
    $actions = array(),
    $theme_support = array(),
    $enqueue_scripts = array(),
    $enqueue_styles = array(),
    $nav_menus = array(),
    $admin_panel = array(),
    $image_sizes = array(),
    $utils,
    $defaultEnvironment = 'frontend';


  public function __construct()
  {
  }

  public function get($what)
  {
    return $this->$what;
  }


  /**
   * Adds new filters or actions
   *
   * @param array $objects
   */
  public function add(array $objects)
  {
    if(isset($objects['theme_support']))
    {
      $this->theme_support = array_merge($objects['theme_support'], $this->theme_support);
    }
    if(isset($objects['actions']))
    {
      $this->actions = array_merge($objects['actions'], $this->actions);
    }
    if(isset($objects['filters']))
    {
      $this->filters = array_merge($objects['filters'], $this->filters);
    }
    if(isset($objects['enqueue_scripts']))
    {
      $this->enqueue_scripts = array_merge($objects['enqueue_scripts'], $this->enqueue_scripts);
    }
    if(isset($objects['enqueue_styles']))
    {
      $this->enqueue_styles = array_merge($objects['enqueue_styles'], $this->enqueue_styles);
    }
    if(isset($objects['nav_menus']))
    {
      $this->nav_menus = array_merge($objects['nav_menus'], $this->nav_menus);
    }
    if(isset($objects['image_sizes']))
    {
      $this->image_sizes = array_merge($objects['image_sizes'], $this->image_sizes);
    }

  }


  public function addScriptsToWordpress()
  {
      $currentEnvironment = BebelUtils::getEnvironment();
      $defaultOptions = array(
          'environment' => $this->defaultEnvironment,
          'footer' => true,
          'version' => false,
          'dependency' => array(),
          'path' => false,
          'when' => '__return_true'
      );

      foreach($this->enqueue_scripts as $script => $source)
      {
          if (is_int($script)){ //imagine array('script1', 'script2' => array('path'=>'some/path')). 'script1' should be they key too, right?
              $script = $source;
              $source = array();
          }
          $options = array_merge($defaultOptions, $source); //we don't need to set 'frontend' everytime

          if($options['environment'] == $currentEnvironment && $options['when']())
          {
              wp_enqueue_script(
                  $script,
                  BebelUtils::replaceSettingTokens($options['path']),
                  $options['dependency'],
                  $options['version'],
                  $options['footer']
              );
          }


      }# end foreach

  }


  public function addStylesToWordpress()
  {
      $currentEnvironment = BebelUtils::getEnvironment();
      $defaultOptions = array(
          'environment' => $this->defaultEnvironment,
          'path' => false,
          'when' => '__return_true'
      );

      foreach($this->enqueue_styles as $style => $source)
      {
          if (is_int($style)){ //imagine array('style1', 'style2' => array('path'=>'some/path')). 'style1' should be they key too, right?
              $style = $source;
              $source = array();
          }
          $options = array_merge($defaultOptions, $source); //we don't need to set 'frontend' everytime

          if($options['environment'] == $currentEnvironment && $options['when']())
          {
              wp_enqueue_style(
                  $style,
                  BebelUtils::replaceSettingTokens($options['path'])
              );
          }


      }# end foreach
  }

  /**
   * Runs all wordpress thingies
   */
  public function run()
  {

    if(!empty($this->actions)) {
      foreach($this->actions as $action => $value)
      {
        add_action($action, $value);
      }
    }

    if(!empty($this->filters)) {
      foreach($this->filters as $filter => $content)
      {
        add_filter($filter, $content);
      }
    }

    if(!empty($this->theme_support))
    {
      foreach($this->theme_support as $support => $options)
      {
          if (is_int($support)){
              add_theme_support($options);
          }
          add_theme_support($support, $options);
      }
    }

    if(!empty($this->nav_menus))
    {

      register_nav_menus($this->nav_menus);
    }

    if(!empty($this->image_sizes))
    {
      foreach($this->image_sizes as $name => $size)
      {
        add_image_size($name, $size[0], $size[1], $size[2]);
      }
    }

    if(!empty($this->enqueue_scripts))
    {
        add_action('wp_enqueue_scripts', array($this, 'addScriptsToWordpress'));
    }

    if(!empty($this->enqueue_styles))
    {
        add_action('wp_enqueue_scripts', array($this, 'addStylesToWordpress'));
    }
  }


  public function initAdmin()
  {

  }


}