<?php
// IMPORTANT: This is depracated and not supported any more
// Global variable which stores all meta boxes.
global $meta_boxes;
$meta_boxes   = array();
$prefix = 're_';
// 1st meta box
$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'standard',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => __( 'Настройки', 'your-prefix' ),

		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'menu' ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',

		// Auto save: true, false (default). Optional.
		'autosave'   => true,

		// List of meta fields
		'fields'     => array(
			// TEXT
			array(
				// Field name - Will be used as label
				'name'  => __( 'Вес', 'your-prefix' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}massa",
				// Field description (optional)
				'desc'  => __( 'Вес', 'your-prefix' ),
				'type'  => 'text', 
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				 
			),	
			array(
				// Field name - Will be used as label
				'name'  => __( 'Стоимость', 'your-prefix' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}price",
				// Field description (optional)
				'desc'  => __( 'Стоимость', 'your-prefix' ),
				'type'  => 'text', 
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				 
			)
			 
		) 
);

function YOURPREFIX_register_meta_boxes() {
	global $meta_boxes;
	if ( ! class_exists( 'RW_Meta_Box' ) )
		return;
	foreach ( $meta_boxes as $meta_box ) {
		new RW_Meta_Box( $meta_box );
	}
}
add_action( 'admin_init', 'YOURPREFIX_register_meta_boxes' );