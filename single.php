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

        <?php the_post_navigation(); ?>

        <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        ?>

    <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
