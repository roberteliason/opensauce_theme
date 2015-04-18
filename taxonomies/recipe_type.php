<?php

function recipe_type_init() {
	register_taxonomy( 'recipe_type', array( 'recipe' ), array(
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
			'name'                       => __( 'Types', 'opensauce' ),
			'singular_name'              => _x( 'Type', 'taxonomy general name', 'opensauce' ),
			'search_items'               => __( 'Search Types', 'opensauce' ),
			'popular_items'              => __( 'Popular Types', 'opensauce' ),
			'all_items'                  => __( 'All Types', 'opensauce' ),
			'parent_item'                => __( 'Parent Type', 'opensauce' ),
			'parent_item_colon'          => __( 'Parent Type:', 'opensauce' ),
			'edit_item'                  => __( 'Edit Type', 'opensauce' ),
			'update_item'                => __( 'Update Type', 'opensauce' ),
			'add_new_item'               => __( 'New Type', 'opensauce' ),
			'new_item_name'              => __( 'New Type', 'opensauce' ),
			'separate_items_with_commas' => __( 'Types separated by comma', 'opensauce' ),
			'add_or_remove_items'        => __( 'Add or remove Types', 'opensauce' ),
			'choose_from_most_used'      => __( 'Choose from the most used Types', 'opensauce' ),
			'menu_name'                  => __( 'Types', 'opensauce' ),
		),
	) );

}
add_action( 'init', 'recipe_type_init' );
