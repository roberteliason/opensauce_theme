<?php
/**
 * @package opensauce
 */
$permalink = get_the_permalink();
$tags = Recipe_Functions::get()->get_recipe_tags( get_the_ID() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <section class="intro">
        <?php if( have_rows( 'images' ) ): ?>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php while( have_rows('images') ): the_row();
                    $image = get_sub_field( 'photo' );
                ?>
                <div class="swiper-slide" style="background-image: url( '<?php echo $image["url"]; ?>' );"></div>
                <?php endwhile; ?>
            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <?php endif; ?>

        <header>
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header>
        <div class="columns">
            <div class="body">
                <?php the_content(); ?>
            </div>
            <div class="meta">
                <?php if ( !empty( $tags ) ): ?>
                    <?php foreach( $tags as $tag ): ?>
                        <a href="/<?php echo $tag->taxonomy ?>/<?php echo $tag->slug ?>/"><tag><?php echo $tag->name ?></tag></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <div class="col-container">
        <?php if( have_rows( 'ingredients' ) ): ?>
        <a name="ingredients"></a>
        <section class="ingredients">
            <header>
                <a href="#ingredients">
                    <h2>Ingredients</h2>
                </a>
            </header>
            <div class="body">
                <table class="ingredients-table">
                    <thead>
                    <tr>
                        <th class="amount"><?php _e( 'Amount', 'opensauce' ) ?></th>
                        <th class="ingredient"><?php _e( 'Ingredient', 'opensauce' ) ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while( have_rows( 'ingredients' ) ): the_row();
                        $amount     = get_sub_field( 'amount' );
                        $unit       = get_sub_field( 'unit' );
                        $ingredient = get_sub_field( 'ingredient' );
                    ?>
                    <tr>
                        <td class="amount"><?php echo $amount ?>&nbsp;<?php echo $unit->name ?></td>
                        <td class="ingredient"><?php echo $ingredient ?></td>
                    </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <?php endif; ?>


        <?php if( have_rows( 'steps' ) ): ?>
        <a name="steps"></a>
        <section class="steps">
            <header>
                <a href="#steps">
                    <h2>Steps</h2>
                </a>
            </header>

            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                        $step = 1;
                        while( have_rows( 'steps' ) ): the_row();
                            $description = get_sub_field( 'description' );
                    ?>
                    <div class="swiper-slide">
						<div class="slide-container">
							<h3><?php _e( 'Step', 'opensauce' ) ?> <?php echo $step; ?></h3>
							<p><?php echo $description ?></p>
						</div>
                    </div>
                    <?php
                            $step++;
                        endwhile;
                    ?>
                </div>

                <div class="swiper-pagination"></div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </section>
        <?php endif; ?>
    </div>

    <a name="nonsense"></a>
    <section class="nonsense">
        <header>
            <a href="#nonsense">
                <h2>Nonsense</h2>
            </a>
        </header>
    </section>

    <a name="#sharing"></a>
    <section class="sharing">
        <header>
            <a href="#sharing">
                <h2>Share this</h2>
            </a>
        </header>
        <div class="body">
            <a href="https://twitter.com/home?status=<?php echo $permalink . ' via @opensauce_se' ?>" target="_blank" class="social-media twitter"><?php opensauce_render_image( 'twitter.svg', 'Twitter' ) ?></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink ?>" target="_blank" class="social-media facebook"><?php opensauce_render_image( 'facebook.svg', 'Facebook' ) ?></a>
	        <a href="<?php the_permalink(); ?>qr/" class="social-media qr-popup"><?php opensauce_render_image( 'qr.svg', 'QR' ) ?></a>
        </div>
    </section>

    <!--
	<footer class="entry-footer">
        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'opensauce' ),
            'after'  => '</div>',
        ) );
        ?>

        <?php opensauce_posted_on(); ?>
		<?php opensauce_entry_footer(); ?>
	</footer>
	-->
</article>