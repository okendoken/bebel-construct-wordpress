<?php


class BebelAdmin
{
    protected
        $settings,
        $bundle,
        $admin_classes,
        $admin_panel,
        $added_pages = array('bebelAdminTop');

    public function  __construct(BebelSettings $settings, BebelBundle $bundle)
    {
        $this->settings = $settings;
        $this->bundle = $bundle;

    }

    public function initAdmin()
    {
        $pref_icon = get_template_directory().'/images/core/admin-nav-icon.png';
        $pref_icon_uri = get_stylesheet_directory_uri().'/images/core/admin-nav-icon.png';

        if(file_exists($pref_icon)) {
            $icon = $pref_icon_uri;
        }else {
            $icon = get_stylesheet_directory_uri().'/bebel/core/assets/images/icons/admin-nav-icon.png';
        }



        add_menu_page("Theme Options", $this->settings->getThemename(), 'edit_theme_options', 'bebelAdminTop', '', $icon, 61);
        add_submenu_page('bebelAdminTop', _x("Configure your theme", $this->settings->getPrefix()), _x("Theme Configuration", $this->settings->getPrefix()), 'edit_theme_options', 'bebelAdminTop', array($this,'getBebelAdminTop'));

        $bundles = $this->bundle->loadAdmin();
        $pages = $bundles['pages'];

        foreach($pages as $key => $page)
        {
            $this->addSubPage($key, $page);
        }

        if(isset($_GET['page']) && $_GET['page'] == "bebelAdminTop") //in_array($_GET['page'], $this->added_pages))
        {
            $this->admin_panel = new BebelAdminPanel($this->settings, $this->bundle);

            add_action('admin_enqueue_scripts', array('BebelUtils', 'getAdminCssAndJs'));
            if(isset($_GET['save']) && $_GET['save'] == 'true') {
                $this->admin_panel->save($_POST);
                header('location: admin.php?page=bebelAdminTop');
            }
        }
    }

    public function addSubPage($key, $page)
    {

        // required stuff
        $required = array('parent', 'title', 'permission', 'class');
        foreach($required as $req)
        {
            if(!isset($page[$req]))
            {
                throw new BebelException(sprintf('Seems you missed to add some necessary keys to the pages array. %s is missing.', $req));
            }
        }
        $page_title = !isset($page['page_title']) ? $page['title'] : $page['page_title'];

        $class = $page['class'].'AdminConfig';
        $this->admin_class[$key] = new $class();
        $method_name = 'get'.ucfirst($key);

        add_submenu_page($page['parent'], $page_title, $page['title'], $page['permission'], $key, array($this->admin_class[$key],$method_name));

        $this->added_pages[] = $key;

        if(isset($_GET['page']) && $_GET['page'] == $key) //in_array($_GET['page'], $this->added_pages))
        {

            add_action('admin_enqueue_scripts', array('BebelUtils', 'getAdminCssAndJs'));
        }
    }


    public function getBebelAdminTop()
    {
        include_once get_template_directory().BebelUtils::getAdminPath().'/index.php';
    }


}
