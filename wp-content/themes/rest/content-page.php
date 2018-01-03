<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<?php $options = get_theme_options(); ?>
	<div id="primary" class="content-area clearfix">
		<div class="container">
			
			<div class="main-text"> 
				<?php 	
				while ( have_posts() ) : the_post();
 
			  the_content();  

			 
			endwhile; ?>		 	 
		 	</div>

		</div> 		
	</div><!-- .content-area -->

<?php get_footer(); ?>
