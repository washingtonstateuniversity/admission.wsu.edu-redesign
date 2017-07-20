<?php

class Admission_Theme_Customizer {
	/**
	 * Setup hooks.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Add custom settings and controls to the WP Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	public function customize_register( $wp_customize ) {
		$wp_customize->add_setting( 'spine_options[global_main_header_hashtag]', array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'type'       => 'option',
		) );

		$wp_customize->add_control( 'global_main_header_hashtag', array(
			'label'    => 'Hashtag',
			'section'  => 'title_tagline',
			'settings' => 'spine_options[global_main_header_hashtag]',
			'type'     => 'text',
			'priority' => 5,
		) );

		$wp_customize->add_setting( 'spine_options[global_main_header_hashtag_url]', array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'type'       => 'option',
		) );

		$wp_customize->add_control( 'global_main_header_hashtag_url', array(
			'label'    => 'Hashtag URL',
			'section'  => 'title_tagline',
			'settings' => 'spine_options[global_main_header_hashtag_url]',
			'type'     => 'url',
			'priority' => 6,
		) );
	}
}
new Admission_Theme_Customizer();
