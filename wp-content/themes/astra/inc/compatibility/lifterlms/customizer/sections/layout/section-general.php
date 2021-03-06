<?php
/**
 * LifterLMS General Options for our theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2015, Brainstorm Force
 * @link        http://www.brainstormforce.com
 * @since       1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	/**
	 * Option: Shop Columns
	 */
	$wp_customize->add_setting(
		ASTRA_THEME_SETTINGS . '[llms-course-grid]', array(
			'default'           => array(
				'desktop' => 3,
				'tablet'  => 2,
				'mobile'  => 1,
			),
			'type'              => 'option',
			'sanitize_callback' => array( 'Astra_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Astra_Control_Responsive_Slider(
			$wp_customize, ASTRA_THEME_SETTINGS . '[llms-course-grid]', array(
				'type'        => 'ast-responsive-slider',
				'section'     => 'section-lifterlms',
				'label'       => __( 'Course / Membership Columns', 'astra' ),
				'priority'    => 0,
				'input_attrs' => array(
					'step' => 1,
					'min'  => 1,
					'max'  => 6,
				),
			)
		)
	);
