<?php


abstract class BebelBundleConfig implements BebelBundleConfigInterface
{
  protected
    $bundleDir;


  public function getSettings() { return array(); }
  public function getWordpress() { return array(); }
  public function getAdmin() { return array('modules' => array(), 'pages' => array()); }
  public function getTemplates() { return array(); }
  public function getPostTypes() { return array(); }
  public function getTableInstallData() { return array(); }
  public function getBundleSettings() { return array(); }
  public function getWidgets() { return array(); }
  public function runHook() {}

  public function getBundleDir()
  {
    return $this->bundleDir;
  }

}