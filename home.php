<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="blog-area">
		<main id="main" class="blog-main" role="main">

			<?php


				do_action( 'storefront_page_before' ); 
				
				while ( have_posts() ) :
				the_post();
				endwhile; // End of the loop.
/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

		
?>
			<?php echo '<h1> <a class = "titleblog" </a>Blog</h1>' ?>
				
				<?php echo do_shortcode("[pt_view id=395b525c7h]"); ?>
	
				

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();