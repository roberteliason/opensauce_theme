<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package opensauce
 */

get_header(); ?>

    <section class="latest">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image: url( '<?php echo get_template_directory_uri(); ?>/img/3.jpg' );">
                    <a href="recipe.html">
                        <header>
                            <h2>Recipe title</h2>
                        </header>
                        <div class="body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        </div>
                    </a>
                </div>
                <div class="swiper-slide" style="background-image: url( '<?php echo get_template_directory_uri(); ?>/img/7.jpg' );">
                    <a href="recipe.html">
                        <header>
                            <h2>Recipe title</h2>
                        </header>
                        <div class="body">
                            Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </a>
                </div>
                <div class="swiper-slide" style="background-image: url( '<?php echo get_template_directory_uri(); ?>/img/5.jpg' );">
                    <a href="recipe.html">
                        <header>
                            <h2>Recipe title</h2>
                        </header>
                        <div class="body">
                            Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident.
                        </div>
                    </a>
                </div>
            </div>

            <div class="swiper-pagination"></div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>

    <a name="#sharing"></a>
    <section class="sharing">
        <header>
            <a href="#sharing">
                <h2>Share this</h2>
            </a>
        </header>
        <div class="body">
            <a href="http://twitter.com" target="_blank" class="social-media twitter"><?php opensauce_render_image( 'twitter.svg', 'Twitter' ) ?></a>
            <a href="http://facebook.com" target="_blank" class="social-media facebook"><?php opensauce_render_image( 'facebook.svg', 'Facebook' ) ?></a>
            <a href="http://instagram.com" target="_blank" class="social-media instagram"><?php opensauce_render_image( 'instagram.svg', 'Instagram' ) ?></a>
            <a href="http://pinterest.com" target="_blank" class="social-media pinterest"><?php opensauce_render_image( 'pinterest.svg', 'Pinterest' ) ?></a>
        </div>
    </section>

<?php get_footer(); ?>
