<?php
/**
 * compared to the other meta panels, this one has a slightly different approach
 * it is loaded via action hook, and thus has an additional init method.
 */

class BebelAdminPostMetaPanel extends BebelAdminMetaPanel
{

  protected
    $post_type_raw,
    $post,
    $menu_items_count;

  public function __construct(BebelSettings $settings, BebelBundle $bundles)
  {
    add_action('load-post.php', array(&$this, 'init'));
    add_action('load-post-new.php', array(&$this, 'init'));
    add_action('save_post', array(&$this, 'saveCustomPostValue'), 1, 2);
    parent::__construct($settings, $bundles);
  }

  public function init()
  {
    BebelUtils::getAdminCssAndJs();
    // step zero: load modules.
    $this->loadModules();
    foreach($this->modules['add_scope'] as $scope)
    {
      $scope = ($scope != 'post' && $scope != 'page' && $scope != 'global') ? $this->settings->getPrefix().'_'.$scope : $scope;
      add_meta_box('bebel-custom-fields', $this->settings->getThemename().' Options', array($this, 'createBody'), $scope, 'normal', 'high');
      remove_meta_box('postcustom', $scope, 'normal');
    }
    
    // first step: check post type and gather informations about it from
    // the configuration
  }

  public function createBody()
  {
    global $post;
    $this->post = $post;
    $this->post_type_raw = BebelUtils::stripPrefix($this->settings->getPrefix(), $post->post_type);

    parent::createBody();
  }

  public function createMenu()
  {
    $tabs = '';
    $i = 0;
    foreach($this->modules['menu_items'] as $module => $item)
    {
      if(in_array($this->post_type_raw, $item['scope']) || in_array('global', $item['scope']))
      {
        $i++;
        $tabs .= '<li><a class="" href="#bebel_admin_meta_panel_tabs-'.$i.'">'.$item['title'].'</a></li>';
      }
    }
    
    $this->menu_items_count = $i;

    // menu is always set up in core
    include_once(get_template_directory().BebelUtils::getAdminpath().'/meta_panel/templates/menu.php');

    return $this; // keep it fluid
  }

  public function getMenuCount()
  {
    return $this->menu_items_count;
  }

  public function loadModules()
  {
    $modules = $this->bundles->loadAdmin();
    $this->modules = $modules['post_modules'];
    return $this;
  }


  public function getOption($key)
  {
    global $post;
    $value = get_post_meta($post->ID, $this->settings->getPrefix().'_'.$key, true);
    if(!$value)
    {
      switch($this->modules['widgets'][$key]['template'])
      {
        case 'select_sidebar':
          // check if a new default value has been set
          $default = $this->settings->get('sidebar_holder');
          $default = $default['defaults'];

          $value = $default[$this->post_type_raw];
          break;
      }

      // still nothing.
      if(!$value)
      {
        // get default value
        if(isset($this->modules['widgets'][$key]['options']['default']))
        {
          $value = $this->modules['widgets'][$key]['options']['default'];
        }else {
          $value = '';
        }
      }
    }
    return $value;
  }

  public function isValid($widget)
  {
    if(isset($this->modules['widgets'][$widget]))
    {
      #if($this->modules['widgets'][$widget]['scope'] == $post->post_type)
      #{
        return true;
      #}
      return false;
    }
    return false;
  }


  public function saveCustomPostValue($post_id, $post){
    
    if(isset($_POST['bebel-custom-fields_wpnonce'])&& !wp_verify_nonce($_POST['bebel-custom-fields_wpnonce'], 'bebel-custom-fields' ))
    {
      return;
    }

    if (!current_user_can('edit_post', $post_id))
    {
      return;
    }
    
    foreach($_POST as $key => $value)
    {
      if(preg_match('/'.$this->settings->getPrefix().'_/', $key)) {
        $widget = BebelUtils::stripPrefix($this->settings->getPrefix(), $key);
        if($this->isValid($widget)) {
          update_post_meta($post_id, $key, $_POST[$key]);
        }
      }
    }
    // FIND OUT WHY THIS WON'T WORK ANYMORE
    /*if (!in_array($post->post_type, $this->modules['add_scope']))
    {
      return;
    }*/
    
  }

}