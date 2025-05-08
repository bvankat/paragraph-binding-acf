<?php
if ( ! function_exists( 'get_field' ) ) {
	return '<p>ACF plugin is required.</p>';
}

$acf_field_slug = isset( $attributes['acfFieldSlug'] ) ? $attributes['acfFieldSlug'] : '';
$acf_value = $acf_field_slug ? get_field( $acf_field_slug ) : '';

if ( $acf_value ) {
	echo '<p>' . esc_html( $acf_value ) . '</p>';
} else {
	echo '<p>' . esc_html__( 'No ACF field value found.', 'acf-paragraph-block' ) . '</p>';
}
