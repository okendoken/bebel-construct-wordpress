<?php


abstract class BebelAdminConfig {
  protected
    $settings;
  
  public function __construct()
  {
      $this->settings = BebelSingleton::getInstance('BebelSettings');
  }


}