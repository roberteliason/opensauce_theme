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
					<span class="printable-sitename"><?php bloginfo( 'name' ) ?></span>
				</a>
				<a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>

				<?php opensauce_maybe_cache_output( 'main_menu', 'opensauce_render_main_menu', HOUR_IN_SECONDS ); ?>
			</div>
		</header>

		<div class="main">