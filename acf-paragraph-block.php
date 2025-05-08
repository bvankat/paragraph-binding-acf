<?php
/**
 * Plugin Name: ACF Paragraph Block
 * Description: Adds a custom paragraph block variation that pulls content from an ACF field.
 * Version: 1.2
 * Author: Ben Vankat, Hanscom Park Studio
 */

 
 if ( ! defined( 'ABSPATH' ) ) {
	 exit; // Exit if accessed directly.
 }
 
 function acf_paragraph_block_register() {
	 $dir = __DIR__;
 
	 wp_register_script(
		 'acf-paragraph-block-js',
		 plugins_url( 'block.js', __FILE__ ),
		 array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components' ),
		 filemtime( "$dir/block.js" )
	 );
 
	 wp_register_style(
		 'acf-paragraph-block-style',
		 false // No frontend styles for now.
	 );
 
	 register_block_type( "$dir/block.json" );
 }
 
 add_action( 'init', 'acf_paragraph_block_register' );
