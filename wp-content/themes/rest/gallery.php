<?php
/**
* Template Name: Gallery
*/

get_header(); ?>
	<div id="primary" class="content-area  top-margin-content clearfix">
		<div class="container gallery clearfix">
<?php
			 echo '<h1 class="title-gallery">' . get_the_title() . '</h1>'; ?>
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<?php the_content(); ?>
	
			<?php endwhile; endif; ?>					 
			 
 		</div>
	</div><!-- .content-area -->

<?php get_footer(); ?>							