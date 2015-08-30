<?php
/**
 * @package opensauce
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemscope itemtype="http://schema.org/Recipe">
    <div class="intro">

	    <?php opensauce_maybe_cache_output( 'recipe_'.get_the_ID().'_image_slider' , 'opensauce_render_recipe_image_slider', HOUR_IN_SECONDS ); ?>

        <header>
            <?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
        </header>
        <div class="columns">

	        <?php opensauce_maybe_cache_output( 'recipe_'.get_the_ID().'_body' , 'opensauce_render_recipe_body', HOUR_IN_SECONDS ); ?>
	        <?php opensauce_maybe_cache_output( 'recipe_'.get_the_ID().'_meta' , 'opensauce_render_recipe_meta', HOUR_IN_SECONDS ); ?>

        </div>
    </div>

    <div class="col-container">
	    <?php opensauce_maybe_cache_output( 'recipe_'.get_the_ID().'_ingredients' , 'opensauce_render_recipe_ingredients', HOUR_IN_SECONDS ); ?>
	    <?php opensauce_maybe_cache_output( 'recipe_'.get_the_ID().'_steps' , 'opensauce_render_recipe_steps', HOUR_IN_SECONDS ); ?>
    </div>

	<?php opensauce_maybe_cache_output( 'recipe_'.get_the_ID().'_nonsense' , 'opensauce_render_recipe_nonsense', HOUR_IN_SECONDS ); ?>
	<?php opensauce_maybe_cache_output( 'recipe_'.get_the_ID().'_social' , 'opensauce_render_recipe_social', HOUR_IN_SECONDS ); ?>

</article>