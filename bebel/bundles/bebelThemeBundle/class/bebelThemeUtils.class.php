<?php

class bebelThemeUtils
{

  /**
   * Returns a list of all existing icons.
   * TODO: enhance to automatic scan of folders
   *
   * @return array
   */
  public static function getIconList()
  {
    return array(
      'cloud' => 'Cloud',
      'globe' => 'Globe',
      'heart' => 'Heart',
      'lock' => 'Lock',
      'mail' => 'Mail',
      'movie' => 'Movie',
      'pen' => 'Pen',
      'picture' => 'Picture',
      'screen' => 'Screen',
      'star' => 'Star',
      'user' => 'User',
      'weather' => 'Weather',
      'pen_crossed' => 'Crossed Pen'
    );
  }
  
  /**
   * Returns a list of all existing icons.
   * TODO: enhance to automatic scan of folders
   *
   * @return array
   */
  public static function getDualContentIconList()
  {
    return array(
      'gear' => 'Gear',
      'globe' => 'Globe',
      'heart' => 'Heart',
      'home' => 'Home',
      'lock' => 'Lock',
      'magnifier' => 'Magnifier',
      'money' => 'Money',
      'people' => 'People',
      'photo' => 'Photo',
      'recycle' => 'Recycle',
      'save' => 'Save',
      'smile' => 'Smile',
      'success' => 'Success',
      'trash' => 'Trash',
      'valet' => 'Valet'
    );
  }
  
  /**
   * Returns a list of all existing social icons.
   * TODO: enhance to automatic scan of folders
   *
   * @return array
   */
  public static function getSocialIconList()
  {
    return array(
        'digg', 'facebook', 'flickr', 'linkedin', 'rss', 'stumbleupon', 'tumblr', 'twitter', 'vimeo', 'youtube'
    );
  }  
  
  public static function splitContent($text, $separator = '<hr/>', $start = false) {

        if ($start === false) {
            $start = strlen($text) / 2;
        }

        $lastSpace = false;
        $split = substr($text, 0, $start - 1);

        // if the text is split at a good breaking point already.
        if (in_array(substr($text, $start - 1, 1), array(' ', '.', '!', '?'))) {

            $split .= substr($text, $start, 1);
            // Calculate when we should start the split
            $trueStart = strlen($split);

        // find a good point to break the text.
        } else {

            $split = substr($split, 0, $start - strlen($separator));
            $lastSpace = strrpos($split, ' ');

            if ($lastSpace !== false) {
                $split = substr($split, 0, $lastSpace);
            }

            if (in_array(substr($split, -1, 1), array(','))) {
                $split = substr($split, 0, -1);
            }

        // Calculate when we should start the split
            $trueStart = strlen($split);
        }
        //now we know when to split the text
        return substr_replace($text, $separator, $trueStart, 0);
    }

    /**
   * Gets a list of terms for the quicksand filter method
   *
   * @param string $taxonomy
   * @return string
   */
  public static function getQuicksandTermsList($taxonomy)
  {

    $settings = BebelSingleton::getInstance('BebelSettings');
    $terms = get_terms($taxonomy);

    $li = '<li><a href="#" class="quicksand_filter" data-value="all">'._x('All', $settings->getPrefix()).'</a></li>';
    foreach($terms as $term) {
      $li .= '<li><a href="#" class="quicksand_filter" data-value="'.$term->slug.'">'.$term->name.'</a></li>';
    }
    return $li;
  }

  
  
  public static function getVideoOrThumbnailForHeader($_size, $url)
  {
    
    switch($_size)
    {
      case 'big':
        $size = array(
            'width' => '960px',
            'height' => '527px',
            'thumb_size' => 'background-header-big',
            'force' => true
        );
        break;
      default:
        // left, right
        $size = array(
            'width' => '960px',
            'height' => '200px',
            'thumb_size' => 'background-header',
            'force' => true
        );
    }

    
    if(preg_match('/(png|jpg|gif]PNG|JPG|GIF|JPEG)/', $url))
    {
        
        return '<img src="'.$url.'" alt="background header"/>'; 
    }
    
    // check video
    
    $parsed = bebelPortfolioUtils::getEmbeddedVideo($url, $size);
    
    if($parsed == $url)
    {
        // could not parse the video. show an error message
        
        $settings = BebelSingleton::getInstance('BebelSettings');
        return __('Could not load the video (or image), the url could not be parsed. Maybe this host is not supported or this specific video cannot be embedded.!', $settings->getPrefix());
    }else {
        return $parsed;
    }

  }
  
  
  
  /**
   * Returns a string with a list of all slider images of a given post.
   *
   * @param integer $post_id
   * @return string
   */
  public static function getAllSliderImages($post_id, $size = 'non-full')
  {
 
    switch($size)
    {
      case 'big':
        $size = 'post-big-first';
        break;
      case 'full':
        $size = 'post-single-full';
        break;
      default:
        $size = 'post-single-wide';
    }

    $image_list = array();
    $images = '';
    $style = '';

    // first step: get post image

    if(has_post_thumbnail($post_id))
    {
      $image_list[] = get_post_thumbnail_id($post_id);
    }    

    for($i=0;$i<4;$i++)
    {
      $image = BebelUtils::getCustomMeta('slider_foreground_image_'.$i, false, $post_id);
      

      if($image)
      {
        $image = BebelUtils::getImageIdByUrl($image, $post_id);
        $image_list[] = $image;
      }
    }


    // no image found, return false
    if(count($image_list) == 0)
    {
      return false;
    }

    //loop the images and get details
    $i = 0;

    // kick double keys, for instance if the post thumbnail was also used as a slider image
    $image_list = array_unique($image_list);
    
    foreach($image_list as $image)
    {
      if($i > 0)
      {
        $style = 'style="display: none;"';
      }
      $link = wp_get_attachment_image_src($image, 'full');
      $image_url = wp_get_attachment_image_src($image, $size);
      $images .= '<a href="'.$link[0].'" rel="prettyPhoto['.$post_id.']"><img src="'.$image_url[0].'" '.$style.' alt="slider image '.$i.'" /></a>';
      $i++;
    }

    return array('count' => count($image_list), 'images' => $images);
    
  }

  public static function displayComments($comment, $args, $depth)
  {

    $bSettings = BebelSingleton::getInstance('BebelSettings');
    $GLOBALS['comment'] = $comment;

    include(get_template_directory().'/template_parts/comments-loop.php');

  }

  public static function getBaseTemplateRaw($string)
  {

    $template = basename($string);
    $template = explode('.', $template);
    return $template[0];

  }

  public static function getSearchForm()
  {
    $bSettings = BebelSingleton::getInstance('BebelSettings');
    include_once(get_template_directory().'/template_parts/searchform.php');
  }


  /**
   * Courtesy to kriesi: http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
   * enhanced by bebel
   *
   * @param int $pages
   * @param int $paged
   * @param int $display_range
   * @param string $css_class
   * @param string $active_class
   * @return string
   */
  public static function getNumberedPagination($pages, $paged, $display_range, $css_class, $active_class) {

    $show_items = $display_range * 2 + 1;


    if(empty($paged)) $paged = 1;
    //else $paged = $paged -1;
    if(!$pages) $pages = 1;

    // more than one page required, right?
    if($pages > 1) {
      $li = '';
      if($paged > 2 && ($paged == $display_range + 1) && $show_items < $pages) {
        $li .= '<li class="'.$css_class.'"><a href="'.get_pagenum_link(1).'">&laquo;</a></li>';
      }
      if($paged > 1 && $show_items < $pages) {
        $li .= '<li class="'.$css_class.'"><a href="'.get_pagenum_link($paged - 1).'">&lsaquo;</a></li>';
      }

      // loop all the pages
      for($i = 1; $i<=$pages;$i++) {
        // if page is not next arrow and if page is not last arrow
        if(!($i >= $paged+$display_range+1 || $i <= $paged-$display_range-1) || $pages <= $show_items ) {
          if($i == $paged) {
            $li .= '<li class="'.$active_class.'">'.$i.'</li>';
          }else {
            $li .= '<li class="'.$css_class.'"><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
          }
        }
      }

      if($paged < $pages && $show_items < $pages) {
        $li .= '<li class="'.$css_class.'"><a href="'.get_pagenum_link($paged + 1).'">&rsaquo;</a></li>';
      }
      if($paged < $pages-1 && $paged + $display_range-1 < $pages && $show_items < $pages) {
        $li .= '<li class="'.$css_class.'"><a href="'.get_pagenum_link($pages).'">&raquo;</a></li>';
      }

      return $li;
    }
  }

  /**
   * A very simple method to get the mainpage's sidebar top margin.
   * It changes everytime a setting is disabled or enabled.
   *
   * @return string
   */
  public static function getMainpageSidebarTopMargin($positive = false, $minus = 0)
  {
    $bSettings = BebelSingleton::getInstance('BebelSettings');
    
    if($bSettings->get('mainpage_slider_enable') == 'on') {
      $sidebar_top = 30;
    }else {
      $sidebar_top = 20;
    }
    if($bSettings->get('twitter_enable') == 'on')
    {
      $sidebar_top = $sidebar_top + 70;
    }
    if($minus != 0)
    {
        
        $sidebar_top = $sidebar_top - $minus;   
        
    }
    if($positive)
    {
        $sidebar_top = ($sidebar_top-14).'px'; // fix for shadow graphic
    }else {
        $sidebar_top = '-'.$sidebar_top.'px';
    }
    

    return $sidebar_top;
  }

  public static function renderCssFromPost($post_id)
  {
    $return = '';
    $css = BebelUtils::getCustomMeta('css', false, $post_id);
    if($css)
    {
      $return = '<style type="text/css">';
      $return .= $css;
      $return .= '</style>';
    }

    return $return;
  }
  
    
    
    public static function tagCloudFontSize($in)
    {
        return 'smallest=14&largest=14&number=14&orderby=name&unit=px';
    }
    
    public static function deactivateWidgets()
    {
        $widgets = array(
            'WP_Widget_Calendar',
            'WP_Widget_Archives',
            'WP_Widget_Search',
            'WP_Widget_Categories',
            'WP_Widget_RSS',
        );
        
        BebelUtils::deactivateWidgets($widgets);
    }
    
    public static function replaceRssWithFeedburner($output, $show) 
    {
        $settings = BebelSingleton::getInstance('BebelSettings');
        
        $rss_url = $settings->get('social_count_rss');
        
        if(!empty($rss_url))
        {
            if (in_array($show, array('rss_url', 'rss2_url', 'rss', 'rss2', '')))
            {
                $output = $rss_url;
            }
        }
            
 
        return $output;
    }
    
    public static function getSocialIconsListFromBackend()
    {
        $settings = BebelSingleton::getInstance('BebelSettings');
        
        $icons = $settings->get('footer_social_icons');
        
        $li = '';
        
        if(is_array($icons))
        {
            $absurl = $icons['absurl']; // first, get the absolute url and then unset this
            unset($icons['absurl']);
            
        
            foreach($icons as $icon) {
                if(!empty($icon['url'])) {
                    $replace = array('.jpg', '.png', '.gif', '.jpeg');
                    $name = str_replace($replace, '', strtolower($icon['file']));

                    $li .= '<li><a href="'.$icon['url'].'" class="social_icon_small_'.$name.'" style="background-image: url('.trailingslashit($absurl).$icon['file'].')"></a></li>';
                }

            }
        }
        
        
        
        return $li;
    }

}