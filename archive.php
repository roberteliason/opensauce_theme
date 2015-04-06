<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package opensauce
 */

get_header(); ?>

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <section class="teasers">
            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php
                    get_template_part( 'teaser', get_post_type() );
                ?>

            <?php endwhile; ?>
        </section>

        <?php the_posts_navigation(); ?>

    <?php else : ?>

        <?php get_template_part( 'content', 'none' ); ?>

    <?php endif; ?>

<?php get_sidebar( 'sidebar' ); ?>
<?php get_footer(); ?>
