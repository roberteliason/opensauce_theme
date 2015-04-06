<?php

function ingredient_init() {
	register_taxonomy( 'ingredient', array( 'recipe' ), array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'            => array(
			'name'                       => __( 'Ingredients', 'opensauce' ),
			'singular_name'              => _x( 'Ingredients', 'taxonomy general name', 'opensauce' ),
			'search_items'               => __( 'Search Ingredients', 'opensauce' ),
			'popular_items'              => __( 'Popular Ingredients', 'opensauce' ),
			'all_items'                  => __( 'All Ingredients', 'opensauce' ),
			'parent_item'                => __( 'Parent Ingredients', 'opensauce' ),
			'parent_item_colon'          => __( 'Parent Ingredients:', 'opensauce' ),
			'edit_item'                  => __( 'Edit Ingredients', 'opensauce' ),
			'update_item'                => __( 'Update Ingredients', 'opensauce' ),
			'add_new_item'               => __( 'New Ingredients', 'opensauce' ),
			'new_item_name'              => __( 'New Ingredients', 'opensauce' ),
			'separate_items_with_commas' => __( 'Ingredients separated by comma', 'opensauce' ),
			'add_or_remove_items'        => __( 'Add or remove Ingredients', 'opensauce' ),
			'choose_from_most_used'      => __( 'Choose from the most used Ingredients', 'opensauce' ),
			'menu_name'                  => __( 'Ingredients', 'opensauce' ),
		),
	) );

}
add_action( 'init', 'ingredient_init' );
