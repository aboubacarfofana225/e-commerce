<?php
/**
*
* Metaboxes
*
*/

add_action( 'cmb2_init', 'e_shop_homepage_template_metaboxes' );

function e_shop_homepage_template_metaboxes() {

    $prefix = 'maxstore';
    
    $cmb_slider = new_cmb2_box( array(
        'id'            => 'homepage_metabox_slider',
        'title'         => __( 'Homepage Options', 'e-shop' ),
        'object_types'  => array( 'page' ), // Post type 
        'show_on'       => array( 'key' => 'page-template', 'value' => array('template-home-slider.php') ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $cmb_slider->add_field( array(
        'name'   => __( 'Slider', 'e-shop' ),
    		'desc'   => __( 'Enable or disable slider.', 'e-shop' ),
    		'id'     => $prefix .'_slider_on',
    		'default' => 'off',
        'type'    => 'radio_inline',
        'options' => array(
            'off'   => __( 'Off', 'e-shop' ),
            'fullwidth' => __( 'on', 'e-shop' ),
        ),
    ) );
    $group_field_id = $cmb_slider->add_field( array(
		'id'          => $prefix .'_home_slider',
		'type'        => 'group',
		'description' => __( 'Generate slider', 'e-shop' ),
		'options'     => array(
			'group_title'   => __( 'Slide {#}', 'e-shop' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add another slide', 'e-shop' ),
			'remove_button' => __( 'Remove slide', 'e-shop' ),
			'sortable'      => true, 
		),
  	) );
    $cmb_slider->add_group_field( $group_field_id, array(
  		'name'   => __( 'Image', 'e-shop' ),
  		'id'     => $prefix .'_image',
  		'description' => __( 'Ideal image size: 1140x488px', 'e-shop' ),
  		'type' => 'file',
      'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
  	) );
  	$cmb_slider->add_group_field( $group_field_id, array(
  		'name'   => __( 'Slider Title', 'e-shop' ),
  		'id'     => $prefix .'_title',
  		'type'   => 'text',
  	) );
  	$cmb_slider->add_group_field( $group_field_id, array(
  		'name' => __( 'Slider Description', 'e-shop' ),
  		'id'   => $prefix .'_desc',
  		'type' => 'textarea_code',
  	) );
  	$cmb_slider->add_group_field( $group_field_id, array(
  		'name' => __( 'Button Text', 'e-shop' ),
  		'id'   => $prefix .'_button_text',
  		'type' => 'text',
  	) );
  	$cmb_slider->add_group_field( $group_field_id, array(
  		'name' => __( 'Button URL', 'e-shop' ),
  		'id'   => $prefix .'_url',
  		'type' => 'text_url',
  	) );
}
