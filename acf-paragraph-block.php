<?php
/**
 * Plugin Name: ACF Paragraph Block
 * Description: Adds a custom paragraph block variation that pulls content from an ACF field.
 * Version: 1.0
 * Author: Ben Vankat, Hanscom Park Studio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function acf_paragraph_block_register() {
	// Register the block variation for Paragraph block
	register_block_variation( 'core/paragraph', [
		'name'        => 'acf-field',
		'title'       => __( 'ACF Field Paragraph', 'acf-paragraph-block' ),
		'description' => __( 'A Paragraph block that displays content from a specified ACF field.', 'acf-paragraph-block' ),
		'attributes'  => [
			'acfFieldSlug' => '',
		],
		'render_callback' => 'acf_paragraph_block_render',
	]);
}

add_action( 'init', 'acf_paragraph_block_register' );

function acf_paragraph_block_render( $attributes ) {
	$acf_field_slug = isset( $attributes['acfFieldSlug'] ) ? $attributes['acfFieldSlug'] : '';
	
	if ( ! empty( $acf_field_slug ) ) {
		// Get the value of the ACF field
		$acf_value = get_field( $acf_field_slug );

		// Return the field value wrapped in a paragraph element
		return '<p>' . esc_html( $acf_value ) . '</p>';
	}

	return '<p>' . __( 'No ACF field found.', 'acf-paragraph-block' ) . '</p>';
}

// Enqueue the JavaScript for block registration
function acf_paragraph_block_enqueue_script() {
	wp_enqueue_script(
		'acf-paragraph-block-js',
		plugin_dir_url( __FILE__ ) . 'block.js',
		array( 'wp-blocks', 'wp-editor', 'wp-components' ),
		null,
		true
	);
}

add_action( 'enqueue_block_editor_assets', 'acf_paragraph_block_enqueue_script' );
