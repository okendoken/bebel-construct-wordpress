<?php


class BebelUtils
{
    static protected
        $bcp_path = '/bebel',
        $bcp_bundle_path = '/bundles',
        $bcp_core_path   = '/core',
        $bcp_admin_path  = '/admin',
        $images_path = '/images',
        $environment,
        $production_mode,
        $tokens = array(
        'BCP_BUNDLE_PATH',
        'BCP_BUNDLE_PATH_URI',
        'BCP_PATH',
        'BCP_CORE_PATH',
        'IMAGES_PATH'
    );



    public static function replaceToken($string, $token = 'BCP_BUNDLE_PATH_URI')
    {
        switch($token)
        {
            case 'BCP_BUNDLE_PATH_URI':
                $string = str_replace('%BCP_BUNDLE_PATH%', self::$bcp_bundle_path, $string);
                break;
            case 'BCP_BUNDLE_PATH':
                $string = str_replace('%BCP_BUNDLE_PATH%', get_stylesheet_directory_uri().self::$bcp_path.self::$bcp_bundle_path, $string);
                break;
            case 'BCP_PATH':
                $string = str_replace('%BCP_PATH%', get_stylesheet_directory_uri().self::$bcp_path, $string);
                break;
            case 'BCP_CORE_PATH':
                $string = str_replace('%BCP_CORE_PATH%', get_stylesheet_directory_uri().self::$bcp_path.self::$bcp_core_path, $string);
                break;
            case 'IMAGES_PATH':
                $string = str_replace('%IMAGES_PATH%', get_stylesheet_directory_uri().self::$images_path, $string);
                break;

            default:
                throw new BebelException(sprintf('Replacetoken %s does not exist', $token));
        }

        return $string;

    }

    public static function setEnvironment($env)
    {
        self::$environment = $env;
    }

    public static function getEnvironment()
    {
        return self::$environment;
    }

    public static function setProductionMode($env)
    {
        self::$production_mode = $env;
    }

    public static function getProductionMode()
    {
        return self::$production_mode;
    }

    public static function getAdminPath()
    {
        return self::$bcp_path.self::$bcp_core_path.self::$bcp_admin_path;
    }

    public static function getBundlePath()
    {
        return self::$bcp_path.self::$bcp_bundle_path;
    }

    public static function getCorePath()
    {
        return self::$bcp_path.self::$bcp_core_path;
    }

    public static function stripPrefix($prefix, $string)
    {
        return str_replace($prefix.'_', '', $string);
    }

    public static function stripTaxonomySuffix($string)
    {
        return str_replace('-category', '', $string);
    }

    public static function replaceSettingTokens($string)
    {
        foreach(self::$tokens as $token)
        {
            $string = self::replaceToken($string, $token);
        }

        return $string;
    }

    /**
     * returns a list of templates
     *
     * @param string $preselected
     * @return string
     */
    public static function createListByOptions($preselected, $options, $title = false)
    {
        $return = '';
        if($preselected == '' && $title)
        {
            $return .= '<option value="" selected="selected">--Select '.$title.'--</option>';
        }elseif($preselected != '' && $title) {
            $return .= '<option value="">--Select '.$title.'--</option>';
        }
        foreach($options as $key => $name)
        {
            if($preselected != '' && $preselected == $key)
            {
                $return .= '<option value="'.$key.'" selected="selected">'.$name.'</option>';
            }else {
                $return .= '<option value="'.$key.'">'.$name.'</option>';
            }
        }

        return $return;

    }

    /**
     * Gets the difference (keys) between two arrays the recursive way.
     *
     * @see http://www.php.net/manual/en/function.array-diff-key.php#79483
     * @param array $aArray1
     * @param array $aArray2
     * @return array
     */
    public static function arrayDiffKeyRecursive ($arrayOriginal, $arrayCompare)
    {

        foreach($arrayOriginal as $key => $value)
        {
            //$return[$key] = is_array($value) ? self::arrayDiffKeyRecursive($arrayOriginal[$key], $arrayCompare[$key]) : array_diff_key($arrayOriginal, $arrayCompare);
            if(is_array($value))
            {
                $return[$key] = self::arrayDiffKeyRecursive($arrayOriginal[$key], $arrayCompare[$key]);
            }else {
                if(is_array($arrayCompare))
                    $return = array_diff_key($arrayOriginal, $arrayCompare);
                else{
                    $return = $arrayOriginal;
                }
            }

            if(isset($return[$key]) && is_array($return[$key]) && count($return[$key]) == 0)
            {
                unset($return[$key]);
            }
        }
        return $return;
    }

    /**
     * Returns a relative time string
     *
     * @param timestamp / string $time
     * @return string
     */
    public static function getRelativeTime($time, $themename) {

        $delta = time() - strtotime($time);
        if ($delta < 2 * 60) {
            return "1 "._x('second ago', $themename);
        }
        if ($delta < 45 * 60) {
            return floor($delta / 60) . " min ago"._x('hour ago', $themename);
        }
        if ($delta < 90 * 60) {
            return "1 "._x('hour ago', $themename);
        }
        if ($delta < 24 * 3600) {
            return floor($delta / 3600) . " "._x('hours ago', $themename);
        }
        if ($delta < 48 * 3600) {
            return _x('yesterday', $themename);
        }
        if ($delta < 30 * 86400) {
            return floor($delta / 86400) . " "._x('days ago', $themename);
        }
        if ($delta < 12 * 2592000) {
            $months = floor($delta / 86400 / 30);
            return $months <= 1 ? "1 "._x('month ago', $themename) : $months . " "._x('months ago', $themename);
        } else {
            $years = floor($delta / 86400 / 365);
            return $years <= 1 ? "1 "._x('year ago', $themename) : $years . " "._x('years ago', $themename);
        }
    }

    /**
     * Load all js and css stuff for the backend
     */
    public static function getAdminCssAndJs()
    {
        // load javascript (jquery ui)
        wp_enqueue_script('jquery-cookie', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/js/jquery.cookie.js', array('jquery'));
        wp_enqueue_script('bebel-tabs', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/js/bebel_tabs.js', array('jquery'));

        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        //wp_deregister_script('jquery-ui-core');
        //wp_enqueue_script('jquery-ui-core', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/js/jquery-ui/jquery.ui.core.min.js', array('jquery'));
        wp_enqueue_script('jquery-ui-widget', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/js/jquery-ui/jquery.ui.widget.min.js', array('jquery', 'jquery-ui-core'));
        wp_enqueue_script('jquery-ui-mouse', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/js/jquery-ui/jquery.ui.mouse.min.js', array('jquery', 'jquery-ui-core'));
        wp_enqueue_script('jquery-ui-slider', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/js/jquery-ui/jquery.ui.slider.min.js', array('jquery', 'jquery-ui-mouse'));
        //wp_deregister_script('jquery-ui-draggable');
        //wp_deregister_script('jquery-ui-resizable');
        //wp_deregister_script('jquery-ui-dialog');
        //wp_enqueue_script('jquery-ui-draggable', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/js/jquery-ui/jquery.ui.draggable.min.js', array('jquery', 'jquery-ui-mouse'));
        //wp_enqueue_script('jquery-ui-resizable', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/js/jquery-ui/jquery.ui.resizable.min.js', array('jquery', 'jquery-ui-draggable'));
        wp_enqueue_script('jquery-ui-dialog', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/js/jquery-ui/jquery.ui.dialog.min.js', array('jquery', 'jquery-ui-draggable'));

        // color picker
        wp_enqueue_script('js-colorpicker', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/js/colorpicker.js', array('jquery'));

        // load css
        wp_enqueue_style('thickbox');
        wp_enqueue_style('jquery-ui', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/css/jquery-ui.css', array());
        wp_enqueue_style('960', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/css/960_24_col.css', array());
        wp_enqueue_style('bebel-admin', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/css/admin.css', array('960'));
        wp_enqueue_style('colorpicker', BebelUtils::replaceToken('%BCP_CORE_PATH%', 'BCP_CORE_PATH').'/assets/css/colorpicker.css', array());

    }

    public static function getPostPageSelect($type)
    {
        switch($type)
        {
            case 'page':
                $data = get_pages('orderby=name');
                break;
            case 'post':
                $data = get_posts('orderby=name&numberposts=200');
                break;
            case 'gallery':
                $settings = BebelSingleton::getInstance('BebelSettings');
                $q = array(
                    'post_type' => $settings->getPrefix().'_gallery',
                    'posts_per_page' => 0
                );
                $data = get_posts($q);
                break;
        }
        $options = array();
        foreach($data as $entry)
        {
            $options[$entry->ID] = $entry->post_title;
        }

        return $options;
    }

    public static function getCategorySelect()
    {
        $data = get_categories();
        $options = array();
        foreach($data as $entry)
        {
            $options[$entry->term_id] = $entry->name;
        }

        return $options;
    }


    /**
     * gets some attachments by a given id
     *
     * @param integer $post_id
     * @param integer $count Number of attachments to load
     * @param array $enhance Array with arguments to extend the default array
     * @return object
     */
    public static function getAttachmentsByPostId($post_id, $count = null, $enhance = false)
    {
        $args = array(
            'post_type' => 'attachment',
            'numberposts' => $count,
            'post_status' => null,
            'post_parent' => $post_id
        );
        if(is_array($enhance))
        {
            $args = wp_parse_args($enhance, $args);
        }

        return get_posts($args);
    }


    public static function getImageUrlById($id, $size)
    {
        $image_url = wp_get_attachment_image_src($id, $size);

        return $image_url[0];
    }


    /**
     * shortens text to a given maximum length
     *
     * @param string $text
     * @param integer $max_length
     * @return string
     */
    public static function shortenText($text, $max_length = 80)
    {
        $text_length = strlen($text);


        if ($text_length > $max_length)
        {
            $text = $text." ";
            //use mb_substr if exists
            if(function_exists('mb_substr')) {
                $text = mb_substr($text,0,$max_length, 'UTF-8');
                $text2 = mb_substr($text,0,strrpos($text,' '),  'UTF-8');
            }else {
                $text = substr($text,0,$max_length);
                $text2 = substr($text,0,strrpos($text,' '));
            }

            //fix for japanese
            if(empty($text2) && !empty($text)) {
                $text = $text;
            }else {
                $text = $text2;
            }
            $text = $text.'...';
        }

        return $text;
    }

    /**
     * checks if a given url is valid
     *
     * @param string $url
     * @return boolean
     */
    public static function isValidUrl($url)
    {
        return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    }

    /**
     * Gets the comments link nicely formatted
     *
     * @param type $id
     * @param type $bSettings
     * @return type ge
     */
    public static function getCommentsLink($id)
    {
        $bSettings = BebelSingleton::getInstance('BebelSettings');

        if(comments_open())
        {
            comments_popup_link(__('No Comments', $bSettings->getPrefix()), __('One Comment', $bSettings->getPrefix()), __(sprintf('%d Comments', $comments_count), $bSettings->getPrefix()));
//           $comments_count = get_comments_number($id);
//           switch($comments_count)
//           {
//               case 0:
//                   $comments_link = __('No Comments', $bSettings->getPrefix());
//                   break;
//               case 1:
//                   $comments_link = __('One Comment', $bSettings->getPrefix());
//                   break;
//               default:
//                   $comments_link = __(sprintf('%d Comments', $comments_count), $bSettings->getPrefix());
//                   break;
//           }
        }else {
            echo __('Comments Closed', $bSettings->getPrefix());
        }


//        return $comments_link;
    }

    public static function renderFeaturedImage($post_id, $size, $lightbox = false)
    {
        $settings = BebelSingleton::getInstance('BebelSettings');
        $image_url = self::getFeaturedImage($post_id, $size);
        if($image_url)
        {
            return '<img src="'.$image_url.'" alt="'.__(sprintf("featured image %s", get_the_title()), $settings->getPrefix()).'">';
        }
        return '';

    }

    public static function getFeaturedImage($post_id, $size)
    {
        if(self::showFeaturedImage($post_id))
        {
            return self::getFeaturedImageInRequiredSize($post_id, $size);
        }
        return false;

    }

    public static function showFeaturedImage($post_id)
    {
        $isDisabled = self::getCustomMeta("disable_featured_image", false, $post_id);

        return !$isDisabled;
    }

    public static function getFeaturedImageInRequiredSize($post_id, $size)
    {

        $size_fixed = str_replace("-", "_", $size);
        $image = self::getCustomMeta("image_size_".$size_fixed, false, $post_id);
        if(!$image)
        {
            // fall back to default cropped image
            $post_thumbnail_id = get_post_thumbnail_id($post_id);
            $image = wp_get_attachment_image_src($post_thumbnail_id, $size);
            $image = $image[0];
        }


        return $image;
    }

    public static function hasFeaturedImage($post_id, $size)
    {
        if(self::getFeaturedImageInRequiredSize($post_id, $size) != '')
        {
            return true;
        }
        return false;
    }

    /**
     *
     * @param string $meta_key
     * @param string, boolean $default
     * @param integer $post_id
     * @return string
     */
    public static function getCustomMeta($meta_key, $default = false, $post_id = false)
    {
        $settings = BebelSingleton::getInstance('BebelSettings');
        $field = $post_id ? get_post_custom_values($settings->getPrefix().'_'.$meta_key, $post_id) : get_post_custom_values($meta_key);
        if(empty($field)) {
            return $default ? $default : false;
        }
        return $field[0];
    }

    /**
     * Returns all attachments in the database
     *
     * @return object
     */
    public static function getAllAttachments()
    {
        $args = array(
            'post_type' => 'attachment',
            'numberposts' => 99999,
            'post_status' => null,
            'post_parent' => null
        );

        $attachments = get_posts($args);

        return $attachments;
    }

    /**
     * generates mnemonic codes ( easy to remember )
     *
     * @author http://www.developers-guide.net/c/190-zufallspasswort-generator.html
     * @param integer  $lenght
     * @param integer  $digits
     *
     * @return string  $password
     */
    function mnemonicCode($lenght = 3, $digits = 0, $upperlowercase = true)
    {

        if($upperlowercase)
        {
            $consonant = "bcdfghjklmnprstvwxzBCDFGHJKLMNPRSTVWXZ";
            $vowels    = "aeiouyAEIUY";
        }else {
            $consonant = "BCDFGHJKLMNPRSTVWXZ";
            $vowels    = "AEIUY";
        }

        $password  = '';

        mt_srand((double)microtime()*1000000);

        // Vokal/Konsonant-Paare erzeugen
        for($i = 1; $i <= $lenght; $i++)
        {
            $password .= substr($consonant, mt_rand(0, strlen($consonant)-1), 1);
            $password .= substr($vowels, mt_rand(0, strlen($vowels)-1), 1);
        }

        // Zahlen anhängen
        for($i = 1; $i <= $digits; $i++)
            $password .= mt_rand(0, 9);

        return $password;
    }

    /**
     *
     * @param string $url
     * @param integer $post_id
     * @return int, boolean
     */
    public static function getImageIdByUrl($url, $post_id = null)
    {
        // first the very easy way. user gave an id holding url
        if(preg_match('/attachment_id=(\d+)/', $url, $attachment_id))
        {
            return $attachment_id[1];
        }

        // we have to check if it is a valid url, and if it is an attachment of our system
        if(preg_match('/(png|jpg|gif]PNG|JPG|GIF|JPEG)/', $url))
        {
            // now lets get the attachments.
            $attachments = self::getAttachmentsByPostId($post_id);
            $got_all = false;

            // first case: the array is totally empty
            if(!$attachments)
            {
                // seems like it wasn't in the posts attached images.
                // lets try again - globally. maybe it was an image from another post.
                $attachments = self::getAllAttachments();
                $got_all = true;
            }


            if($attachments)
            {
                foreach($attachments as $attachment)
                {
                    $preg = pathinfo(basename($attachment->guid));

                    if(preg_match('/\b'.$preg['filename'].'\b/i', basename($url), $attachment_matches))
                    {
                        return $attachment->ID;
                    }
                }
                // second case: the array had images, but none was used here
                // so if we haven't checked all images yet, lets do it.
                if(!$got_all)
                {
                    $attachments = self::getAllAttachments();
                    if(!$attachments)
                    {
                        // nothing, false.
                    }else {
                        // loop again
                        foreach($attachments as $attachment)
                        {
                            $preg = pathinfo(basename($attachment->guid));

                            if(preg_match('/\b'.$preg['filename'].'\b/i', basename($url), $attachment_matches))
                            {
                                return $attachment->ID;
                            }
                        }
                    }
                }
            }
            return false;
        }
    }

    /**
     * Gets an object of WP_Query for a custom post type
     *
     * @param string $type
     * @param integer $paged
     * @param integer $per_page
     * @return WP_Query
     */
    public static function getCustomPostTypeEntries($type, $paged, $per_page) {

        $q = array(
            'post_type' => $type,
            'paged' => $paged,
            'posts_per_page' => $per_page
        );
        $query = new WP_Query($q);
        return $query;

    }


    /**
     * Gets the correct name of a given taxonomy's short name
     *
     * @param type $tax
     * @return type
     */
    public static function getTaxonomyFullName($tax)
    {
        $settings = BebelSingleton::getInstance('BebelSettings');

        return $settings->getPrefix().'_'.$tax."-category";
    }

    /**
     * Gets a list of terms of a given taxonomy
     *
     * @param string $taxonomy
     * @return string
     */
    public static function getTermsList($taxonomy, $target = 'link') {

        $terms = get_terms($taxonomy);

        $li = '';
        foreach($terms as $term) {
            switch($target)
            {
                case 'link':
                    $link = get_home_url().'?'.$taxonomy.'='.$term->slug;
                    break;
                case '#':
                    $link = '#'.$term->slug;
                    break;
            }
            $li .= '<li><a href="'.$link.'">'.$term->name.'</a></li>';
        }
        return $li;
    }

    public static function getAuthors($args = '')
    {
        global $wpdb;

        $defaults = array(
            'orderby' => 'name', 'order' => 'ASC', 'number' => '',
            'optioncount' => false, 'exclude_admin' => true,
            'show_fullname' => false, 'hide_empty' => true,
            'feed' => '', 'feed_image' => '', 'feed_type' => '', 'echo' => true,
            'style' => 'list', 'html' => true
        );
        $query_args = wp_array_slice_assoc( $args, array( 'orderby', 'order', 'number' ) );
        $query_args['fields'] = 'ids';
        $authors = get_users( $query_args );

        $author_count = array();
        $author_list = array();
        foreach ( (array) $wpdb->get_results("SELECT DISTINCT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE post_type = 'post' AND " . get_private_posts_cap_sql( 'post' ) . " GROUP BY post_author") as $row )
        {
            $author_count[$row->post_author] = $row->count;
        }
        foreach ( $authors as $author_id )
        {
            $author = get_userdata( $author_id );

            $posts = isset( $author_count[$author->ID] ) ? $author_count[$author->ID] : 0;

            if(!$posts)
            {
                continue;
            }


            $author_list[] = $author->user_login ;
        }

        return $author_list;

    }

    public static function getAuthorImage($id)
    {
        return get_the_author_meta('bebel_author_image', $id);
    }

    public function getAuthorList()
    {
        $author_list =  self::getAuthors();

        $options = array();
        foreach($author_list as $author)
        {
            $userdata = get_user_by('login', $author);
            $options[$userdata->ID] = self::getAuthorName($userdata->ID);
        }

        return $options;
    }

    public static function getAuthorName($id, $lastorfirstonly = false)
    {
        global $settings;
        $author_first = get_the_author_meta('first_name', $id);
        $author_last  = get_the_author_meta('last_name', $id);
        $author_order = $settings->get('blog_author_name_order');

        if(!$lastorfirstonly)
        {
            if($author_order == "first_last")
            {
                $author_string = $author_first." ".$author_last;
            }else {
                $author_string = $author_last." ".$author_first;
            }
        }else {
            if($author_order == "first_last")
            {
                $author_string = $author_first;
            }else {
                $author_string = $author_last;
            }
        }
        if(trim($author_string) == "") {
            $author_string = ucfirst(get_the_author_meta('user_nicename', $id)); // fall back to username
        }
        return $author_string;
    }

    /**
     * Displays a nicely formatted title
     */
    public static function getPageTitle()
    {
        if(is_single())
        {
            single_post_title();
            echo ' | ';
            bloginfo( 'name' );
        }elseif(is_home() || is_front_page()) {

            bloginfo( 'name' );
            if(get_bloginfo('description'))
            {
                echo ' | ';
                bloginfo( 'description' );
            }

        }elseif(is_page()) {

            single_post_title( '' );
            echo ' | ';
            bloginfo( 'name' );

        }elseif(is_search()) {
            $bSettings = BebelSingleton::getInstance('BebelSettings');
            _e("Search Results", $bSettings->getThemename());
        }elseif(is_404()) {
            bloginfo( 'name' );
            echo ' | ';
            bloginfo( 'name' );
        }else {
            wp_title( '' );
            echo ' | ';
            bloginfo( 'name' );
        }
    }

    public static function getCurrentlyBrowsedFile()
    {
        return basename($_SERVER['PHP_SELF']);
    }

    public static function deactivateWidgets($widgets)
    {
        if(is_array($widgets))
        {
            foreach($widgets as $widget)
            {
                unregister_widget($widget);
            }
        }else {
            unregister_widget($widgets);
        }

    }

    public static function parseStyleCss()
    {
        $basic_settings = array();
        $wordpress_theme_data = wp_get_theme();
        $basic_settings['base_theme_info'] = array(
            'theme_name' => $wordpress_theme_data->Name,
            'theme_version' => $wordpress_theme_data->Version,
            'theme_prefix' => preg_replace('/\s+/', '-', strtolower($wordpress_theme_data->Name)) //replace all whitespaces with dashes
        );

        return $basic_settings;
    }

}// END CLASS
