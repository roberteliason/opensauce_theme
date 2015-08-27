<?php
/**
 * @package opensauce
 */
$permalink      = get_the_permalink();
$cats           = Recipe_Functions::get()->get_recipe_cats( get_the_ID() );
$tags           = Recipe_Functions::get()->get_recipe_tags( get_the_ID() );
$recipe_printer = new Recipe_Print;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemscope itemtype="http://schema.org/Recipe">
    <div class="intro">
        <?php if( have_rows( 'images' ) ): ?>
        <div class="slick-container">
            <div class="slick-wrapper">
                <?php while( have_rows('images') ): the_row();
                    $image = get_sub_field( 'photo' );
                ?>
                <div class="slick-slide" style="background-image: url( '<?php echo $image["url"]; ?>' );"></div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>

        <header>
            <?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
        </header>
        <div class="columns">
            <div class="body" itemprop="description">
                <?php the_content(); ?>
            </div>
            <div class="meta">
	            <div class="attributes">
	            <?php if( get_field( 'time' ) ): ?>
		            <?php _e( 'Total time', 'opensauce' ) ?>: <meta itemprop="totalTime" content="PT<?php echo( get_field( 'time' ) ) ?>M"><span class="time"><?php echo( get_field( 'time' ) ) ?> <?php _e( 'minutes', 'opensauce' ) ?></span><br />
	            <?php endif; ?>
	            <?php if( get_field( 'oven_temperature' ) ): ?>
		            <?php _e( 'Oven Temperature', 'opensauce' ) ?>: <span class="temperature"><?php echo( get_field( 'oven_temperature' ) ) ?> °C</span>
	            <?php endif; ?>
	            </div>
	            <?php if( get_field( 'time' ) || get_field( 'oven_temperature' ) ): ?>
	            <hr />
	            <?php endif; ?>
	            <div class="cats">
		            <?php if ( !empty( $cats ) ): ?>
			            <?php foreach( $cats as $cat ): ?>
				            <a href="/<?php echo $cat->taxonomy ?>/<?php echo $cat->slug ?>/"><span class="cat" itemprop="recipeCategory"><?php echo $cat->name ?></span></a>
			            <?php endforeach; ?>
		            <?php endif; ?>
	            </div>
	            <div class="tags">
		            <?php if ( !empty( $tags ) ): ?>
			            <?php foreach( $tags as $tag ): ?>
				            <a href="/<?php echo $tag->taxonomy ?>/<?php echo $tag->slug ?>/"><span class="tag"><?php echo $tag->name ?></span></a>
			            <?php endforeach; ?>
		            <?php endif; ?>
	            </div>
            </div>
        </div>
    </div>

    <div class="col-container">
        <?php if( have_rows( 'ingredients' ) ): ?>
        <a id="ingredients"></a>
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
                        $unit_name  = '';
                        if ( isset( $unit->name ) ) {
                            $unit_name = $unit->name;
                        }
                    ?>
                    <tr itemprop="recipeIngredient">
                        <td class="amount"><?php echo $amount ?>&nbsp;<?php echo $unit_name ?></td>
                        <td class="ingredient"><?php echo $ingredient ?></td>
                    </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="printable-qr-code">
	            <h3><?php _e( 'Scan to read this recipe online', 'opensauce' ) ?></h3>
                <?php $recipe_printer->printQRCode( false, 3 ); ?>
            </div>
        </section>
        <?php endif; ?>


        <?php if( have_rows( 'steps' ) ): ?>
        <a id="steps"></a>
        <section class="steps">
            <header>
                <a href="#steps">
                    <h2>Steps</h2>
                </a>
            </header>

            <div class="slick-container">
                <div class="slick-wrapper" itemprop="recipeInstructions">
                    <?php
                        $step = 1;
                        while( have_rows( 'steps' ) ): the_row();
                            $description = get_sub_field( 'description' );
                    ?>
                    <div class="slick-slide">
						<div class="slide-container">
							<h3><?php _e( 'Step', 'opensauce' ) ?> <?php echo $step; ?></h3>
							<?php echo $description ?>
						</div>
                    </div>
                    <?php
                            $step++;
                        endwhile;
                    ?>
                </div>
            </div>

            <div class="printable-steps">
                <?php
                $step = 1;
                while( have_rows( 'steps' ) ): the_row();
                    $description = get_sub_field( 'description' );
                    ?>
                    <div class="printable-step">
                        <h3><?php _e( 'Step', 'opensauce' ) ?> <?php echo $step; ?></h3>
                        <?php echo $description ?>
                    </div>
                    <?php
                    $step++;
                endwhile;
                ?>
            </div>
        </section>
        <?php endif; ?>
    </div>

	<?php if( have_rows( 'fun_facts' ) ): ?>
    <a id="nonsense"></a>
    <section class="nonsense">
        <header>
            <a href="#nonsense">
                <h2>Nonsense</h2>
            </a>
        </header>
	    <div class="content">
		    <?php while( the_flexible_field( 'fun_facts' ) ): ?>

			    <?php if( get_row_layout() == 'factoids' ): ?>

				    <div class="factoid">
					    <div class="inner">
						    <h4><?php the_sub_field( 'label' ) ?></h4>
						    <p><?php the_sub_field( 'text' ) ?></p>
					    </div>
				    </div>

			    <?php endif ;?>

			    <?php if( get_row_layout() == 'gauges' ): ?>

				    <div class="gauge" data-value="<?php the_sub_field( 'value' ) ?>">
						<div class="inner">
							<?php opensauce_render_svg( 'gauge.svg' ) ?>
							<strong><?php the_sub_field( 'label' ) ?></strong>
						</div>
				    </div>

			    <?php endif ;?>

			    <?php if( get_row_layout() == 'ratings' ): ?>

				    <div class="rating">
					    <div class="inner">
						    <div class="icons">
							    <?php
							    $rating     = (int) get_sub_field( 'number' );
							    $max_rating = (int) get_sub_field( 'max_number' );
							    $icon       = get_sub_field( 'icon' );
							    ?>
							    <?php for( $i = 1; $i < $max_rating+1; $i++ ): ?>
								    <?php
								    $active = 'active';
								    if ( $i > $rating ) {
									    $active = '';
								    }
								    ?>
								    <div class="icon-holder <?php echo $active ?>">
									    <?php opensauce_render_image( 'chili_pepper.png', $icon ) ?>
								    </div>
							    <?php endfor; ?>
						    </div>
						    <blockquote>
							    <?php the_sub_field( 'text' ) ?>
						    </blockquote>
					    </div>
				    </div>

			    <?php endif ;?>

		    <?php endwhile; ?>
	    </div>
    </section>
	<?php endif; ?>

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
                <a href="<?php the_permalink(); ?>qr/" class="social-media qr-popup"><?php opensauce_render_image( 'qr.svg', 'QR' ) ?></a>
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