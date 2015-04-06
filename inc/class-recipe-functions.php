<?php

class Recipe_Functions {

    public static function get()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }


    public function get_latest( $number = 5 ) {
        $args = array(
            'post_type'      => 'recipe',
            'orderby'        => 'published',
            'posts_per_page' => $number,
        );

        $posts = get_posts( $args );

        if ( is_wp_error( $posts ) ) {
            return false;
        }

        return $posts;
    }
}