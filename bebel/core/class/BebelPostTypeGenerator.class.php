<?php

class BebelPostTypeGenerator
{

  protected
    $options,
    $theme_prefix;

  public function  __construct($theme_prefix)
  {
    $this->theme_prefix = $theme_prefix;
  }

  public function setOptions($options)
  {
    $this->options = array(); // reset
    $this->options = $options;
    return $this;
  }

  
  public function registerPostType()
  {
      
    if(!post_type_exists($this->options['type_name'])) {
      register_post_type($this->options['type_name'],
        array(
          'labels' => array(
            'name' => _x($this->options['name'],$this->theme_prefix),
            'singular_name' =>__($this->options['singular_name']),
            'add_new' => _x('Add New', $this->theme_prefix),
            'add_new_item' => _x('Add New '.$this->options['singular_name'], $this->theme_prefix),
            'edit_item' => _x('Edit '.$this->options['singular_name'], $this->theme_prefix),
            'new_item' => _x('New '.$this->options['singular_name'], $this->theme_prefix),
            'view_item' => _x('View '.$this->options['singular_name'], $this->theme_prefix),
            'search_items' => _x('Search '.$this->options['name'], $this->theme_prefix),
            'not_found' =>  _x('No '.$this->options['singular_name'].' found', $this->theme_prefix),
            'not_found_in_trash' => _x('No '.$this->options['name'].' found in Trash', $this->theme_prefix)
          ),
          'public' => $this->options['public'],
          'show_ui' => $this->options['show_ui'],
          'capability_type' => $this->options['capability_type'],
          'menu_position' => $this->options['menu_position'],
          'hierarchical' => $this->options['type_hierarchical'],
          'supports' => $this->options['supports'], //array('title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions', 'excerpt', 'category'),
          'rewrite' => $this->options['type_rewrite'], //array('slug' => 'gallery'),
          'menu_icon' => BebelUtils::replaceToken($this->options['menu_icon'], 'BCP_BUNDLE_PATH')
        )
      );
      
      return $this;
    }
  }

  public function registerTaxonomy() {
      
    if(isset($this->options['use_taxonomy']) && $this->options['use_taxonomy'] === true && !taxonomy_exists($this->options['type_name']."-category"))
    {
    
      register_taxonomy($this->options['type_name']."-category",
        array($this->options['type_name']),
        array(
          "hierarchical" => $this->options['taxonomy_hierarchical'],
          "label" => $this->options['taxonomy_name'],
          'show_ui' => true, 
          "singular_label" => $this->options['taxonomy_name_singular'],
          "rewrite" => array('slug' => $this->options['type_name']."-category"),
          'query_var' => $this->options['type_name']."-category_tax"
          )
      );
      
    }
    return $this;
  }


  public function flush()
  {
    //flush_rewrite_rules(true);
    return $this;
  }

  public function getAllPostTypes()
  {
    return get_post_types();
    get_term_by();
  }
  
}