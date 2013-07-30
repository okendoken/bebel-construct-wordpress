<?php

/*
 * This is the autoloader class that takes care of anything in our custom backend.
 * Requires at least php 5.1.2!
 * @author Bebel <bebel_flashden@yahoo.de>
 */


class BebelAutoloader
{

  static protected
    $registered = false,
    $instance = null;

  protected
    $baseDir = null;

  public function __construct() {
    $this->baseDir = realpath(dirname(__FILE__).'/../..');
  }


  public static function getInstance() {
    if(!isset(self::$instance)) {
      self::$instance = new BebelAutoloader();
    }
    return self::$instance;
  }

  public static function register() {
    
    if (self::$registered) {
      return;
    }

    ini_set('unserialize_callback_func', 'spl_autoload_call');
    if (false === spl_autoload_register(array(self::getInstance(), 'autoload'))) {
      throw new BebelException(sprintf('Unable to register %s::autoload as an autoloading method.', get_class(self::getInstance())));
    }

    self::$registered = true;

  }

  public function unregister() {
    spl_autoload_unregister(array(self::getInstance(), 'autoload'));
    self::$registered = false;
  }

  public function extend($classes) {
    self::$classes = array_merge(self::$classes, $classes);
  }

  public function getClasses()
  {
    return self::$classes;
  }

  public function getBaseDir() {
    return $this->baseDir;
  }

  protected function autoload($class) {
    
    if ($path = $this->getClassPath($class)) {
      require $path;
      return true;
    }
    return false;
  }

  protected function getClassPath($class) {
    
    $class = strtolower($class);
    
    if (!isset(self::$classes[$class])) {
      return null;
    }
    
    return $this->baseDir.'/'.self::$classes[$class];
  }

  static protected
    $classes = array(
        // base
        'bebelbundle'    => 'core/class/BebelBundle.class.php',
        'bebelbundleconfiginterface' => 'core/class/BebelBundleConfig.interface.php',
        'bebelbundleconfig' => 'core/class/BebelBundleConfig.class.php',
        'bebelexception' => 'core/class/BebelException.class.php',
        'bebelsettings'  => 'core/class/BebelSettings.class.php',
        'bebelwordpress'  => 'core/class/BebelWordPress.class.php',
        'bebelutils'  => 'core/class/BebelUtils.class.php',
        'bebelsingleton' => 'core/class/BebelSingleton.class.php',
        'bebelqueryholder' => 'core/class/BebelQueryHolder.class.php',
        'bebeltemplateloader' => 'core/class/BebelTemplateloader.class.php',
        'bebelposttypegenerator' => 'core/class/BebelPostTypeGenerator.class.php',
        'bebeltablesinstall' => 'core/class/BebelTablesInstall.class.php',
        'bebelwidgetbase' => 'core/class/BebelWidgetBase.class.php',

        // admin
        'bebeladmin' => 'core/class/BebelAdmin.class.php',
        'bebeladmingeneratorbase' => 'core/class/BebelAdminGeneratorBase.class.php',
        'bebeladminpanel' => 'core/class/BebelAdminPanel.class.php',
        'bebeladminconfig' => 'core/class/BebelAdminConfig.class.php',
        'bebeladminmetapanel' => 'core/class/BebelAdminMetaPanel.class.php',
        'bebeladminpostmetapanel' => 'core/class/BebelAdminPostMetaPanel.class.php',
        'bebelsidebargeneratorbase' => 'core/class/BebelSidebarGeneratorBase.class.php',
        'bebelsidebargeneratoradmin' => 'core/class/BebelSidebarGeneratorAdmin.class.php',
        'bebelsidebargeneratorfrontend' => 'core/class/BebelSidebarGeneratorFrontend.class.php',
        'bebelthemeupdate'   => 'core/class/BebelThemeupdate.class.php',

        // basic widgets
        'bebelwidgetblog' => 'core/widgets/class/BebelWidgetBlog.class.php',
        
        // mail
        'bebelmailer' => 'core/class/BebelMailer.class.php',
        'bebelmailsenderbase' => 'core/class/BebelMailSenderBase.class.php',


        // third party libraries
        'javascriptpacker' => 'core/vendor/JavaScriptPacker/class/JavaScriptPacker.class.php',
        'barcodeqr' => 'core/vendor/qrcode/BarcodeQR.php',

    );

  

}