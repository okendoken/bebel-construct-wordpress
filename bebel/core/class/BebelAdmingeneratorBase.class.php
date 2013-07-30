<?php


abstract class BebelAdminGeneratorBase
{

  protected
    $settings,
    $utils,
    $bundles,
    /**
     * modules are subtypes defined in the bundles.
     * @var modules
     */
    $modules = array();

  public function __construct(BebelSettings $settings, BebelBundle $bundles)
  {
    $this->settings = $settings;
    $this->bundles = $bundles;

  }

  public function loadModules()
  {
    $modules = $this->bundles->loadAdmin();
    $this->modules = $modules['modules'];
    return $this;
  }

  public function addModule($name, $module)
  {
    $this->module[$name] = $module;
    return $this;
  }

  abstract public function createMenu();
  abstract public function createBody();


}