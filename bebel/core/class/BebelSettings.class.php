<?php
/**
 * Wordpress unfortunately doesn't use much classes, so we cannot use
 * our autoloader to load this file. Thus done manually.
 */
include_once(get_template_directory().'/../../../wp-admin/includes/plugin.php');


/**
 * This class contains and manages all the settings we collect from
 * all bundles. Once registered, the settings will be stored in one
 * serialized array in the database.
 *
 * The array will be stored and cached within this class, so we don't
 * use tons of queries for feting our settings. Speeds up things quite
 * a bit.
 *
 * @author Bebel <bebel_flashden@yahoo.de>
 *
 */
class BebelSettings
{

  protected
    $theme_name,
    $theme_version,
    $theme_prefix;

  protected
    $settings = array(),
    $settings_from_database = array();

  protected
    $updated = false;

  public function setBaseInfo(array $settings)
  {
    $this->theme_name = $settings['theme_name'];
    $this->theme_version = $settings['theme_version'];
    $this->theme_prefix = $settings['theme_prefix'];
  }

  public function getPrefix()
  {
    return $this->theme_prefix;
  }

  public function getThemeName()
  {
    return $this->theme_name;
  }

  public function getVersion()
  {
    return $this->theme_version;
  }

  public function register(array $settings)
  {
    $this->settings = array_merge_recursive($this->settings, $settings);
  }

  /**
   * returns an array with all settings and values
   *
   * @return array
   */
  public function getAllRegistered()
  {
    $aReturn = array();

    foreach($this->settings as $setting => $value)
    {
      $aReturn[$setting] = $this->get($setting);
    }
    return $aReturn;
  }

  /**
   * Returns all in the database stored objects.
   * It can be that this array is bigger than the actual value in the
   * database. Pay attention to have saved it!
   *
   * @return array
   */
  public function getAll()
  {
    return $this->settings_from_database;
  }

  /**
   * Returns the value of a given setting.
   * automatically adds our current theme's prefix.
   *
   * @param String $setting
   * @param Boolean $is_theme_setting
   * @return Value of Option
   */
  public function get($setting, $is_theme_setting = true, $return_empty = false)
  {
    if($is_theme_setting)
    {
      if(isset($this->settings_from_database[$setting]))
      {
        if(is_array($this->settings_from_database[$setting]))
        {
          return $this->settings_from_database[$setting];
        }
        return stripslashes($this->settings_from_database[$setting]);
      }
      // search in database
      if($result = esc_attr(get_option($this->theme_prefix.'-'.$setting)))
      {
        return $result;
      }
      if($return_empty)
      {
        return false;
      }
      throw new BebelException(sprintf('Setting %s does not exist.', $setting));
    }
    return stripslashes(get_option($setting));
  }

  /**
   * Updates a setting, does NOT save it in the database.
   * Run $this->save() to actually save it!
   * Also replaces given token patterns, such as image path, css path, ...
   *
   * @param String $setting
   * @param $value
   */
  public function update($setting, $value)
  {
    $this->updated = true;
    if(is_array($value))
    {
      $value = array_map(array('BebelUtils','replaceSettingTokens'), $value);
    }else {
      $value = esc_attr(BebelUtils::replaceSettingTokens($value));
    }
    $this->settings_from_database[$setting] = $value;
    //
  }

  /**
   * Saves the settings array.
   *
   * @return BebelSettings
   */
  public function save()
  {
    // update time of update
    $now = gmdate('D, d M Y H:i:s', time());
    $this->update('bebel_settings_last_update', $now);
    update_option($this->theme_prefix.'-settings', $this->settings_from_database);
    return $this;
  }

  /**
   * Loads all the settings
   */
  public function loadAll()
  {
    $this->settings_from_database = get_option($this->theme_prefix.'-settings');
    return $this;
  }


  /**
   * Initializes all the settings we first registered
   *
   * 1. Registers our settings array to the WordPress
   * 2. Checks all registered settings settings for new and unknown ones
   * 2.1 Adds them and sets a flag, so we know we have to save again
   * 3. If flag is set, save settings
   *
   * @return BebelSettings
   */
  public function init()
  {
    #$this->update('sidebar_holder',array()); // uncomment, if you want to reset the sidebars (or add a new one)
    #$this->save()
    register_setting($this->theme_prefix.'-settings', $this->theme_prefix.'-settings');

    foreach($this->settings as $setting => $value)
    {
      if(is_array($value) && isset($this->settings_from_database[$setting])) {
        //$difference = array_map()
        // fuck it
        $difference = BebelUtils::arrayDiffKeyRecursive($value, $this->settings_from_database[$setting]);
        if(!empty($difference))
        {
          $this->update($setting, array_replace_recursive($difference, $this->settings_from_database[$setting])); 
        }
      }
      if(!isset($this->settings_from_database[$setting]))
      {
        $this->update($setting, $value);
      }
    }

    // if an option was updated, save it. We don't neet to return the newly
    // saved array, as we already cached it locally.
    if($this->updated) {
      $this->save();
    }

    return $this;
  }

  /**
   * for all those who want to export their settings in case of
   * migration.
   *
   * @return serialized array
   */
  public function exportSettings()
  {
    return maybe_serialize($this->settings);
  }

  /**
   * import the settings
   *
   * @param array $settings
   */
  public function importSettings($settings)
  {
    $this->settings = maybe_unserialize($settings);
    $this->save();
  }

  

}