<?php

class Opensauce_Nav_Walker extends Walker_Nav_Menu {

    // Displays start of a level. E.g '<ul>'
    // @see Walker::start_lvl()
    function start_lvl( &$output, $depth=0, $args=array() ) {
        $output .= "\n<ul >\n";
    }

    // Displays end of a level. E.g '</ul>'
    // @see Walker::end_lvl()
    function end_lvl( &$output, $depth=0, $args=array() ) {
        $output .= "</ul>\n";
    }

    // Displays start of an element. E.g '<li> Item Name'
    // @see Walker::start_el()
    function start_el( &$output, $item, $depth=0, $args=array(), $id=0 ) {
/*        echo( '<pre style="color: white;">' );
        var_dump( $item );
        echo( '</pre>' );*/
        $output .= "<li class=\"nav-link\">" ;
        $output .= "\t<a href=\"{$item->url}\">";
        $output .= esc_attr( $item->title );
        $output .= "</a>";
    }

    // Displays end of an element. E.g '</li>'
    // @see Walker::end_el()
    function end_el( &$output, $item, $depth=0, $args=array() ) {
        $output .= "</li>\n";
    }
}

