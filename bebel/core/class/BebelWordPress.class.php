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
    $utils;


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
      $environment = BebelUtils::getEnvironment();
      
      foreach($this->enqueue_scripts as $script => $source)
      {
         /**
         * deregister script for frontend. we need our version.
         */
        if($script == 'jquery' && $environment == 'frontend')
        {
          wp_deregister_script('jquery');
        }
          
        if($source)
        {

          if($source['environment'] == $environment)
          {
            if(!isset($source['path']) && (!isset($source['dependency']) || $source['dependency'] == null))
            {
              wp_enqueue_script($script);
            }else {
              if(isset($source['dependency']) && $source['dependency'] != null) {
                wp_enqueue_script($script, BebelUtils::replaceSettingTokens($source['path']), array($source['dependency']));
              }else {
                wp_enqueue_script($script, BebelUtils::replaceSettingTokens($source['path']));
              }
            }
          }
        }else {
          wp_enqueue_script($script);
        }

          
    }# end foreach

  }
  
  
  public function addStylesToWordpress()
  {
      $environment = BebelUtils::getEnvironment();
      foreach($this->enqueue_styles as $style => $source)
        {
          if($source)
          {
            if($source['environment'] == $environment)
            {
              // skip nocache file if prod mode is on
              
              
              if(isset($source['dependency']) && $source['dependency'] != null) {
                wp_enqueue_style($style, BebelUtils::replaceToken($source['path'], 'BCP_BUNDLE_PATH'), array($source['dependency']));
              }else {
                wp_enqueue_style($style, BebelUtils::replaceToken($source['path'], 'BCP_BUNDLE_PATH'));
              }


            }
          }else {
            wp_enqueue_style($style);
          }

        }
  }

  /**
   * Runs all wordpress thingies
   */
  public function run()
  {
    // get environment and production mode
    $environment = BebelUtils::getEnvironment();
    $production_mode = BebelUtils::getProductionMode();

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
      foreach($this->theme_support as $support)
      {
        add_theme_support($support);
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