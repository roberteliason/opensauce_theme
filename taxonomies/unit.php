<?php

function unit_init() {
	register_taxonomy( 'unit', array( 'recipe' ), array(
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
			'name'                       => __( 'Units', 'opensauce' ),
			'singular_name'              => _x( 'Units', 'taxonomy general name', 'opensauce' ),
			'search_items'               => __( 'Search Units', 'opensauce' ),
			'popular_items'              => __( 'Popular Units', 'opensauce' ),
			'all_items'                  => __( 'All Units', 'opensauce' ),
			'parent_item'                => __( 'Parent Units', 'opensauce' ),
			'parent_item_colon'          => __( 'Parent Units:', 'opensauce' ),
			'edit_item'                  => __( 'Edit Units', 'opensauce' ),
			'update_item'                => __( 'Update Units', 'opensauce' ),
			'add_new_item'               => __( 'New Units', 'opensauce' ),
			'new_item_name'              => __( 'New Units', 'opensauce' ),
			'separate_items_with_commas' => __( 'Units separated by comma', 'opensauce' ),
			'add_or_remove_items'        => __( 'Add or remove Units', 'opensauce' ),
			'choose_from_most_used'      => __( 'Choose from the most used Units', 'opensauce' ),
			'menu_name'                  => __( 'Units', 'opensauce' ),
		),
	) );

}
add_action( 'init', 'unit_init' );
