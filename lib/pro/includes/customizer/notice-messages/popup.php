<?php
/**
 * Modify Jupiter X Customizer settings for Woocomerce Notice Messages .
 *
 * @package JupiterX\Pro\Customizer
 *
 * @since 1.23.0
 */

add_action( 'jupiterx_notice_messages_styles_pro_box_after_field', function() {

	$popups = [
		'box'   => __( 'Box', 'jupiterx' ),
		'button' => __( 'Button', 'jupiterx' ),
	];

	// Elements popup.
	JupiterX_Customizer::update_section( 'jupiterx_notice_messages', [
		'pro'    => false,
		'popups' => $popups,
	] );

	// Create popup children.
	foreach ( $popups as $popup_id => $label ) {
		JupiterX_Customizer::add_section( 'jupiterx_notice_messages_' . $popup_id, [
			'popup' => 'jupiterx_notice_messages',
			'type'  => 'pane',
			'pane'  => [
				'type' => 'popup',
				'id'   => $popup_id,
			],
		] );
	}

	// Styles tab > Child popups.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-child-popup',
		'settings'   => 'jupiterx_notice_messages_styles_popups',
		'section'    => 'jupiterx_notice_messages_styles',
		'target'     => 'jupiterx_notice_messages',
		'choices'    => [
			'box'    => __( 'Box', 'jupiterx' ),
			'button' => __( 'Button', 'jupiterx' ),
		],
	] );

} );

add_action( 'jupiterx_after_customizer_register', function() {

	// Pro Box.
	JupiterX_Customizer::remove_field( 'jupiterx_notice_messages_styles_pro_box' );
} );
