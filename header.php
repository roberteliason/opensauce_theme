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

		<header class="navigation" role="banner">
			<div class="navigation-wrapper">
				<a href="<?php echo home_url(); ?>" class="logo">
                    <?php opensauce_render_image( 'chili_pepper.png', 'Open Sauce' ) ?>
				</a>
				<a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>
				<nav role="navigation">
					<?php // wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

					<ul id="js-navigation-menu" class="navigation-menu show">
						<li class="nav-link"><a href="recipe.html">Recipes</a></li>
						<li class="nav-link"><a href="javascript:void(0)">About Us</a></li>
						<li class="nav-link"><a href="javascript:void(0)">Contact</a></li>
						<li class="nav-link hidden-desktop">
							<div class="social-profiles">
								<a href="http://twitter.com" target="_blank" class="social-media twitter"><?php opensauce_render_image( 'twitter.svg', 'Twitter' ) ?></a>
								<a href="http://facebook.com" target="_blank" class="social-media facebook"><?php opensauce_render_image( 'facebook.svg', 'Facebook' ) ?></a>
								<a href="http://instagram.com" target="_blank" class="social-media instagram"><?php opensauce_render_image( 'instagram.svg', 'Instagram' ) ?></a>
								<a href="http://pinterest.com" target="_blank" class="social-media pinterest"><?php opensauce_render_image( 'pinterest.svg', 'Pinterest' ) ?></a>
							</div>							
						</li>
					</ul>
				</nav>
			</div>
		</header>

		<div class="main">