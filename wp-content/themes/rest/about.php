<?php
/**
* Template Name: Contact
*/

get_header(); ?>
<?php $options = get_theme_options(); ?>
	<div id="primary" class="content-area  top-margin-content clearfix">
		<div class="container about">
<?php
			 echo '<h1 class="title-page">' . get_the_title() . '</h1>'; ?>
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				<?php  echo do_shortcode(get_the_content()); ?>
	
			<?php endwhile; endif; ?>					 
			<?php 


			echo $options['iframe-maps']; ?>
			<br>
			<br>
			<br>
			<?php  echo $options['iframe-maps-two']; ?>
 		
 		</div>
	</div><!-- .content-area -->

<?php get_footer(); ?>							