<?php
/**
 * @package opensauce
 */
$permalink = get_the_permalink();
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'teaser' );
?>

<a href="<?php echo $permalink ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'teaser' ); ?>>
        <?php if( has_post_thumbnail( get_the_ID() ) ): ?>
        <div class="image" style="background-image: url( '<?php echo $thumbnail[0] ?>' );"></div>
        <?php endif; ?>
        <header class="teaser-header">
            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
        </header>
        <div class="excerpt">
            <?php the_excerpt(); ?>
        </div>
    </article>
</a>