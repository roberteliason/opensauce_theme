<?php
/**
 * The template for displaying all single posts.
 *
 * @package opensauce
 */

$post_type = get_post_type();

get_header(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php
            if ( !empty( $post_type ) ) {
                get_template_part( 'content', $post_type );
            } else {
                get_template_part( 'content', 'single' );
            }
        ?>

    <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
