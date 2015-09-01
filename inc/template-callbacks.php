<?php


/**
 * Callback for rendering the front page recipe slider
 *
 * @return string
 */
function opensauce_render_frontpage_slider() {

	$latest = Recipe_Functions::get()->get_latest();

	if ( false !== $latest ) :
		ob_start();

		?>
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
	<?php endif;

	return ob_get_clean();
}


/**
 * Render the front page widget area
 *
 * @return string
 */
function opensauce_render_frontpage_sidebar() {

	ob_start();
	?>
	<div class="widget-area">
		<?php dynamic_sidebar( 'frontpage' ); ?>
	</div>
	<?php

	return ob_get_clean();
}


/**
 * Render the main menu
 *
 * @return string
 */
function opensauce_render_main_menu() {

	ob_start();

	wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'menu_class'      => 'navigation-menu show',
			'menu_id'         => 'js-navigation-menu',
			'container'       => 'nav',
			'container_class' => 'navigation',
			'walker'          => new Opensauce_Nav_Walker
		)
	);

	return ob_get_clean();
}


/**
 * Render the image slider for a recipe
 *
 * @return string
 */
function opensauce_render_recipe_image_slider() {

	if( false === function_exists( 'papi_get_field' ) ) { return ''; }

	ob_start();

	$images = papi_get_field( 'recipe_images' );

	if( false === empty( $images ) ): ?>
		<div class="slick-container">
			<div class="slick-wrapper">
				<?php foreach( $images as $image ) : ?>
					<div class="slick-slide" style="background-image: url( '<?php echo $image->url ?>' );"></div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif;

	return ob_get_clean();
}


/**
 * Render the recipe body
 *
 * @return string
 */
function opensauce_render_recipe_body() {

	ob_start(); ?>

	<div class="body" itemprop="description">
		<?php the_content(); ?>
	</div>

	<?php return ob_get_clean();
}


/**
 * Render recipe meta
 *
 * @return string
 */
function opensauce_render_recipe_meta() {

	if( false === function_exists( 'papi_get_field' ) ) { return ''; }

	$cats = Recipe_Functions::get()->get_recipe_cats( get_the_ID() );
	$tags = Recipe_Functions::get()->get_recipe_tags( get_the_ID() );

	$total_time = papi_get_field( 'recipe_total_time' );
	$oven_temp  = papi_get_field( 'recipe_oven_temp' );

	ob_start(); ?>

	<div class="meta">
        <div class="attributes">
        <?php if( false === empty( $total_time ) ): ?>
		<?php _e( 'Total time', 'opensauce' ) ?>: <meta itemprop="totalTime" content="PT<?php echo $total_time ?>M"><span class="time"><?php echo $total_time ?> <?php _e( 'minutes', 'opensauce' ) ?></span><br />
		<?php endif; ?>
		<?php if( false === empty( $oven_temp ) ): ?>
		<?php _e( 'Oven Temperature', 'opensauce' ) ?>: <span class="temperature"><?php echo $oven_temp ?> °C</span>
		<?php endif; ?>
		</div>
		<?php if( false === empty( $total_time ) || false === empty( $oven_temp ) ): ?>
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
		<hr />
		<div class="author" itemscope itemprop="author" itemtype="http://schema.org/Person"><?php _e( 'by', 'opensauce' ) ?>: <span itemprop="name"><?php the_author() ?></span></div>
		<div class="date-modified" itemprop=“dateModified”><?php _e( 'Last updated on', 'opensauce' ) ?>: <?php the_modified_date( 'Y-m-d' ) ?></div>

	</div>

	<?php return ob_get_clean();
}


function opensauce_render_recipe_ingredients() {

	if( false === function_exists( 'papi_get_field' ) ) { return ''; }

	ob_start();

	$ingredients      = papi_get_field( 'recipe_ingredients' );
	$recipe_page_type = new Recipe_Page_Type;
	$units            = array_flip( $recipe_page_type->get_recipe_units() );

	if( false === empty( $ingredients ) ): ?>
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
					<?php foreach( $ingredients as $ingredient ) :

						$amount = ( isset( $ingredient[ 'ingredient_amount' ] ) ? $ingredient[ 'ingredient_amount' ] : '' );
						$unit   = ( isset( $ingredient[ 'ingredient_unit' ] ) ? $units[ $ingredient[ 'ingredient_unit' ] ] : '' );
						$name   = ( isset( $ingredient[ 'ingredient_name' ] ) ? $ingredient[ 'ingredient_name' ] : '' );
						?>
						<tr itemprop="recipeIngredient">
							<td class="amount"><?php echo $amount ?>&nbsp;<?php echo $unit ?></td>
							<td class="ingredient"><?php echo $name ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</section>
	<?php endif;

	return ob_get_clean();
}


/**
 * Render the recipe steps
 *
 * @return string
 */
function opensauce_render_recipe_steps() {

	if( false === function_exists( 'papi_get_field' ) ) { return ''; }

	ob_start();

	$steps = papi_get_field( 'recipe_steps' );

	if( false === empty( $steps ) ): ?>
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
					$step_no = 1;
					foreach( $steps as $step ) :
						$description = ( isset( $step['recipe_step'] ) ? $step['recipe_step'] : '' );
						?>
						<div class="slick-slide">
							<div class="slide-container">
								<span class="step-header"><?php _e( 'Step', 'opensauce' ) ?> <?php echo $step_no; ?></span>
								<?php echo $description ?>
							</div>
						</div>
						<?php
						$step_no++;
					endforeach;
					?>
				</div>
			</div>

			<div class="printable-steps">
				<?php
				$step_no = 1;
				foreach( $steps as $step ) :
					$description = ( isset( $step['recipe_step'] ) ? $step['recipe_step'] : '' );
					?>
					<div class="printable-step">
						<h3><?php _e( 'Step', 'opensauce' ) ?> <?php echo $step_no; ?></h3>
						<?php echo $description ?>
					</div>
					<?php
					$step_no++;
				endforeach;
				?>
			</div>
		</section>
	<?php endif;

	return ob_get_clean();
}


/**
 * Render the nonsense
 *
 * @return string
 */
function opensauce_render_recipe_nonsense() {

	if( false === function_exists( 'papi_get_field' ) ) { return ''; }

	ob_start();

	$nonsense = papi_get_field( 'recipe_nonsense' );

	if( false === empty( $nonsense ) ): ?>
		<a id="nonsense"></a>
		<section class="nonsense">
			<header>
				<a href="#nonsense">
					<h2>Nonsense</h2>
				</a>
			</header>
			<div class="content">
				<?php foreach( $nonsense as $drivel ) :
					$layout = ( isset( $drivel[ '_layout' ] ) ? $drivel[ '_layout' ] : '' );
				?>
					<?php if( 'factoid' == $layout ):
						$title = ( isset( $drivel[ 'factoid_title' ] ) ? $drivel[ 'factoid_title' ] : '' );
						$text  = ( isset( $drivel[ 'factoid_text' ] ) ? $drivel[ 'factoid_text' ] : '' );
					?>
						<div class="factoid">
							<div class="inner">
								<h4><?php echo $title ?></h4>
								<p><?php echo $text ?></p>
							</div>
						</div>

					<?php endif ;?>

					<?php if( 'gauge' == $layout ):
						$label = ( isset( $drivel[ 'gauge_label' ] ) ? $drivel[ 'gauge_label' ] : '' );
						$value = ( isset( $drivel[ 'gauge_value' ] ) ? $drivel[ 'gauge_value' ] : '' );
					?>

						<div class="gauge" data-value="<?php echo $value ?>">
							<div class="inner">
								<?php opensauce_render_svg( 'gauge.svg' ) ?>
								<strong><?php echo $label ?></strong>
							</div>
						</div>

					<?php endif ;?>

					<?php if( 'rating' == $layout ):
						$max_value  = ( isset( $drivel[ 'rating_max_value' ] ) ? (int) $drivel[ 'rating_max_value' ] : '' );
						$value      = ( isset( $drivel[ 'rating_value' ] ) ? (int) $drivel[ 'rating_value' ] : '' );
						$motivation = ( isset( $drivel[ 'rating_motivation' ] ) ? $drivel[ 'rating_motivation' ] : '' );
						$icon       = '';
					?>

						<div class="rating">
							<div class="inner">
								<div class="icons">
									<?php for( $i = 1; $i < $max_value+1; $i++ ): ?>
										<?php
										$active = 'active';
										if ( $i > $value ) {
											$active = '';
										}
										?>
										<div class="icon-holder <?php echo $active ?>">
											<?php opensauce_render_image( 'chili_pepper.png', $icon ) ?>
										</div>
									<?php endfor; ?>
								</div>
								<blockquote>
									<?php echo $motivation ?>
								</blockquote>
							</div>
						</div>

					<?php endif ;?>

				<?php endforeach; ?>
			</div>
		</section>
	<?php endif;

	return ob_get_clean();
}


/**
 * Render social links for a recipe
 *
 * @return string
 */
function opensauce_render_recipe_social() {

	$permalink      = get_the_permalink();

	ob_start(); ?>

	<div class="social">
		<a id="#sharing"></a>
		<section class="sharing">
			<header>
				<a href="#sharing">
					<h2>Share this recipe</h2>
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
					<h2>Follow Open Sauce</h2>
				</a>
			</header>
			<div class="body">
				<a href="https://twitter.com/opensauce_se" target="_blank" class="social-media twitter"><?php opensauce_render_image( 'twitter.svg', 'Twitter' ) ?></a>
				<a href="https://www.facebook.com/opensaucese" target="_blank" class="social-media facebook"><?php opensauce_render_image( 'facebook.svg', 'Facebook' ) ?></a>
			</div>
		</section>
	</div>

	<?php return ob_get_clean();
}