<?php


class BebelSingleton
{

  protected static $classes;

  public static function addClass($name, $class)
  {
    self::$classes[$name] = $class;

  }

  public static function addClasses(array $classes)
  {
    foreach($classes as $name => $class)
    {
      self::addClass($name, $class);
    }
  }


  public static function getInstance($name)
  {
    if(isset(self::$classes[$name])) {
      return self::$classes[$name];
    }else {
      throw new BebelException(sprintf('no instance of "%s" created', $name));
    }
    
  }
  
  public static function hasInstance($name)
  {
      return isset(self::$classes[$name]);
  }

  public static function get() {
    print_r(self::$classes);
  }


}