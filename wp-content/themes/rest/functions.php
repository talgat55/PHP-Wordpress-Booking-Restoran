<?php
 
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}
add_theme_support( 'post-thumbnails' );
/*
* Admin 
*/ 

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/redux/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/redux/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/redux/options-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/redux/options-config.php' );
}


/*
* meta box
*/
 

 
include_once('includes/meta-box/meta-box.php');


if (!function_exists('script')) {
    
    function script() {  
		wp_enqueue_style( ' style', get_stylesheet_uri() );
 		wp_enqueue_script("script", get_template_directory_uri() ."/js/script.js",array(),false,true);    
 		wp_enqueue_script("jquery", get_template_directory_uri() ."/js/jquery.js",array(),false,true);       
        wp_enqueue_script("jquery.appear", get_template_directory_uri() ."/js/jquery.appear.js",array(),false,true);    
     
    } 

} 

add_action('wp_enqueue_scripts', 'script');

if ( function_exists( 'register_nav_menus' ) ) {

 
		$menu_arr = array(
		  'left_menu' => 'Левое Меню',
		  'right_menu' => 'Правое Меню'
		);
	 
	
	register_nav_menus($menu_arr);
}	


function get_theme_options() {
 
	$current_options = get_option('redux');

	 
		return $current_options;
	 
}

	  
add_action( 'init', 'post_type_main_menu' );  
 
function post_type_main_menu() {
	$labels = array(
		'name' => 'Меню',
		'singular_name' => 'Меню',  
		'add_new' => 'Добавить Меню',
		'add_new_item' => 'Добавить Блюдо', // заголовок тега <title>
		'edit_item' => 'Редактировать Блюдо',
		'new_item' => 'Новое Блюдо',
		'all_items' => 'Меню',  
		'menu_name' => 'Меню' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true, // благодаря этому некоторые параметры можно пропустить
		'menu_icon' => 'dashicons-cart', // иконка корзины
		'menu_position' => 5,
		'has_archive' => true,
		'query_var' => "menu",
		'supports'  => array(
						'title',
						'editor',
						'thumbnail'
		),
		'taxonomies' => array('category')
	);
	register_post_type('menu',$args);
} 


/*
*  First Rest
*/
if ( current_user_can( 'first_order' )   OR current_user_can( 'administrator' )  )  {
add_action( 'admin_menu', 'first_order' );
 
function first_order() {
	add_menu_page( 'Заказы Первого ресторана', 'Заказы Первого ресторана', 'administrator', 'my-unique-identifier', 'first_order_options' );
}
 
function first_order_options() {
	global $wpdb;
	$table_name = $wpdb->prefix . "orderlist";
	$table_name2 = $wpdb->prefix . "order";
	$results = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE restoran ='one'");
	$resultsorder = $wpdb->get_results("SELECT * FROM ".$table_name2." ");
	echo ' <div class="wrap">';
	echo ' <table  style="width:100%; background: #fff;
    padding: 10px;">';
					 		echo "
					 			<tr>
					 				<td style='    width: 90px;'>Дата</td>
					 				<td  style='    width: 200px;'>ФИО</td>
					 				<td>Наименование блюда</td>
					 				<td>Цена</td>

					 			</tr>";
					 			foreach ($results as $key => $value) {
					 				echo "
							 			<tr>
							 				<th style='border-bottom: 1px solid #eee;'>".$value->date."</th>
							 				<td  style='border-bottom: 1px solid #eee;'>".$value->fio."</td>
							 				<td  style='border-bottom: 1px solid #eee; padding: 10px;'>";
							 		foreach ($resultsorder as $key2 => $value2) {
							 			if($value->id ==  $value2->current ){
 
							 				  		echo $value2->name.'<br>';
							 				 

							 			}

							 		}
									echo "
							 				</td>
							 				<td  style='border-bottom: 1px solid #eee;'>";
							 				$price = 0;
							 		foreach ($resultsorder as $key2 => $value2) {
							 			if($value->id ==  $value2->current ){


							 				$price += ($value2->price * $value2->quant);
							 				 
							 			}

							 		}
							 		echo $price;
									echo
							 				"</td>

							 			</tr>";
					 			}



	echo ' </table>';
 	echo '</div> ';
}

}
/*
*  Second Rest
*/
if ( current_user_can( 'two_order' )   OR current_user_can( 'administrator' )  )  {
add_action( 'admin_menu', 'two_order' );
 
function two_order() {
	add_menu_page( 'Заказы Второго ресторана', 'Заказы Второго ресторана', 'administrator', 'my-unique-identifier2', 'two_order_options' );
}
 
function two_order_options() {
	global $wpdb;
	$table_name = $wpdb->prefix . "orderlist";
	$table_name2 = $wpdb->prefix . "order";
	$results = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE restoran ='two'");
	$resultsorder = $wpdb->get_results("SELECT * FROM ".$table_name2." ");
	echo ' <div class="wrap">';
	echo ' <table  style="width:100%; background: #fff;
    padding: 10px;">';
					 		echo "
					 			<tr>
					 				<td style='    width: 90px;'>Дата</td>
					 				<td  style='    width: 200px;'>ФИО</td>
					 				<td>Наименование блюда</td>
					 				<td>Цена</td>

					 			</tr>";
					 			foreach ($results as $key => $value) {
					 				echo "
							 			<tr>
							 				<th style='border-bottom: 1px solid #eee;'>".$value->date."</th>
							 				<td  style='border-bottom: 1px solid #eee;'>".$value->fio."</td>
							 				<td  style='border-bottom: 1px solid #eee; padding: 10px;'>";
							 		foreach ($resultsorder as $key2 => $value2) {
							 			if($value->id ==  $value2->current ){
 
							 				  		echo $value2->name.'<br>';
							 				 

							 			}

							 		}
									echo "
							 				</td>
							 				<td  style='border-bottom: 1px solid #eee;'>";
							 				$price = 0;
							 		foreach ($resultsorder as $key2 => $value2) {
							 			if($value->id ==  $value2->current ){


							 				$price += ($value2->price * $value2->quant);
							 				 
							 			}

							 		}
							 		echo $price;
									echo
							 				"</td>

							 			</tr>";
					 			}



	echo ' </table>';
 	echo '</div> ';
}

}
/*
* Add Roles
*/

$result = add_role( 'first_order', __(
'Первый ресторан' ),
array( ) );
$result = add_role( 'two_order', __(
'Второй ресторан' ),
array( ) );

/*
add_action( 'after_setup_theme', 'create_tables' );
function create_tables ()
{
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	$table_name = $wpdb->prefix . "order";
	if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {


		$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

	$sql = "CREATE TABLE {$table_name} (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  namemenu text,
	  pricevalue text,
	  UNIQUE KEY id (id)  
	   
	)
	{$charset_collate};";




		dbDelta($sql);

		 

	}
}

*/


/*
*  Order
*/
/*
add_action('wp_ajax_nopriv_ordertrue', 'ordertrue_callback');
function ordertrue_callback() {


}*/

add_action('wp_ajax_nopriv_pushorder', 'pushorder_callback');
function pushorder_callback() {
$order = $_POST['value'];

	$args = array(
		'post_type'        => 'menu'
	);
	$the_query = new WP_Query($args);
		echo "<table class='order-ship'>";
		echo '<tr>
					 				<td>Фото</td>
					 				<td>Название</td> 
					 				<td>Цена, <br>руб</td>
					 				<td>Количество</td>

					 			</tr>';
  	foreach ($order as $key => $value) {
  	 	while( $the_query->have_posts() ) :	

		$the_query->the_post();
		$post_id = $the_query->post->ID;
								$thumb   = get_post_thumbnail_id($post_id);
								$img_url = wp_get_attachment_url( $thumb,'full');

		if($post_id == $value){
								
										echo "<tr>";
											echo '<th style="width:220px;" ><img src="'.$img_url.'"></th>';
											echo '<th class="price-name" style="width:540px; text-align:left;">'.get_the_title($post_id).'</th>'; 
											echo '<th class="price-value">'.get_post_meta($post_id, 'my_meta_price', true).'</th>'; 
											echo "<th  class='align-left'>
    											<input type='button' value='-' class='qtyminus' field='quantity' />
											    <input type='text' name='quantity' value='1' class='qty' />
											    <input type='button' value='+' class='qtyplus' field='quantity' />

											</th>"; 
										 
										echo "</tr>";

										$pricesummm += get_post_meta($post_id, 'my_meta_price', true);

		}

		endwhile;
		
  	}

										echo "
<script>
jQuery(document).ready(function(){
/*
* cart quantic
*/



    jQuery('.qtyplus').click(function(e){
        // Stop acting like a button
        	 
        e.preventDefault(); 
        var classinput = jQuery(this).parent().find('.qty');
        var currentVal = parseInt(classinput.val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
           classinput.val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
           classinput.val(0);
        }
    });
    // This button will decrement the value till 0
    jQuery('.qtyminus').click(function(e) {
    	 
        // Stop acting like a button
        e.preventDefault();
        var classinput = jQuery(this).parent().find('.qty');
        // Get its current value
        var currentVal = parseInt(classinput.val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            classinput.val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            classinput.val(0);
        }
    });

				jQuery('.order-true').click(function(){ 
					 	
					 	var redymassive = [];
 
						jQuery('.order-ship tr').each(function() {
							 var redymassiveitem = {};
								var currentname = jQuery(this).find('.price-name').text();

								var currentquant = jQuery(this).find('.qty').val();
								var currentprice = jQuery(this).find('.price-value').text();
								redymassiveitem['name'] = currentname;
								redymassiveitem['price'] = currentprice;
								redymassiveitem['quant'] = currentquant;
							 
								redymassive.push(redymassiveitem);

						});
						var fioorder= jQuery( '.fio-order').val();
						var rerstoranorder= jQuery( '.choose-restoran').val();


 
                          var data = {

                            action: 'ordertrue',
                          
                            value: redymassive ,
                            fio: fioorder,
                            restoran: rerstoranorder
 
                          
                          }; 
                          jQuery('.result').empty();
                          jQuery('.preloader.wait-insert').fadeIn(500);
                          jQuery.post( '/wp-admin/admin-ajax.php', data, function(response) { 
                          		 	 
                          		
                          		jQuery('.preloader.wait-insert').fadeOut(400);
                          		jQuery('.result').delay(400).append(response);
                          });




           		});

	jQuery('.qtyminus, .qtyplus').click(function(e) {

        
        var summerdinamic = 0;
        jQuery('.order-ship tr').each(function() {
			var classinput = jQuery(this).find('.qty');
			var classprice = jQuery(this).find('.price-value');
        	var currentVal = parseInt(classinput.val());
        	var currentValprice = parseInt(classprice.text());
        	
        	if(Number(currentVal)){ 
        		var mergemalue = Number(currentVal) * Number(currentValprice) ;
        		summerdinamic += mergemalue;
   			 }
        	
		});

		jQuery('.order-summ ').empty();
		jQuery('.order-summ ').append(summerdinamic);

	});
});
</script>

										";

 	echo "</table>";
  	echo "<table>";
  	 echo "<tr><th class='align-left'> Ваше ФИО: <input type='text' name='fio'  class='fio-order' /></th>";
  	 echo "<th><div style='vertical-align:middle'> Выберите ресторан: <select name='selectrestoran' class='choose-restoran'><option value='one'>ONE</option><option value='two'>TWO</option></select></div></th>";
  
 	 echo '<th class="align-left-summ-cart">Сумма: <span class="order-summ ">'.$pricesummm.'</span></th></tr>';
  
 
 	 echo "</table>"; 
 	echo '<div class="align-right-order-button"><span class="order-true">оформить заказ</span></div>';

  	 
 

wp_die();
}
add_action('wp_ajax_nopriv_ordertrue', 'ordertrue_callback');
function ordertrue_callback() {
	global $wpdb;

	$order = $_POST['value'];
	$restoran = $_POST['restoran'];
	$fio = $_POST['fio'];

$table_name = $wpdb->prefix . "orderlist";
$table_name2 = $wpdb->prefix . "order";
$date = date('Y-m-d');
			$wpdb->query( $wpdb->prepare(
			    "INSERT INTO `".$table_name."` (id, fio, restoran,date) VALUES ( %d, %s, %s, %s )",
			    array(
			        0,
			        $fio, 
			        $restoran,
			        $date
			    )
			));
			  $results = $wpdb->get_results('SELECT MAX(`id`) as value FROM '.$table_name.'');
     

		foreach ($order as $key => $value) {
			 
			$wpdb->query( $wpdb->prepare(
			    "INSERT INTO `".$table_name2."` (id, name, price, current, quant) VALUES ( %d, %s, %s, %s, %s )",
			    array(
			        0,
			        $value['name'],
			        $value['price'],
			        $results[0]->value,
			        $value['quant']
			    )
			));
		}

			echo '<h1 class="answer-order">Ваш заказ принят, спасибо</h1>';

wp_die();
}