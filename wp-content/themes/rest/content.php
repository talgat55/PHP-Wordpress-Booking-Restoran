<?php
/**
* Template Name: Menu
*/
get_header(); ?>
			<div class="cart-header">
				<div>Товаров в корзине:<span class="cart-count"></span></div>
				<div>На сумму:<span class="cart-summ"></span> руб.</div>
				<div class="cart-bottom">
					<span class="butt-cart order" style="margin-right:9px;">Оформить заказ</span>
					<span class="butt-cart clear">Очистить корзину</span>


			</div>

				</div>
				<div class="block-order">
						<div class="close-order-panel">✖</div>
					
					<div class="container top-margin-content clearfix">
						<h1 class="title-menu-list"> Оформление заказа</h1>
							<div class="preloader">
								<div class="spinner">
								  <div class="double-bounce1"></div>
								  <div class="double-bounce2"></div>
								</div>
								<p class="preloader-text">Ждите идет  загрузка товаров</p>
							</div>
							<div class="preloader wait-insert">
								<div class="spinner">
								  <div class="double-bounce1"></div>
								  <div class="double-bounce2"></div>
								</div>
								<p class="preloader-text">Ждите идет  запись вашего заказа</p>
							</div>


						<div class="result"></div>
					</div>
				</div>
	<div id="primary" class="content-area  top-margin-content clearfix">
		<div class="container menu-list clearfix">
			<script>
			jQuery(document).ready(function(){


				var array = [];
				var prsummes =0 ;

				jQuery('.card-value').click(function(){ 
						var $this = jQuery('.cart-header');
					if( !$this.hasClass('show-cart') ){

							$this.addClass('show-cart');
 
					} 


  				var order      = jQuery(this).attr('data-order');
  				var pricevalue = jQuery(this).parent().parent().find('.price-value').text();
  				 
  					array.push(order);
  					jQuery('.cart-count').empty();
					jQuery('.cart-count').append(array.length);
					summes = jQuery('.cart-summ').text();
					jQuery('.cart-summ').empty();

					jQuery('.cart-summ').append(Number(summes)+Number(pricevalue));

						console.log(array);
/*
                          var data = {

                            action: 'pushorder',
                          
                            value: order 
 
                          
                          }; 
                          
                          jQuery.post( '/wp-admin/admin-ajax.php', data, function(response) { 
                          		 	alert();
                          		jQuery('.result').append(response);
                          });

*/

          	  	});
				jQuery('.butt-cart.clear').click(function(){ 
						array= [];
						console.log(array);
						jQuery('.cart-count').empty();
						jQuery('.cart-summ').empty();
				});
				jQuery('.butt-cart.order').click(function(){ 
						var $this = jQuery('.block-order');
					if( !$this.hasClass('show-order') ){

							$this.addClass('show-order');
 
					}

                          var data = {

                            action: 'pushorder',
                          
                            value: array 
 
                          
                          }; 
                          
                          jQuery.post( '/wp-admin/admin-ajax.php', data, function(response) { 
                          		jQuery('.preloader').fadeOut(500);
                          		jQuery('.result').delay(500).append(response);
                          });




           		});

				/*
				* close order panel
				*/
					jQuery('.close-order-panel').click(function(){ 
										jQuery('.block-order').removeClass('show-order'); 
										var result = jQuery('.result');
										result.delay(400).empty();

										jQuery('.preloader').fadeIn(500);
										jQuery('.preloader.wait-insert').fadeOut(500);

					});



            });

			</script> 
<?php
	
			 echo '<h1 class="title-menu-list">' . get_the_title() . '</h1>'; ?>
			
			<?php   


							$args = array(
								'post_type'        => 'menu'
								);
							$the_query = new WP_Query($args);

							while( $the_query->have_posts() ) :
								$the_query->the_post();
								$post_id = $the_query->post->ID;
								$terms = get_the_terms( $post_id, 'category');
								if ( $terms && ! is_wp_error( $terms ) ) {
									foreach ( $terms as $term ) {
										$filter_array[$term->name] = $term;
									}
								}
							endwhile;

				foreach ($filter_array as $key => $value) { 

					 echo '<h1 class="title-name-menu">' . $value->name . '</h1>';
					 		echo "<table>";
					 		echo "
					 			<tr>
					 				<td>Фото</td>
					 				<td>Название</td>
					 				<td>Вес,<br>гр.</td>
					 				<td>Цена, <br>руб</td>
					 				<td> </td>

					 			</tr>";
							while( $the_query->have_posts() ) :
								$thumb   = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url( $thumb,'full');
								$the_query->the_post();
								$post_id = $the_query->post->ID;
							 
								$categories = get_the_category($post_id);
								 
							
									if($value->name == $categories[0]->cat_name ){
										echo "<tr>";
											echo '<th style="width:220px;" ><img src="'.$img_url.'"></th>';
											echo '<th style="width:540px; text-align:left;">'.get_the_title($post_id).'</th>';
											echo '<th>'.get_post_meta($post_id , 'my_meta_weight', true).'</th>';

											echo '<th class="price-value">'.get_post_meta($post_id, 'my_meta_price', true).'</th>';
											echo '<th class="col-add-cart"> <span class="card-value " data-order="'.$post_id.'">В корзину</span></th>';
										 
										echo "</tr>";
									}
								 
							
							endwhile;
							echo "</table>";
				}					



 
			?>					 
			 
 		</div>
	</div><!-- .content-area -->
 
<?php get_footer(); ?>							