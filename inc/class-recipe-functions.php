<?php

class Recipe_Functions {

    /**
     * Return instance of self
     *
     * @return static
     */
    public static function get()
    {
        static $instance = null;
        if ( null === $instance ) {
            $instance = new static();
        }

        return $instance;
    }


    /**
     * Get the n latest published recipes
     *
     * @param int $number
     * @return array|bool
     */
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


    /**
     * Get all ingredient terms for a recipe
     *
     * @param $recipe_id
     * @return array|bool
     */
    public function get_recipe_tags( $recipe_id ) {
        $terms = wp_get_post_terms( $recipe_id, 'ingredient' );
        if ( is_wp_error( $terms ) ) {
            return false;
        }

        return $terms;
    }


	/**
	 * Get all recipe categories for a recipe
	 *
	 * @param $recipe_id
	 * @return array|bool
	 */
	public function get_recipe_cats( $recipe_id ) {
		$terms = wp_get_post_terms( $recipe_id, 'recipe_type' );
		if ( is_wp_error( $terms ) ) {
			return false;
		}

		return $terms;
	}
}