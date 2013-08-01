<?php


abstract class BebelAdminConfig {
  protected
    $settings,
    $bundleDir;

  public function __construct($bundleDir)
  {
      $this->settings = BebelSingleton::getInstance('BebelSettings');
      $this->bundleDir = $bundleDir;
  }


}