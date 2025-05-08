<?php
/**
 * Plugin Name: ACF Paragraph Block
 * Description: Adds a custom paragraph block variation that pulls content from an ACF field.
 * Version: 1.1
 * Author: Ben Vankat, Hanscom Park Studio
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
	 exit; // Exit if accessed directly.
 }
 
 // Enqueue the JavaScript for block registration
 function acf_paragraph_block_enqueue_script() {
	 wp_enqueue_script(
		 'acf-paragraph-block-js',
		 plugin_dir_url( __FILE__ ) . 'block.js',
		 array( 'wp-blocks', 'wp-editor', 'wp-components', 'wp-element' ),
		 filemtime( plugin_dir_path( __FILE__ ) . 'block.js' ),
		 true
	 );
 }
 
 add_action( 'enqueue_block_editor_assets', 'acf_paragraph_block_enqueue_script' );
 
 // Dynamic block render callback
 function acf_paragraph_block_dynamic_render( $attributes ) {
	 if ( isset( $attributes['acfFieldSlug'] ) && function_exists( 'get_field' ) ) {
		 $acf_value = get_field( $attributes['acfFieldSlug'] );
		 if ( $acf_value ) {
			 return '<p>' . esc_html( $acf_value ) . '</p>';
		 }
	 }
	 return '<p>' . esc_html__( 'No ACF field value found.', 'acf-paragraph-block' ) . '</p>';
 }
 
 // Register the dynamic block (tied to our variation)
 function acf_paragraph_block_register_dynamic() {
	 register_block_type( 'acf-paragraph-block/dynamic', array(
		 'render_callback' => 'acf_paragraph_block_dynamic_render',
		 'attributes' => array(
			 'acfFieldSlug' => array(
				 'type' => 'string',
				 'default' => '',
			 ),
		 ),
	 ) );
 }
 
 add_action( 'init', 'acf_paragraph_block_register_dynamic' );
