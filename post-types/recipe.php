<?php

define('EP_RECIPE', 8388608); // 8388608 = 2^23

function recipe_init() {
	register_post_type( 'recipe', array(
		'labels'            => array(
			'name'                => __( 'Recipes', 'opensauce' ),
			'singular_name'       => __( 'Recipe', 'opensauce' ),
			'all_items'           => __( 'Recipes', 'opensauce' ),
			'new_item'            => __( 'New Recipe', 'opensauce' ),
			'add_new'             => __( 'Add New', 'opensauce' ),
			'add_new_item'        => __( 'Add New Recipe', 'opensauce' ),
			'edit_item'           => __( 'Edit Recipe', 'opensauce' ),
			'view_item'           => __( 'View Recipe', 'opensauce' ),
			'search_items'        => __( 'Search Recipes', 'opensauce' ),
			'not_found'           => __( 'No Recipes found', 'opensauce' ),
			'not_found_in_trash'  => __( 'No Recipes found in trash', 'opensauce' ),
			'parent_item_colon'   => __( 'Parent Recipe', 'opensauce' ),
			'menu_name'           => __( 'Recipes', 'opensauce' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'       => true,
		'rewrite'           => array(
									'slug'       => 'recipe',
									'with_front' => true,
									'feed'       => true,
							        'pages'      => true,
							        'ep_mask'    => EP_RECIPE,
							   ),
		'query_var'         => true,
		'menu_icon'         => 'dashicons-book-alt',
	) );

}
add_action( 'init', 'recipe_init' );

function recipe_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['recipe'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Recipe updated. <a target="_blank" href="%s">View Recipe</a>', 'opensauce'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'opensauce'),
		3 => __('Custom field deleted.', 'opensauce'),
		4 => __('Recipe updated.', 'opensauce'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Recipe restored to revision from %s', 'opensauce'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Recipe published. <a href="%s">View Recipe</a>', 'opensauce'), esc_url( $permalink ) ),
		7 => __('Recipe saved.', 'opensauce'),
		8 => sprintf( __('Recipe submitted. <a target="_blank" href="%s">Preview Recipe</a>', 'opensauce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Recipe scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Recipe</a>', 'opensauce'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Recipe draft updated. <a target="_blank" href="%s">Preview Recipe</a>', 'opensauce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'recipe_updated_messages' );

add_rewrite_endpoint( 'qr', EP_RECIPE );


function opensauce_recipe_template_include( $template ) {
	$uri_elements  = explode( '/', trim( $_SERVER['REQUEST_URI'], '/' ) );
	$first_element = array_shift( $uri_elements );
	$last_element  = array_pop( $uri_elements );

	if ( 'recipe' == $first_element && 'qr' == $last_element ) {
		$new_template = locate_template( array( 'qr.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}

	return $template;
}
add_action( 'template_include', 'opensauce_recipe_template_include' );