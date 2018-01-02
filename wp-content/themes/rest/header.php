<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	  
	<header id="masthead" class="site-header" >

			<?php  if (  is_home() ){ ?>

				<div class="header-bg">


					<div class="header-content">

						<a href="#" class="header-link">

							Ресторан<br> Сандро

						</a>

						<h1>Классика грузинской кухни</h1>
						<p>Наши повара работают<br> до последнего клиента.<br> Для тех кто никуда не спешит, и любит проводить время со вкусом и удовольствием</p>
							<a href="#" class="button-about">О РЕСТОРАНЕ</a>
					
						<ul class="menu-bottom">
							<li class="wow fadeInUp" data-wow-offset="-300" data-wow-delay="0.4s" ><a href="#"><i class="gk-icon-dinner-set-solid" ></i><span>Блюда</span></a></li>
							<li class="wow fadeInUp" data-wow-offset="-300"  data-wow-delay="0.6s"><a href="#"><i class="gk-icon-bottle-glass-solid"></i><span>Напитки</span></a></li>
							<li class="wow fadeInUp" data-wow-offset="-300"    data-wow-delay="0.8s"><a href="#"><i class="gk-icon-calendar-solid"></i><span>On-line заказ</span></a></li>
							<li class="wow fadeInUp" data-wow-offset="-300"    data-wow-delay="1s"><a href="#"><i class="gk-icon-map-path-solid"></i><span>Контакты</span></a></li>
						</ul>	

					</div>


				</div>
				<div class="hide-header">
					<div class="container">
						<div class="walpaper-header">
							<div class="left-menu">
								<?php wp_nav_menu('menu_class=bmenu&theme_location=left_menu'); ?>
							</div>
							<div class="logo"><img  src="<?php bloginfo('template_directory');?>/images/logo.png" /></div>
							<div class="right-meenu">
		 						<?php wp_nav_menu('menu_class=bmenu&theme_location=right_menu');   ?>
							</div>
						</div>
					</div>


				</div>

			<?php  }else{ ?>

				<div class="hide-header other-pages">
					<div class="container">
						<div class="walpaper-header">
							<div class="left-menu">
								<?php wp_nav_menu('menu_class=bmenu&theme_location=left_menu'); ?>
							</div>
							<div class="logo"><img  src="<?php bloginfo('template_directory');?>/images/logo.png" /></div>
							<div class="right-meenu">
		 						<?php wp_nav_menu('menu_class=bmenu&theme_location=right_menu');   ?>
							</div>
						</div>
					</div>


				</div>


			<?php }  



    	 


			?>		 
		 
			 		
	</header><!-- .site-header -->
 

	<div id="content" class="site-content">
