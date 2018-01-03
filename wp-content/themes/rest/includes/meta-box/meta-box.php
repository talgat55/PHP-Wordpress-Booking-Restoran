<?php

function my_meta_box() {  
    add_meta_box(  
        'my_meta_menu_box',  
        'Дополнительные поля',  
        'show_my_metabox', 
        'menu',  
        'normal',
        'high');
}  
add_action('add_meta_boxes', 'my_meta_box'); 
 
$meta_fields = array(  
    array(  
        'label' => 'Вес',     
        'id'    => 'my_meta_weight', 
        'type'  => 'text'  
    ),  
    array(  
        'label' => 'Цена',   
        'id'    => 'my_meta_price',  
        'type'  => 'text'
    ) 
);
  
function show_my_metabox() {  
global $meta_fields;  
global $post;   
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
  
    echo '<table class="form-table">';  
    foreach ($meta_fields as $field) {   
        $meta = get_post_meta($post->ID, $field['id'], true);   
        echo '<tr><th><label for="'.$field['id'].'">'.$field['label'].'</label></th><td>';  
        
        switch($field['type']) {  
            case 'text':  
    			echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /><br /><span class="description">'.$field['desc'].'</span>';  
			break;
			case 'textarea':  
			    echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea><br /><span class="description">'.$field['desc'].'</span>';  
			break;
			case 'checkbox':  
			    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/><label for="'.$field['id'].'">'.$field['desc'].'</label>';  
			break;

                }
        echo '</td></tr>';  
    }  
    echo '</table>'; 
}
  
function save_my_meta_fields($post_id) {  
    global $meta_fields;   
  
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))   
        return $post_id;  
   
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;   
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
  
    foreach ($meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_my_meta_fields');

?>