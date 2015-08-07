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

$latest = Recipe_Functions::get()->get_latest();
?>

    <?php if ( false !== $latest ) : ?>
    <div class="latest">

        <div class="slick-container">
            <ul class="slick-wrapper">
                <?php
                foreach( $latest as $recipe ):
                    $title     = $recipe->post_title;
                    $link      = get_the_permalink( $recipe->ID );
                    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $recipe->ID ), 'large' );
                    $excerpt   = $recipe->post_excerpt;
                    ?>
                    <li class="slick-slide" style="background-image: url( '<?php echo $thumbnail[0] ?>' );">
                        <a href="<?php echo $link ?>">
                            <div class="content">
                                <header>
                                    <h2><?php echo $title ?></h2>
                                </header>
                                <div class="body">
                                    <?php echo $excerpt ?>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
    <?php endif; ?>

	<div class="page-content">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile; // end of the loop. ?>

		<div class="widget-area">
			<?php dynamic_sidebar( 'frontpage' ); ?>
		</div>
	</div>

    <div class="social">
        <a id="#sharing"></a>
        <section class="sharing">
            <header>
                <a href="#sharing">
                    <h2>Share this</h2>
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
                    <h2>Follow us</h2>
                </a>
            </header>
            <div class="body">
                <a href="https://twitter.com/opensauce_se" target="_blank" class="social-media twitter"><?php opensauce_render_image( 'twitter.svg', 'Twitter' ) ?></a>
                <a href="https://www.facebook.com/opensaucese" target="_blank" class="social-media facebook"><?php opensauce_render_image( 'facebook.svg', 'Facebook' ) ?></a>
            </div>
        </section>
    </div>

<?php get_footer(); ?>
