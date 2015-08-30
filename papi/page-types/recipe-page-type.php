<?php

class Recipe_Page_Type extends Papi_Page_Type {

	/**
	 * Page type meta
	 *
	 * @return array
	 */
	public function page_type() {
		return [
			'name'        => 'Recipe page',
			'description' => 'The key recipe content',
			'post_type'   => 'recipe',
			'fill_labels' => true,
			'template'    => 'papi/pages/recipe-page.php'
		];
	}


	public function register() {

		// Remove comments meta box
		$this->remove( 'comments' );


		// Url properties
		$this->box( 'Recipe information', [
			papi_property( [
				'type'  => 'number',
				'title' => 'Total time',
				'slug'  => 'recipe_total_time'
			] ),
			papi_property( [
				'type'  => 'number',
				'title' => 'Oven temperature',
				'slug'  => 'recipe_oven_temp'
			] ),
		] );


		// Repeater property
		$this->box( 'Ingredients', [
			papi_property( [
				'type'     => 'repeater',
				'title'    => 'Ingredients',
				'slug'     => 'recipe_ingredients',
				'sidebar'  => false,
				'settings' => [
					'items' => [
						papi_property( [
							'type'  => 'string',
							'title' => 'Amount',
							'slug'  => 'ingredient_amount'
						] ),
						papi_property( [
							'type'  => 'dropdown',
							'title' => 'Unit',
							'slug'  => 'ingredient_unit',
							'settings' => [
								'items' => $this->get_recipe_units()
							]
						] ),
						papi_property( [
							'type'  => 'string',
							'title' => 'Ingredient',
							'slug'  => 'ingredient_name'
						] )
					]
				]
			] )
		] );


		// Repeater property
		$this->box( 'Steps', [
			papi_property( [
				'type'     => 'repeater',
				'title'    => 'Steps',
				'slug'     => 'recipe_steps',
				'sidebar'  => false,
				'settings' => [
					'items' => [
						papi_property( [
							'type'  => 'text',
							'title' => 'Step',
							'slug'  => 'recipe_step'
						] )
					]
				]
			] )
		] );

		// Repeater property
		$this->box( 'Images', [
			papi_property( [
				'title' => 'Recipe Images',
				'slug'  => 'recipe_images',
				'type'  => 'gallery'
			] )
		] );

		// Flexible property
		$this->box( 'Nonsense', [
			papi_property( [
				'title'    => 'Flexible',
				'slug'     => 'recipe_nonsense',
				'type'     => 'flexible',
				'settings' => [
					'items' => [
						[
							'title' => 'Rating',
							'items' => [
								papi_property( [
									'type'  => 'string',
									'title' => 'Rating',
									'slug'  => 'rating_value'
								] ),
								papi_property( [
									'type'  => 'string',
									'title' => 'Max Rating',
									'slug'  => 'rating_max_value'
								] ),
								papi_property( [
									'type'  => 'text',
									'title' => 'Motivation',
									'slug'  => 'rating_motivation'
								] )
							]
						],
						[
							'title' => 'Factoid',
							'items' => [
								papi_property( [
									'type'  => 'string',
									'title' => 'Factoid Title',
									'slug'  => 'factoid_title'
								] ),
								papi_property( [
									'type'  => 'text',
									'title' => 'Text',
									'slug'  => 'factoid_text'
								] )
							]
						],
						[
							'title' => 'Gauge',
							'items' => [
								papi_property( [
									'type'  => 'string',
									'title' => 'Gauge Label',
									'slug'  => 'gauge_label'
								] ),
								papi_property( [
									'type'  => 'number',
									'title' => 'Gauge Value',
									'slug'  => 'gauge_value'
								] )
							]
						]
					]
				]
			] )
		] );
	}


	public function get_recipe_units() {
		$taxonomies = [ 'unit' ];
		$args       = [
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => 0
		];

		$terms = get_terms( $taxonomies, $args );
		if ( true !== is_wp_error( $terms ) ) {
			return wp_list_pluck( $terms, 'term_id', 'name' );
		}

		return [];
	}
}
