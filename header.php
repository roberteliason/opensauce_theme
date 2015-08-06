<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="main">
 *
 * @package opensauce
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

		<header class="navigation">
			<div class="navigation-wrapper">
				<a href="<?php echo home_url(); ?>" class="logo">
                    <?php opensauce_render_image( 'chili_pepper.png', 'Open Sauce' ) ?>
				</a>
				<a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>

                <?php opensauce_render_main_menu() ?>
			</div>
		</header>

		<div class="main">