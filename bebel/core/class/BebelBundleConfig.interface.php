<?php


interface BebelBundleConfigInterface
{
  public function __construct();
  public function getAutoload();
  public function getSettings();
  public function getWordpress();
  public function getAdmin();
  public function getTemplates();
  public function getPostTypes();
  public function getTableInstallData();
  public function getBundleSettings();
  public function getWidgets();
  public function runHook();
}