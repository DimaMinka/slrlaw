<?php
/**
 * slrlaw Theme Customizer
 *
 * @package slrlaw
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function slrlaw_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'advanced_settings' , array(
		'title'      => __('Settings'),
		'priority'   => 30,
	) );

	$wp_customize->add_setting(
		'sg_logo',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_setting(
		'sg_logo_alt',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => ''
		)
	);

	$wp_customize->add_setting(
		'sg_contact',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => ''
		)
	);

	$wp_customize->add_setting(
		'sg_copyright',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => ''
		)
	);

	$wp_customize->add_setting(
		'sg_company',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => ''
		)
	);


	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'sg_logo',
			array(
				'label'      => __('Upload').'-'.__('Logo'),
				'section'    => 'advanced_settings',
				'settings'   => 'sg_logo'
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sg_logo_alt',
			array(
				'label'      => __('alt logo'),
				'section'    => 'advanced_settings',
				'settings'   => 'sg_logo_alt',
				'type'       => 'text',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sg_contact',
			array(
				'label'      => __('Contact', 'contact-form-7'),
				'section'    => 'advanced_settings',
				'settings'   => 'sg_contact',
				'type'       => 'text',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sg_copyright',
			array(
				'label'      => __('Excerpt').'-'.__('Copyright', 'slrlaw'),
				'section'    => 'advanced_settings',
				'settings'   => 'sg_copyright',
				'type'       => 'text',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sg_company',
			array(
				'label'      => __('Company').'-'.__('Data'),
				'section'    => 'advanced_settings',
				'settings'   => 'sg_company',
				'type'       => 'textarea',
			)
		)
	);



}
add_action( 'customize_register', 'slrlaw_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function slrlaw_customize_preview_js() {
	wp_enqueue_script( 'slrlaw_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'slrlaw_customize_preview_js' );
