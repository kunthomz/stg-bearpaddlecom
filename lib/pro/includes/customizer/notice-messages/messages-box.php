<?php
/**
 * Add Jupiter Styles for Notice Messages > Syles tab to the WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since   1.23.0
 */

add_action( 'jupiterx_after_customizer_register', function() {

	$section_styles = 'jupiterx_notice_messages_box';

	// Success Section.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-label',
		'label'      => __( 'Success Notification', 'jupiterx' ),
		'label_type' => 'fancy',
		'color'      => 'white',
		'settings'   => 'notice_messages_box_success_label',
		'section'    => $section_styles,
	] );

	// Heading.
	JupiterX_Customizer::add_field( [
		'type'     => 'jupiterx-label',
		'label'    => __( 'Container', 'jupiterx' ),
		'settings' => 'notice_messages_box_success_container_heading',
		'section'  => $section_styles,
	] );

	// Background.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-color',
		'settings'  => 'jupiterx_notice_messages_box_success_background_color',
		'section'   => $section_styles,
		'transport' => 'postMessage',
		'icon'      => 'background-color',
		'css_var'   => 'notice-messages-box-success-container-background-color',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-message',
				'property' => 'background-color',
			],
		],
	] );

	// Border.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-border',
		'settings'  => 'jupiterx_notice_messages_success_box_border',
		'section'   => $section_styles,
		'css_var'   => 'notice-messages-box-success-container-border',
		'exclude'   => [ 'style', 'size' ],
		'transport' => 'postMessage',
		'output'    => [
			[
				'element'  => '.woocommerce-notices-wrapper .woocommerce-message',
				'property' => 'border-top',
			],
		],
	] );

	// Spacing.
	JupiterX_Customizer::add_responsive_field( [
		'type'      => 'jupiterx-box-model',
		'settings'  => 'jupiterx_notice_messages_success_box_spacing',
		'section'   => $section_styles,
		'css_var'   => 'notice-messages-box-success-container',
		'transport' => 'postMessage',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-message',
			],
		],
	] );

	// Heading.
	JupiterX_Customizer::add_field( [
		'type'     => 'jupiterx-label',
		'label'    => __( 'Text', 'jupiterx' ),
		'settings' => 'notice_messages_box_success_text_heading',
		'section'  => $section_styles,
	] );

	// Typography.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-typography',
		'settings'   => 'notice_messages_box_success_text_typography',
		'section'    => $section_styles,
		'responsive' => true,
		'css_var'    => 'notice-messages-box-success-text',
		'transport'  => 'postMessage',
		'exclude'   => [ 'line_height' ],
		'output'     => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-message',
			],
		],
	] );

	// Heading.
	JupiterX_Customizer::add_field( [
		'type'     => 'jupiterx-label',
		'label'    => __( 'Icon', 'jupiterx' ),
		'settings' => 'notice_messages_box_success_icon_heading',
		'section'  => $section_styles,
	] );

	// Typography.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-typography',
		'settings'   => 'notice_messages_box_success_icon_typography',
		'section'    => $section_styles,
		'responsive' => true,
		'css_var'    => 'notice-messages-box-success-icon',
		'transport'  => 'postMessage',
		'exclude'   => [
			'line_height',
			'text_decoration',
			'font_weight',
			'font_family',
			'font_style',
			'letter_spacing',
			'text_transform',
		],
		'output'     => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-message::before',
			],
		],
	] );

	// Info Section.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-label',
		'label'      => __( 'Info Notification', 'jupiterx' ),
		'label_type' => 'fancy',
		'color'      => 'white',
		'settings'   => 'notice_messages_box_info_label',
		'section'    => $section_styles,
	] );

	// Heading.
	JupiterX_Customizer::add_field( [
		'type'     => 'jupiterx-label',
		'label'    => __( 'Container', 'jupiterx' ),
		'settings' => 'notice_messages_box_info_container_heading',
		'section'  => $section_styles,
	] );

	// Background.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-color',
		'settings'  => 'jupiterx_notice_messages_box_info_background_color',
		'section'   => $section_styles,
		'transport' => 'postMessage',
		'icon'      => 'background-color',
		'css_var'   => 'notice-messages-box-info-container-background-color',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-info',
				'property' => 'background-color',
			],
		],
	] );

	// Border.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-border',
		'settings'  => 'jupiterx_notice_messages_info_box_border',
		'section'   => $section_styles,
		'css_var'   => 'notice-messages-box-info-container-border',
		'exclude'   => [ 'style', 'size' ],
		'transport' => 'postMessage',
		'output'    => [
			[
				'element'  => '.woocommerce-notices-wrapper .woocommerce-info',
				'property' => 'border-top',
			],
		],
	] );

	// Spacing.
	JupiterX_Customizer::add_responsive_field( [
		'type'      => 'jupiterx-box-model',
		'settings'  => 'jupiterx_notice_messages_info_box_spacing',
		'section'   => $section_styles,
		'css_var'   => 'notice-messages-box-info-container',
		'transport' => 'postMessage',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-info',
			],
		],
	] );

	// Heading.
	JupiterX_Customizer::add_field( [
		'type'     => 'jupiterx-label',
		'label'    => __( 'Text', 'jupiterx' ),
		'settings' => 'notice_messages_box_info_text_heading',
		'section'  => $section_styles,
	] );

	// Typography.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-typography',
		'settings'   => 'notice_messages_box_info_text_typography',
		'section'    => $section_styles,
		'responsive' => true,
		'css_var'    => 'notice-messages-box-info-text',
		'transport'  => 'postMessage',
		'exclude'   => [ 'line_height' ],
		'output'     => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-info',
			],
		],
	] );

	// Heading.
	JupiterX_Customizer::add_field( [
		'type'     => 'jupiterx-label',
		'label'    => __( 'Icon', 'jupiterx' ),
		'settings' => 'notice_messages_box_info_icon_heading',
		'section'  => $section_styles,
	] );

	// Typography.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-typography',
		'settings'   => 'notice_messages_box_info_icon_typography',
		'section'    => $section_styles,
		'responsive' => true,
		'css_var'    => 'notice-messages-box-info-icon',
		'transport'  => 'postMessage',
		'exclude'   => [
			'line_height',
			'text_decoration',
			'font_weight',
			'font_family',
			'font_style',
			'letter_spacing',
			'text_transform',
		],
		'output'     => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-info::before',
			],
		],
	] );

	// Error Section.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-label',
		'label'      => __( 'Error Notification', 'jupiterx' ),
		'label_type' => 'fancy',
		'color'      => 'white',
		'settings'   => 'notice_messages_box_error_label',
		'section'    => $section_styles,
	] );

	// Heading.
	JupiterX_Customizer::add_field( [
		'type'     => 'jupiterx-label',
		'label'    => __( 'Container', 'jupiterx' ),
		'settings' => 'notice_messages_box_error_container_heading',
		'section'  => $section_styles,
	] );

	// Background.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-color',
		'settings'  => 'jupiterx_notice_messages_box_error_background_color',
		'section'   => $section_styles,
		'transport' => 'postMessage',
		'icon'      => 'background-color',
		'css_var'   => 'notice-messages-box-error-container-background-color',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-error',
				'property' => 'background-color',
			],
		],
	] );

	// Border.
	JupiterX_Customizer::add_field( [
		'type'      => 'jupiterx-border',
		'settings'  => 'jupiterx_notice_messages_error_box_border',
		'section'   => $section_styles,
		'css_var'   => 'notice-messages-box-error-container-border',
		'exclude'   => [ 'style', 'size' ],
		'transport' => 'postMessage',
		'output'    => [
			[
				'element'  => '.woocommerce-notices-wrapper .woocommerce-error',
				'property' => 'border-top',
			],
		],
	] );

	// Spacing.
	JupiterX_Customizer::add_responsive_field( [
		'type'      => 'jupiterx-box-model',
		'settings'  => 'jupiterx_notice_messages_error_box_spacing',
		'section'   => $section_styles,
		'css_var'   => 'notice-messages-box-error-container',
		'transport' => 'postMessage',
		'output'    => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-error',
			],
		],
	] );

	// Heading.
	JupiterX_Customizer::add_field( [
		'type'     => 'jupiterx-label',
		'label'    => __( 'Text', 'jupiterx' ),
		'settings' => 'notice_messages_box_error_text_heading',
		'section'  => $section_styles,
	] );

	// Typography.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-typography',
		'settings'   => 'notice_messages_box_error_text_typography',
		'section'    => $section_styles,
		'responsive' => true,
		'css_var'    => 'notice-messages-box-error-text',
		'transport'  => 'postMessage',
		'exclude'   => [ 'line_height' ],
		'output'     => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-error',
			],
		],
	] );

	// Heading.
	JupiterX_Customizer::add_field( [
		'type'     => 'jupiterx-label',
		'label'    => __( 'Icon', 'jupiterx' ),
		'settings' => 'notice_messages_box_error_icon_heading',
		'section'  => $section_styles,
	] );

	// Typography.
	JupiterX_Customizer::add_field( [
		'type'       => 'jupiterx-typography',
		'settings'   => 'notice_messages_box_error_icon_typography',
		'section'    => $section_styles,
		'responsive' => true,
		'css_var'    => 'notice-messages-box-error-icon',
		'transport'  => 'postMessage',
		'exclude'   => [
			'line_height',
			'text_decoration',
			'font_weight',
			'font_family',
			'font_style',
			'letter_spacing',
			'text_transform',
		],
		'output'     => [
			[
				'element' => '.woocommerce-notices-wrapper .woocommerce-error::before',
			],
		],
	] );

} );
