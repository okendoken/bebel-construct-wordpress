<?php

/**
 * A bundle can be everything and anything. It can just be a bunch of
 * shortcodes, a new post type including templates and custom functions / classes
 * or a set or single widget.
 * the important thing is to correctly set up the configuration class of the bundle
 *
 * create a new bundleName/config/bundleNameConfig.class.php file and set up all
 * you need in this file.
 *
 * The BebelBundle will do all the heavy work, as autoloading etc.
 *
 */
class BebelBundle
{


    protected
        $bundles = array(),
        $settings,
        $wordpress,
        $postTypes;


    public function __construct(BebelSettings $settings, BebelWordPress $wordpress, BebelPostTypeGenerator $post_types)
    {
        $this->settings = $settings;
        $this->wordpress = $wordpress;
        $this->postTypes = $post_types;
    }

    public function registerMultiple(array $bundles)
    {
        foreach($bundles as $bundle)
        {
            $this->register($bundle);
        }
        return $this;
    }

    public function register($bundle)
    {
        // check for bundle
        if(!$this->bundleExists($bundle))
        {
            throw new BebelException('Bundle does not exist');
        }
        $className = $bundle.'Config';
        $this->bundles[$bundle] = new $className();

        $bundle = $this->bundles[$bundle];

        return $this;
    }


    public function bundleExists($bundle)
    {
        $auto_loader = BebelAutoloader::getInstance();
        $file = $auto_loader->getBaseDir().'/bundles/'.$bundle.'/config/'.$bundle.'Config.class.php';

        if(file_exists($file))
        {
            include_once $file;
            return true;
        }
        return false;
    }


    public function loadSettings()
    {
        foreach($this->bundles as $bundle)
        {
            $this->settings->register($bundle->getSettings());
        }
        return $this;
    }

    public function loadWordpress()
    {
        foreach($this->bundles as $bundle)
        {
            $this->wordpress->add($bundle->getWordpress());
        }
        return $this;
    }

    public function loadAdmin()
    {
        $admin = array();
        foreach($this->bundles as $bundle)
        {
            $admin = array_merge_recursive($admin, $bundle->getAdmin());
        }
        return $admin;
    }

    /** to fix !*/
    public function loadAutoload()
    {
        $autoLoad = array();
        foreach($this->bundles as $bundle)
        {
            $autoLoad = array_merge_recursive($autoLoad, array_map(array('BebelUtils', 'replaceToken'),$bundle->getAutoload()));
        }

        return $autoLoad;
    }

    public function loadTemplates()
    {
        $templates = array();
        foreach($this->bundles as $bundle)
        {
            $templates = array_merge_recursive($templates, $bundle->getTemplates());
        }
        return $templates;
    }

    public function loadPostTypes()
    {

        foreach($this->bundles as $bundle)
        {
            $post_types = $bundle->getPostTypes();
            if(!empty($post_types))
            {
                foreach($post_types as $post_type => $options)
                {
                    $this->postTypes->setOptions($options)->registerPostType()->registerTaxonomy();
                }
                $this->postTypes->flush(); //only flush toilet once after count($post_types) people placed their load :)
            }
        }
        return $this;
    }

    public function loadTableInstallData()
    {
        $data = array();
        foreach($this->bundles as $bundle)
        {
            $data = array_merge_recursive($data, $bundle->getTableInstallData());
        }
        return $data;
    }

    public function loadBundleSettings()
    {
        $data = array();
        foreach($this->bundles as $bundle)
        {
            $data = array_merge_recursive($data, $bundle->getBundleSettings());
        }
        return $data;
    }

    public function loadWidgets()
    {
        $widgets = array();
        foreach($this->bundles as $bundle)
        {
            $widgets = array_merge_recursive($widgets, $bundle->getWidgets());
        }

        $autoInstallWidgets = array();
        foreach($widgets as $widget )
        {
            register_widget($widget['widget-class']);
            if (isset($widget['autoload']) && $widget['autoload']){
                $autoInstallWidgets[] = $widget;
            }
        }
        $bebelWidgetAutoInstaller = new BebelWidgetAutoInstaller('sidebar-1', $autoInstallWidgets);
        $bebelWidgetAutoInstaller->installWidgets();
        return $this;
    }


    protected function registerAutoloadWidgets(){

    }


    public function runHooks()
    {
        foreach($this->bundles as $bundle)
        {
            $bundle->runHook();
        }
    }

    public function loadSidebars()
    {
        $sidebars = array();
        foreach($this->bundles as $bundle)
        {
            $sidebars = array_merge_recursive($sidebars, $bundle->getSidebars());
        }
        foreach($sidebars as $sidebar )
        {
            register_sidebar($sidebar);
        }
        return $this;
    }

}