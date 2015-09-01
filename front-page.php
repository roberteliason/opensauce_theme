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

get_header();
$permalink = get_the_permalink();

?>

	<?php opensauce_maybe_cache_output( 'frontpage_slider', 'opensauce_render_frontpage_slider', 600 ); ?>

	<div class="page-content">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php opensauce_maybe_cache_output( 'frontpage_sidebar', 'opensauce_render_frontpage_sidebar', 600 ); ?>
	</div>

    <div class="social">
        <a id="#sharing"></a>
        <section class="sharing">
            <header>
                <a href="#sharing">
                    <h2>Sharing is caring!</h2>
                </a>
            </header>
            <div class="body">
                <a href="https://twitter.com/home?status=<?php echo $permalink . '%20via%20%40opensauce_se' ?>" target="_blank" class="social-media twitter"><?php opensauce_render_image( 'twitter.svg', 'Twitter' ) ?></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink ?>" target="_blank" class="social-media facebook"><?php opensauce_render_image( 'facebook.svg', 'Facebook' ) ?></a>
            </div>
        </section>

        <a id="#follow"></a>
        <section class="follow">
            <header>
                <a href="#follow">
                    <h2>Follow Open Sauce</h2>
                </a>
            </header>
            <div class="body">
                <a href="https://twitter.com/opensauce_se" target="_blank" class="social-media twitter"><?php opensauce_render_image( 'twitter.svg', 'Twitter' ) ?></a>
                <a href="https://www.facebook.com/opensaucese" target="_blank" class="social-media facebook"><?php opensauce_render_image( 'facebook.svg', 'Facebook' ) ?></a>
            </div>
        </section>
    </div>

<?php get_footer(); ?>
