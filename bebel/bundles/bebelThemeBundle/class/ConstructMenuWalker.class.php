<?php

class ConstructMenuWalker extends Walker_Nav_Menu{

    //set has_children
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
    {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    function start_el(&$output, $item, $depth, $args){
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $attributes = '';
        if ($this->getProperty($args, 'has_children') && $depth == 0){
            $classes[] = 'dropdown';
            $attributes .= ' class="dropdown-toggle"';
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : ' title="'  . esc_attr( $item->post_title ) .'"';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ' href="'   . esc_attr( get_permalink($item->ID) ) .'"';

        $prepend = '<span class="nav-item-title">';
        $append = '</span>';
        $description  = ! empty( $item->description ) ? '<span class="nav-item-description">'.esc_attr( $item->description ).'</span>' : '';

        if($depth != 0)
        {
            $description = $append = $prepend = "";
        }


        $item_output = $this->getProperty($args, 'before');
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $this->getProperty($args, 'link_before') .$prepend.apply_filters( 'the_title', $item->title ? $item->title : $item->post_title, $item->ID ).$append;
        $item_output .= $description.$this->getProperty($args, 'link_after');
        $item_output .= '</a>';
        $item_output .= $this->getProperty($args, 'after');

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0){
            $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        }
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0){
           $output .= "$indent</ul>\n";
        }
    }

    //sometimes $args is array sometimes is object
    private function getProperty($object, $property){
        return is_array($object) ? $object[$property] : $object->$property;
    }
}

