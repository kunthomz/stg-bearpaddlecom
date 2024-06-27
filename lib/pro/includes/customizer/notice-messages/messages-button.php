<?php
/**
 * Add Jupiter Styles for Notice Messages > Syles tab to the WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since   1.23.0
 */

add_action( 'jupiterx_after_customizer_register', function() {

	$section_styles = 'jupiterx_notice_messages_button';

	// Typography.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-typography',
		'settings'   => 'jupiterx_notice_messages_button_typography',
		'section'    => $section_styles,
		'responsive' => true,
		'css_var'    => 'notice-messages-button',
		'transport'  => 'postMessage',
		'exclude'    => [ 'line_height' ],
		'output'     => [
			[
				'element' => '.woocommerce-notices-wrapper a.button',
			],
		],
	] );

	// Background.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-color',
		'settings'  => 'jupiterx_notice_messages_button_background_color',
		'section'   => $section_styles,
		'transport' => 'postMessage',
		'icon'      => 'background-color',
		'css_var'   => 'notice-messages-button-background-color',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper a.button',
				'property' => 'background-color',
			],
		],
	] );

	// Border.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-border',
		'settings'  => 'jupiterx_notice_messages_button_border',
		'section'   => $section_styles,
		'css_var'   => 'notice-messages-button-border',
		'exclude'   => [ 'style', 'size' ],
		'transport' => 'postMessage',
		'output'    => [
			[
				'element'  => '.woocommerce-notices-wrapper a.button',
			],
		],
	] );

	// Box shadow.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-box-shadow',
		'settings'  => 'jupiterx_notice_messages_button_box_shadow',
		'section'   => $section_styles,
		'css_var'   => 'notice-messages-button-box-shadow',
		'unit'      => 'px',
		'transport' => 'postMessage',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper a.button',
				'units'   => 'px',
			],
		],
	] );

	// Hover.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-label',
		'label'      => __( 'Hover', 'jupiterx' ),
		'label_type' => 'fancy',
		'color'      => 'orange',
		'settings'   => 'notice_messages_button_label',
		'section'    => $section_styles,
	] );

	// Color on hover.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-color',
		'settings'  => 'jupiterx_notice_messages_button_color_hover',
		'section'   => $section_styles,
		'transport' => 'postMessage',
		'icon'      => 'font-color',
		'column'    => '3',
		'css_var'   => 'notice-messages-button-color-hover',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper a.button:hover',
				'property' => 'color',
			],
		],
	] );

	// Background color on hover.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-color',
		'settings'  => 'jupiterx_notice_messages_button_background_color_hover',
		'section'   => $section_styles,
		'transport' => 'postMessage',
		'icon'      => 'color',
		'column'    => '3',
		'icon'      => 'background-color',
		'css_var'   => 'notice-messages-button-background-color-hover',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper a.button:hover',
				'property' => 'background-color',
			],
		],
	] );

	// Border on hover.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-color',
		'settings'  => 'jupiterx_notice_messages_button_border_hover',
		'section'   => $section_styles,
		'transport' => 'postMessage',
		'icon'      => 'border-color',
		'column'    => '3',
		'css_var'   => 'notice-messages-button-border-hover',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper a.button:hover',
				'property' => 'color',
			],
		],
	] );

	// box shadow on hover.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-box-shadow',
		'settings'  => 'jupiterx_notice_messages_button_box_shadow_hover',
		'section'   => $section_styles,
		'css_var'   => 'notice-messages-button-box-shadow-hover',
		'unit'      => 'px',
		'transport' => 'postMessage',
		'exclude'   => [ 'position', 'color' ],
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper a.button:hover',
				'units'   => 'px',
			],
		],
	] );

} );
