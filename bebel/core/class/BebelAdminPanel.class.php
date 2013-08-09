<?php

/**
 * structure of a module for the admin panel
 * for an overview of all permissions: http://codex.wordpress.org/Roles_and_Capabilities
 * array(
     'tabname' => 'Main Configuration',
     'elements' => array(
         array(
             'title' => 'Page Title',
             'description' => 'foobar',
             'help' => 'barfoo',
             'template' => 'input',
             'permission' => 'edit_theme_options'
         ),
     ),
     'bundle' => 'core', // bundle name, "core" for core.
 *
 * );
 *
 */



class BebelAdminPanel extends BebelAdminGeneratorBase {

  protected $submenu = array();


  public function createMenu()
  {
    $tabs = '';
    $i = 0;
    foreach($this->modules as $base => $details)
    {
      $i++;
      $tabs .= '<li><a class="nav-tab" href="#bebel_admin_panel_tabs-'.$i.'">'.$details['title'].'</a></li>';
    }
    // menu is always set up in core
    include_once(get_template_directory().BebelUtils::getAdminpath().'/panel/templates/menu.php');

    return $this;
  }

  public function getMenuCount()
  {
    return count($this->modules);
  }
  
  public function hasSubmenu($tab)
  {
    return isset($this->modules[$tab]['submenu']);
  }

  public function getSubmenuCount($tab)
  {
    return count($this->modules[$tab]['submenu']);
  }

  public function getSubmenu($tab, $unique_id)
  {
    if($this->hasSubmenu($tab))
    {
      $sub = '';
      $i = 0;
      $this->submenu = array(); // reset
      foreach($this->modules[$tab]['submenu'] as $key => $menu)
      {
        
        $this->submenu[] = $key;
        $i++;
        $sub .= '<li>';
        $sub .=   '<a href="#bebel_admin_panel_submenu_tabs'.$unique_id.'-'.$i.'">'.$menu['title'].'<br />';
        $sub .=   '<span class="description">'.$menu['description'].'</span></a>';
        $sub .= '</li>';
      }

      return $sub;
    }
  }

  public function createBody()
  {
    include_once(get_template_directory().BebelUtils::getAdminpath().'/panel/templates/body.php');
    return $this;
  }

  public function getSubmenuEntries()
  {
    return $this->submenu;
  }


  public function save($post)
  {
    if(!isset($post[$this->settings->getPrefix().'-settings'])) {
      throw new BebelException(sprintf('You tried to save something but gave me no array to save! Default is %s', $this->settings->getPrefix().'-settings'));
    }
    foreach($post[$this->settings->getPrefix().'-settings'] as $key => $value) {
      $settings_whitelist = $this->settings->getAllRegistered(); 
      if(isset($settings_whitelist[$key])) {
        $this->settings->update($key, $value);
      }
      $this->settings->save();
    }
  }


}