<?php
/**
 * opensauce Theme Customizer
 *
 * @package opensauce
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function opensauce_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_section( 'themes' );
	$wp_customize->remove_section( 'title_tagline' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );


	// HEADER SECTION
	$wp_customize->add_section( 'opensauce_header_section' , array(
		'title'    => __( 'Header settings', 'opensauce' ),
		'priority' => 10,
	) );

	// Header logo
	$wp_customize->add_setting( 'opensauce_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'customizer_opensauce_logo',
		array(
			'label'       => __( 'Logo', 'opensauce' ),
			'description' => __( 'Upload a logo to be displayed', 'opensauce' ),
			'section'     => 'opensauce_header_section',
			'settings'    => 'opensauce_logo',
			'priority'    => 2,
		)
	) );



	// SOCIAL LINKS SECTION
	$wp_customize->add_section( 'opensauce_social_links_section' , array(
		'title'    => __( 'Social links settings', 'opensauce' ),
		'priority' => 30,
	) );

	// Facebook
	$wp_customize->add_setting( 'opensauce_footer_facebook', array( 'default' => '', 'transport' => '', 'sanitize_callback' => 'esc_url_raw', ) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'customizer_footer_facebook',
		array(
			'label'    => __( 'Facebook', 'opensauce' ),
			'section'  => 'opensauce_social_links_section',
			'settings' => 'opensauce_footer_facebook',
			'type'     => 'url',
			'priority' => 1,
		)
	));

	// Twitter
	$wp_customize->add_setting( 'opensauce_footer_twitter', array( 'default' => '', 'transport' => '', 'sanitize_callback' => 'esc_url_raw', ) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'customizer_footer_twitter',
		array(
			'label'    => __( 'Twitter', 'opensauce' ),
			'section'  => 'opensauce_social_links_section',
			'settings' => 'opensauce_footer_twitter',
			'type'     => 'url',
			'priority' => 2,
		)
	));

	// Instagram
	$wp_customize->add_setting( 'opensauce_footer_instagram', array( 'default' => '', 'transport' => '', 'sanitize_callback' => 'esc_url_raw', ) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'customizer_footer_instagram',
		array(
			'label'    => __( 'Instagram', 'opensauce' ),
			'section'  => 'opensauce_social_links_section',
			'settings' => 'opensauce_footer_instagram',
			'type'     => 'url',
			'priority' => 3,
		)
	));

	// Youtube
	$wp_customize->add_setting( 'opensauce_footer_googleplus', array( 'default' => '', 'transport' => '', 'sanitize_callback' => 'esc_url_raw', ) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'customizer_footer_googleplus',
		array(
			'label'    => __( 'Google Plus', 'opensauce' ),
			'section'  => 'opensauce_social_links_section',
			'settings' => 'opensauce_footer_googleplus',
			'type'     => 'url',
			'priority' => 4,
		)
	));

}
add_action( 'customize_register', 'opensauce_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function opensauce_customize_preview_js() {
	wp_enqueue_script( 'opensauce_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'opensauce_customize_preview_js' );
