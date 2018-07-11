<?php
/**
 * inspirar Theme Customizer
 *
 * @package inspirar
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function inspirar_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'inspirar_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'inspirar_customize_partial_blogdescription',
		) );
	}

	// Theme options panel
    $wp_customize->add_panel( 'inspirar_theme_options', array(
    	'priority' => 25,
    	'capability' => 'edit_theme_options',
    	'theme_supports' => '',
    	'title'  => __('Inspirar Theme Options', 'inspirar')
    ));


    // General settings 
    $wp_customize->add_section( 'inspirar_general_settings', array(
    	'title'		=> __( 'General Settings', 'inspirar' ),
    	'priority'	=> 1000,
    	'panel'		=> 'inspirar_theme_options'
    ));
    $wp_customize->add_setting( 'inspirar_site_padding_top', array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_site_padding_top', array(
    	'type' => 'text',
        'label'      => __('Site Padding Top', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 100px.', 'inspirar'),
        'section'    => 'inspirar_general_settings',
        'settings'   => 'inspirar_site_padding_top',
    ));

    $wp_customize->add_setting( 'inspirar_site_padding_bottom', array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_site_padding_bottom', array(
    	'type' => 'text',
        'label'      => __('Site Padding Bottom', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 100px.', 'inspirar'),
        'section'    => 'inspirar_general_settings',
        'settings'   => 'inspirar_site_padding_bottom',
    ));


    // Logo settings 
    $wp_customize->add_section( 'inspirar_logo_settings', array(
        'title'     => __( 'Logo Settings', 'inspirar' ),
        'priority'  => 1005,
        'panel'     => 'inspirar_theme_options',
        'description' => __( 'To upload custom logo image - go to Appearance > Customize > Site Identity', 'inspirar' )
    ));

    $wp_customize->add_setting( 'inspirar_sub_page_logo', array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_file'
    ));

    $wp_customize->add_control( new WP_Customize_Upload_Control(
        $wp_customize,
        'inspirar_sub_page_logo',
         array(
            'label'      => __( 'Sub Page Logo', 'inspirar' ),
            'section'    => 'inspirar_logo_settings'                    
        )
    ));


    $wp_customize->add_setting( 'inspirar_logo_width', array(
        'default'           => '175px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_number'
    ));

    $wp_customize->add_control( 'inspirar_logo_width', array(
        'label' => __('Logo Width (px) ', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 175px.', 'inspirar'),
        'section' => 'inspirar_logo_settings',
        'settings' => 'inspirar_logo_width',
    ) );

    $wp_customize->add_setting( 'inspirar_logo_height', array(
        'default'           => '49px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_number'
    ));

    $wp_customize->add_control( 'inspirar_logo_height', array(
        'label' => __('Logo Height (px) ', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex:49px.', 'inspirar'),
        'section' => 'inspirar_logo_settings',
        'settings' => 'inspirar_logo_height',
    ) );

    $wp_customize->add_setting( 'inspirar_logo_uc', array(
        'default'           => false,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'inspirar_logo_uc', array(
        'label' => __('Site Title Uppercase', 'inspirar'),
        'type'   => 'checkbox',
        'section' => 'inspirar_logo_settings',
        'settings' => 'inspirar_logo_uc',
    ) );

    $wp_customize->add_setting( 'inspirar_logo_font_color', array(
        'default'           => '#fff',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_logo_font_color', array(
        'label' => __('Site Title Text color', 'inspirar'),
        'section' => 'inspirar_logo_settings',
        'settings' => 'inspirar_logo_font_color'
    )) );
   
    $wp_customize->add_setting( 'inspirar_logo_font_size', array(
        'default'           => '32px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_number'
    ));

    $wp_customize->add_control( 'inspirar_logo_font_size', array(
        'label' => __('Site Title Font Size (px) ', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 32px.', 'inspirar'),
        'section' => 'inspirar_logo_settings',
        'settings' => 'inspirar_logo_font_size',
    ) );

    $wp_customize->add_setting( 'inspirar_logo_font_weight', array(
        'default'           => '700',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_number'
    ));

    $wp_customize->add_control( 'inspirar_logo_font_weight', array(
        'label' => __('Site Title Font Weight ', 'inspirar'),
        'section' => 'inspirar_logo_settings',
        'settings' => 'inspirar_logo_font_weight',
    ) );
    
    $wp_customize->add_setting( 'inspirar_tagline_visibility', array(
        'default'           => true,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'inspirar_tagline_visibility', array(
        'label' => __('Show/Hide Site Tagline', 'inspirar'),
        'type'   => 'checkbox',
        'section' => 'inspirar_logo_settings',
        'settings' => 'inspirar_tagline_visibility',
    ) );

    $wp_customize->add_setting( 'inspirar_tagline_uc', array(
        'default'           => false,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'inspirar_tagline_uc', array(
        'label' => __('Site Tagline Uppercase?', 'inspirar'),
        'type'   => 'checkbox',
        'section' => 'inspirar_logo_settings',
        'settings' => 'inspirar_tagline_uc',
    ) );

    $wp_customize->add_setting( 'inspirar_tagline_font_size', array(
        'default'           => '15px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_number'
    ));

    $wp_customize->add_control( 'inspirar_tagline_font_size', array(
        'label' => __('Tagline Font Size (px) ', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 15px.', 'inspirar'),
        'section' => 'inspirar_logo_settings',
        'settings' => 'inspirar_tagline_font_size',
    ) );

    $wp_customize->add_setting( 'inspirar_tagline_font_color', array(
        'default'           => '#fff',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_tagline_font_color', array(
        'label' => __('Tagline Text color', 'inspirar'),
        'section' => 'inspirar_logo_settings',
        'settings' => 'inspirar_tagline_font_color'
    )) );

    // Menu section
    $wp_customize->add_section( 'inspirar_main_menu_section', array(
    	'title'		=> __( 'Main Menu Settings', 'inspirar' ),
    	'priority'	=> 1010,
    	'panel'		=> 'inspirar_theme_options'
    ));
    $wp_customize->add_setting( 'inspirar_main_menu_sticky', array(
        'default'           => false,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_main_menu_sticky', array(
        'label' => __('Active Sticky Menu?', 'inspirar'),
        'type'   => 'checkbox',
        'section' => 'inspirar_main_menu_section',
        'settings' => 'inspirar_main_menu_sticky',
    ) );

    $wp_customize->add_setting( 'inspirar_main_menu_fullwidth', array(
        'default'           => false,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_main_menu_fullwidth', array(
        'label' => __('Active FullWidth Menu?', 'inspirar'),
        'type'   => 'checkbox',
        'section' => 'inspirar_main_menu_section',
        'settings' => 'inspirar_main_menu_fullwidth',
    ) );

    $wp_customize->add_setting( 'inspirar_menu_bg_color', array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_menu_bg_color', array(
        'label' => __('Main Menu Background color', 'inspirar'),
        'section' => 'inspirar_main_menu_section',
        'settings' => 'inspirar_menu_bg_color'
    )) );

    $wp_customize->add_setting( 'inspirar_main_menu_fz', array(
        'default'           => '13px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_main_menu_fz', array(
        'type' => 'text',
        'label'      => __('Menu Item Font Size', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 13px.', 'inspirar'),
        'section'    => 'inspirar_main_menu_section',
        'settings'   => 'inspirar_main_menu_fz',
    ));

    $wp_customize->add_setting( 'inspirar_main_menu_fw', array(
        'default'           => '500',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_main_menu_fw', array(
        'type' => 'text',
        'label'      => __('Menu Item Font Weight', 'inspirar'),
        'section'    => 'inspirar_main_menu_section',
        'settings'   => 'inspirar_main_menu_fw',
    ));

    $wp_customize->add_setting( 'inspirar_main_menu_text_transform', array(
        'default'           => false,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'inspirar_main_menu_text_transform', array(
        'label' => __('Menu Item Font Capitalize?', 'inspirar'),
        'type'   => 'checkbox',
        'section' => 'inspirar_main_menu_section',
        'settings' => 'inspirar_main_menu_text_transform',
    ) );
    $wp_customize->add_setting( 'inspirar_menu_text_color', array(
    	'default' 	        => '#ffffff',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_menu_text_color', array(
		'label' => __('Main Menu Text color', 'inspirar'),
		'section' => 'inspirar_main_menu_section',
		'settings' => 'inspirar_menu_text_color'
    )) );

    $wp_customize->add_setting( 'inspirar_menu_text_hover_color', array(
    	'default' 	        => '#fff',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_menu_text_hover_color', array(
		'label' => __('Main Menu Text Hover color', 'inspirar'),
		'section' => 'inspirar_main_menu_section',
		'settings' => 'inspirar_menu_text_hover_color'
    )) );

    $wp_customize->add_setting( 'inspirar_menu_border_hover_color', array(
    	'default' 	        => '#fff',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_menu_border_hover_color', array(
		'label' => __('Main Menu Border Hover color', 'inspirar'),
		'section' => 'inspirar_main_menu_section',
		'settings' => 'inspirar_menu_border_hover_color'
    )) );


    $wp_customize->add_setting( 'inspirar_sub_menu_width', array(
        'default'           => '220px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_sub_menu_width', array(
        'type' => 'text',
        'label'      => __('Sub Menu Width', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 220px.', 'inspirar'),
        'section'    => 'inspirar_main_menu_section',
        'settings'   => 'inspirar_sub_menu_width',
    ));

    $wp_customize->add_setting( 'inspirar_sub_menu_bg_color', array(
        'default'           => '#fff',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_sub_menu_bg_color', array(
        'label' => __('Sub Menu Background Color', 'inspirar'),
        'section' => 'inspirar_main_menu_section',
        'settings' => 'inspirar_sub_menu_bg_color'
    )) );

    $wp_customize->add_setting( 'inspirar_sub_menu_fz', array(
        'default'           => '13px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_sub_menu_fz', array(
        'type' => 'text',
        'label'      => __('Sub Menu Font Size', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 13px.', 'inspirar'),
        'section'    => 'inspirar_main_menu_section',
        'settings'   => 'inspirar_sub_menu_fz',
    ));

    $wp_customize->add_setting( 'inspirar_sub_menu_text_transform', array(
        'default'           => false,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'inspirar_sub_menu_text_transform', array(
        'label' => __('SubMenu Font Capitalize?', 'inspirar'),
        'type'   => 'checkbox',
        'section' => 'inspirar_main_menu_section',
        'settings' => 'inspirar_sub_menu_text_transform',
    ) );

    $wp_customize->add_setting( 'inspirar_sub_menu_fw', array(
        'default'           => '500',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_sub_menu_fw', array(
        'type' => 'text',
        'label'      => __('Sub Menu Font Weight', 'inspirar'),
        'section'    => 'inspirar_main_menu_section',
        'settings'   => 'inspirar_sub_menu_fw',
    ));

   $wp_customize->add_setting( 'inspirar_sub_menu_font_color', array(
        'default'           => '#252525',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_sub_menu_font_color', array(
        'label' => __('Sub Menu Font Color', 'inspirar'),
        'section' => 'inspirar_main_menu_section',
        'settings' => 'inspirar_sub_menu_font_color'
    )) );

    $wp_customize->add_setting( 'inspirar_sub_menu_font_hover_color', array(
        'default'           => '#252525',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_sub_menu_font_hover_color', array(
        'label' => __('Sub Menu Font Hover Color', 'inspirar'),
        'section' => 'inspirar_main_menu_section',
        'settings' => 'inspirar_sub_menu_font_hover_color'
    )) );

    $wp_customize->add_setting( 'inspirar_sub_menu_border_color', array(
        'default'           => '#d9dfe5',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_sub_menu_border_color', array(
        'label' => __('Sub Menu Border Color', 'inspirar'),
        'section' => 'inspirar_main_menu_section',
        'settings' => 'inspirar_sub_menu_border_color'
    )) );


    // Page Banner settings 
    $wp_customize->add_section( 'inspirar_page_banner_section', array(
        'title'     => __( 'Page Banner Settings', 'inspirar' ),
        'priority'  => 1015,
        'panel'     => 'inspirar_theme_options'
    ));

    $wp_customize->add_setting( 'inspirar_page_banner_height', array(
        'default'           => '540px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_page_banner_height', array(
        'type' => 'text',
        'label'      => __('Page Banner Height', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 540px.', 'inspirar'),
        'section'    => 'inspirar_page_banner_section',
        'settings'   => 'inspirar_page_banner_height',
    ));

    $wp_customize->add_setting( 'inspirar_page_banner_bg_blend_mode', array(
        'default'           => true,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_page_banner_bg_blend_mode', array(
        'label' => __('Active/Deactive Background Blend Mode', 'inspirar'),
        'type' => 'checkbox',
        'section' => 'inspirar_page_banner_section',
        'settings' => 'inspirar_page_banner_bg_blend_mode'
    ) );
    
    $wp_customize->add_setting( 'inspirar_page_banner_bg_color', array(
        'default'           => '#7c340e',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_page_banner_bg_color', array(
        'label' => __('Page Banner Background color', 'inspirar'),
        'section' => 'inspirar_page_banner_section',
        'settings' => 'inspirar_page_banner_bg_color'
    )) );

    $wp_customize->add_setting( 'inspirar_page_banner_bg_opacity', array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_page_banner_bg_opacity', array(
        'type' => 'text',
        'label'      => __('Background Color Opacity', 'inspirar'),
        'description'      => __('Enter background color opacity ex: 0.3 ', 'inspirar'),
        'section'    => 'inspirar_page_banner_section',
        'settings'   => 'inspirar_page_banner_bg_opacity',
    ));

    $wp_customize->add_setting( 'inspirar_page_banner_font_color', array(
        'default'           => '#fff',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_page_banner_font_color', array(
        'label' => __('Page Banner Font color', 'inspirar'),
        'section' => 'inspirar_page_banner_section',
        'settings' => 'inspirar_page_banner_font_color'
    )) );

    $wp_customize->add_setting( 'inspirar_page_banner_font_size', array(
        'default'           => '30px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_page_banner_font_size', array(
        'type' => 'text',
        'label'      => __('Page Banner Font Size', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 30px.', 'inspirar'),
        'section'    => 'inspirar_page_banner_section',
        'settings'   => 'inspirar_page_banner_font_size',
    ));

    // Page Breadcrumbs settings 
    $wp_customize->add_section( 'inspirar_page_breadcrumbs_section', array(
        'title'     => __( 'Page Breadcrumbs Settings', 'inspirar' ),
        'priority'  => 1015,
        'panel'     => 'inspirar_theme_options'
    ));

    $wp_customize->add_setting( 'inspirar_page_breadcrumbs_section_visiblity', array(
        'default'           => true,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_page_breadcrumbs_section_visiblity', array(
        'label' => __('Show/Hide Breadcrumbs', 'inspirar'),
        'type' => 'checkbox',
        'section' => 'inspirar_page_breadcrumbs_section',
        'settings' => 'inspirar_page_breadcrumbs_section_visiblity'
    ) );

    $wp_customize->add_setting( 'inspirar_page_breadcrumbs_font_color', array(
        'default'           => '#fff',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_page_breadcrumbs_font_color', array(
        'label' => __('Page Breadcrumbs Font color', 'inspirar'),
        'section' => 'inspirar_page_breadcrumbs_section',
        'settings' => 'inspirar_page_breadcrumbs_font_color'
    )) );

     $wp_customize->add_setting( 'inspirar_page_breadcrumbs_active_font_color', array(
        'default'           => '#fff',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_page_breadcrumbs_active_font_color', array(
        'label' => __('Page Breadcrumbs Active Font color', 'inspirar'),
        'section' => 'inspirar_page_breadcrumbs_section',
        'settings' => 'inspirar_page_breadcrumbs_active_font_color'
    )) );

    $wp_customize->add_setting( 'inspirar_page_breadcrumbs_font_size', array(
        'default'           => '12px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_page_breadcrumbs_font_size', array(
        'type' => 'text',
        'label'      => __('Page Breadcrumbs Font Size', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 12px.', 'inspirar'),
        'section'    => 'inspirar_page_breadcrumbs_section',
        'settings'   => 'inspirar_page_breadcrumbs_font_size',
    ));

    // Blog section
    $wp_customize->add_section( 'inspirar_blog_section', array(
        'title'     => __( 'Blog Settings', 'inspirar' ),
        'priority'  => 1020,
        'panel'     => 'inspirar_theme_options'
    ));

    $wp_customize->add_setting( 'inspirar_blog_title', array(
        'default'           =>  '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_blog_title', array(
        'type' => 'text',
        'label'      => __('Blog Title', 'inspirar'),
        'section'    => 'inspirar_blog_section',
        'settings'   => 'inspirar_blog_title',
    ));

    $wp_customize->add_setting( 'inspirar_blog_layout', array(
        'default'           => '2',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_select'
    ));
    $wp_customize->add_control( 'inspirar_blog_layout', array(
        'label' => __('Blog Layout', 'inspirar'),
        'description' => __('Select Blog Sidebar Layout', 'inspirar'),
        'type' => 'select',
        'choices' => array(
            '1' => __('Left Sidebar','inspirar'),
            '2' => __('Right Sidebar','inspirar'),
            '3' => __('No Sidebar','inspirar'),
        ),
        'section' => 'inspirar_blog_section',
        'settings' => 'inspirar_blog_layout'
    ) );

    $wp_customize->add_setting( 'inspirar_blog_post_thumbnail_visibility', array(
        'default'           => true,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_blog_post_thumbnail_visibility', array(
        'label' => __('Show/Hide post thumbnail on index, archives, single post.', 'inspirar'),
        'type' => 'checkbox',
        'section' => 'inspirar_blog_section',
        'settings' => 'inspirar_blog_post_thumbnail_visibility'
    ) );

    $wp_customize->add_setting( 'inspirar_blog_post_meta_visibility', array(
        'default'           => true,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_blog_post_meta_visibility', array(
        'label' => __('Show/Hide post meta on index, archives, single post.', 'inspirar'),
        'type' => 'checkbox',
        'section' => 'inspirar_blog_section',
        'settings' => 'inspirar_blog_post_meta_visibility'
    ) );

    $wp_customize->add_setting( 'inspirar_blog_footer_meta_visibility', array(
        'default'           => true,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_blog_footer_meta_visibility', array(
        'label' => __('Show/Hide post footer meta on index, archives, single post.', 'inspirar'),
        'type' => 'checkbox',
        'section' => 'inspirar_blog_section',
        'settings' => 'inspirar_blog_footer_meta_visibility'
    ) );

    $wp_customize->add_setting( 'inspirar_blog_read_more_btn_visibility', array(
        'default'           => true,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_blog_read_more_btn_visibility', array(
        'label' => __('Show/Hide post read more button on index, archives.', 'inspirar'),
        'type' => 'checkbox',
        'section' => 'inspirar_blog_section',
        'settings' => 'inspirar_blog_read_more_btn_visibility'
    ) );

    $wp_customize->add_setting( 'inspirar_blog_full_content', array(
        'default'           => false,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_blog_full_content', array(
        'label' => __('Check this box to display the full content of your posts on the index, archives.', 'inspirar'),
        'type' => 'checkbox',
        'section' => 'inspirar_blog_section',
        'settings' => 'inspirar_blog_full_content'
    ) );

    $wp_customize->add_setting( 'inspirar_blog_excerpt_length', array(
        'default'           => 30,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control( 'inspirar_blog_excerpt_length', array(
        'label' => __('Blog Excerpt Length', 'inspirar'),
        'type' => 'number',
        'section' => 'inspirar_blog_section',
        'settings' => 'inspirar_blog_excerpt_length',
        'input_attrs' => array(
                'min'   => 10,
                'max'   => 1000,
                'step'  => 1,
        ),  
    ) );

    $wp_customize->add_setting( 'inspirar_blog_related_posts_visibility', array(
        'default'           => true,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_blog_related_posts_visibility', array(
        'label' => __('Show/Hide Related Posts on single post.', 'inspirar'),
        'type' => 'checkbox',
        'section' => 'inspirar_blog_section',
        'settings' => 'inspirar_blog_related_posts_visibility'
    ) );

    // Footer Widgets section
    $wp_customize->add_section( 'inspirar_widgets_section', array(
    	'title'		=> __( 'Footer Widgets Settings', 'inspirar' ),
    	'priority'	=> 1025,
    	'panel'		=> 'inspirar_theme_options'
    ));

    $wp_customize->add_setting( 'inspirar_widgets_section_visiblity', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_widgets_section_visiblity', array(
		'label' => __('Show/Hide Footer Widgets Section', 'inspirar'),
		'type' => 'checkbox',
		'section' => 'inspirar_widgets_section',
		'settings' => 'inspirar_widgets_section_visiblity'
    ) );


    $wp_customize->add_setting( 'inspirar_footer_widgets_section_columns', array(
    	'default' 	        => 4,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'inspirar_sanitize_select'
    ));
    $wp_customize->add_control( 'inspirar_footer_widgets_section_columns', array(
		'label' => __('Number of Footer Columns', 'inspirar'),
		'type' => 'select',
		'choices' => array(
            '1' => __('One Column','inspirar'),
            '2' => __('Two Column','inspirar'),
            '3' => __('Three Column','inspirar'),              
            '4' => __('Four Column','inspirar')
        ),
		'section' => 'inspirar_widgets_section',
		'settings' => 'inspirar_footer_widgets_section_columns'
    ) );

    $wp_customize->add_setting( 'inspirar_footer_widgets_padding_top', array(
        'default'           => '100px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_footer_widgets_padding_top', array(
    	'type' => 'text',
        'label'      => __('Footer Widgets Padding Top', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 100px.', 'inspirar'),
        'section'    => 'inspirar_widgets_section',
        'settings'   => 'inspirar_footer_widgets_padding_top',
    ));


    $wp_customize->add_setting( 'inspirar_footer_widgets_padding_bottom', array(
        'default'           => '100px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_footer_widgets_padding_bottom', array(
    	'type' => 'text',
        'label'      => __('Copyright Padding Bottom', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 100px.', 'inspirar'),
        'section'    => 'inspirar_widgets_section',
        'settings'   => 'inspirar_footer_widgets_padding_bottom',
    ));

    $wp_customize->add_setting( 'inspirar_footer_widgets_section_bg_color', array(
    	'default' 	        => '#252525',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_footer_widgets_section_bg_color', array(
		'label' => __('Footer Widgets Section Background color', 'inspirar'),
		'section' => 'inspirar_widgets_section',
		'settings' => 'inspirar_footer_widgets_section_bg_color'
    )) );

    $wp_customize->add_setting( 'inspirar_footer_widgets_heading_text_fz', array(
        'default'           => '20px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_footer_widgets_heading_text_fz', array(
        'type' => 'text',
        'label'      => __('Heading Text Font Size', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 20px.', 'inspirar'),
        'section'    => 'inspirar_widgets_section',
        'settings'   => 'inspirar_footer_widgets_heading_text_fz',
    ));

    $wp_customize->add_setting( 'inspirar_footer_widgets_heading_text_color', array(
        'default'           => '#fff',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_footer_widgets_heading_text_color', array(
        'label' => __('Heading Text Font color', 'inspirar'),
        'section' => 'inspirar_widgets_section',
        'settings' => 'inspirar_footer_widgets_heading_text_color'
    )) );

    $wp_customize->add_setting( 'inspirar_footer_widgets_link_text_fz', array(
        'default'           => '15px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_footer_widgets_link_text_fz', array(
        'type' => 'text',
        'label'      => __('Link Text Font Size', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 15px.', 'inspirar'),
        'section'    => 'inspirar_widgets_section',
        'settings'   => 'inspirar_footer_widgets_link_text_fz',
    ));

    $wp_customize->add_setting( 'inspirar_footer_widgets_link_text_color', array(
        'default'           => '#ccc',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_footer_widgets_link_text_color', array(
        'label' => __('Link Text Font color', 'inspirar'),
        'section' => 'inspirar_widgets_section',
        'settings' => 'inspirar_footer_widgets_link_text_color'
    )) );

    // Footer Copyright section
    $wp_customize->add_section( 'inspirar_copyright_section', array(
    	'title'		=> __( 'Footer Copyright Settings', 'inspirar' ),
    	'priority'	=> 1030,
    	'panel'		=> 'inspirar_theme_options'
    ));

    $wp_customize->add_setting( 'inspirar_copyright_section_visiblity', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'inspirar_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'inspirar_copyright_section_visiblity', array(
		'label' => __('Show/Hide Copyright Section', 'inspirar'),
		'type' => 'checkbox',
		'section' => 'inspirar_copyright_section',
		'settings' => 'inspirar_copyright_section_visiblity'
    ) );

    $wp_customize->add_setting( 'inspirar_copyright_padding_top', array(
        'default'           => '40px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_copyright_padding_top', array(
    	'type' => 'text',
        'label'      => __('Copyright Padding Top', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 40px.', 'inspirar'),
        'section'    => 'inspirar_copyright_section',
        'settings'   => 'inspirar_copyright_padding_top',
    ));


    $wp_customize->add_setting( 'inspirar_copyright_padding_bottom', array(
        'default'           => '40px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_copyright_padding_bottom', array(
    	'type' => 'text',
        'label'      => __('Copyright Padding Bottom', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 40px.', 'inspirar'),
        'section'    => 'inspirar_copyright_section',
        'settings'   => 'inspirar_copyright_padding_bottom',
    ));

    $wp_customize->add_setting( 'inspirar_copyright_section_text_alignment', array(
    	'default' 	        => 'text-center',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'inspirar_sanitize_select'
    ));
    $wp_customize->add_control( 'inspirar_copyright_section_text_alignment', array(
		'label' => __('Copyright Section Text Alignment', 'inspirar'),
		'type' => 'select',
		'choices' => array(
            'text-left' => __('Align Left','inspirar'),
            'text-center' => __('Align Center','inspirar'),
            'text-right' => __('Align Right','inspirar')               
        ),
		'section' => 'inspirar_copyright_section',
		'settings' => 'inspirar_copyright_section_text_alignment'
    ) );

    $wp_customize->add_setting( 'inspirar_copyright_text', array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('inspirar_copyright_text', array(
    	'type' => 'textarea',
        'label'      => __('Copyright Text', 'inspirar'),
        'description' => __('HTML tags allowed: a, br, strong, em, span', 'inspirar'),
        'section'    => 'inspirar_copyright_section',
        'settings'   => 'inspirar_copyright_text',
    ));

    $wp_customize->add_setting( 'inspirar_copyright_text_fz', array(
        'default'           => '14px',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));

    $wp_customize->add_control('inspirar_copyright_text_fz', array(
    	'type' => 'text',
        'label'      => __('Copyright Text Font Size', 'inspirar'),
        'description'      => __('Enter value including CSS unit (px, em, rem), ex: 14px.', 'inspirar'),
        'section'    => 'inspirar_copyright_section',
        'settings'   => 'inspirar_copyright_text_fz',
    ));

    $wp_customize->add_setting( 'inspirar_copyright_section_border_top_color', array(
    	'default' 	        => '#575757',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_copyright_section_border_top_color', array(
		'label' => __('Copyright Section Border Top color', 'inspirar'),
		'section' => 'inspirar_copyright_section',
		'settings' => 'inspirar_copyright_section_border_top_color'
    )) );

    $wp_customize->add_setting( 'inspirar_copyright_section_bg_color', array(
    	'default' 	        => '#1c1c1c',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_copyright_section_bg_color', array(
		'label' => __('Copyright Section Background color', 'inspirar'),
		'section' => 'inspirar_copyright_section',
		'settings' => 'inspirar_copyright_section_bg_color'
    )) );

    $wp_customize->add_setting( 'inspirar_copyright_section_text_color', array(
    	'default' 	        => '#a9a9a9',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_copyright_section_text_color', array(
		'label' => __('Copyright Text color', 'inspirar'),
		'section' => 'inspirar_copyright_section',
		'settings' => 'inspirar_copyright_section_text_color'
    )) );

    $wp_customize->add_setting( 'inspirar_copyright_section_link_color', array(
    	'default' 	        => '#fff',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_copyright_section_link_color', array(
		'label' => __('Copyright Link color', 'inspirar'),
		'section' => 'inspirar_copyright_section',
		'settings' => 'inspirar_copyright_section_link_color'
    )) );

    $wp_customize->add_setting( 'inspirar_copyright_section_link_hover_color', array(
    	'default' 	        => '#a9a9a9',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inspirar_copyright_section_link_hover_color', array(
		'label' => __('Copyright Link Hover color', 'inspirar'),
		'section' => 'inspirar_copyright_section',
		'settings' => 'inspirar_copyright_section_link_hover_color'
    )) );






}
add_action( 'customize_register', 'inspirar_customize_register' );



// setup theme custom styling
function inspirar_custom_styling(){

	// general variable
	$inspirar_site_padding_top = get_theme_mod('inspirar_site_padding_top');
	$inspirar_site_padding_bottom = get_theme_mod('inspirar_site_padding_bottom');

	// header variable
    $inspirar_logo_width = get_theme_mod('inspirar_logo_width');
    $inspirar_logo_height = get_theme_mod('inspirar_logo_height');
    $inspirar_logo_left_margin = get_theme_mod('inspirar_logo_left_margin');
    $inspirar_logo_uc = get_theme_mod('inspirar_logo_uc');
    $inspirar_logo_font_color = get_theme_mod('inspirar_logo_font_color');
    $inspirar_logo_font_size = get_theme_mod('inspirar_logo_font_size');
    $inspirar_logo_font_weight = get_theme_mod('inspirar_logo_font_weight');
    $inspirar_tagline_visibility = get_theme_mod('inspirar_tagline_visibility', true);
    $inspirar_tagline_uc = get_theme_mod('inspirar_tagline_uc');
    $inspirar_tagline_font_size = get_theme_mod('inspirar_tagline_font_size');
    $inspirar_tagline_font_color = get_theme_mod('inspirar_tagline_font_color');

	// main menu variable
	$inspirar_menu_bg_color = get_theme_mod('inspirar_menu_bg_color');
    $inspirar_main_menu_fz = get_theme_mod('inspirar_main_menu_fz');
    $inspirar_main_menu_fw = get_theme_mod('inspirar_main_menu_fw');
    $inspirar_main_menu_text_transform = get_theme_mod('inspirar_main_menu_text_transform');
	$inspirar_menu_text_color = get_theme_mod('inspirar_menu_text_color');
	$inspirar_menu_text_hover_color = get_theme_mod('inspirar_menu_text_hover_color');
	$inspirar_menu_text_border_color = get_theme_mod('inspirar_menu_border_hover_color');

    $inspirar_sub_menu_width = get_theme_mod('inspirar_sub_menu_width');
    $inspirar_sub_menu_fz = get_theme_mod('inspirar_sub_menu_fz');
    $inspirar_sub_menu_fw = get_theme_mod('inspirar_sub_menu_fw');
    $inspirar_sub_menu_text_transform = get_theme_mod('inspirar_sub_menu_text_transform');
    $inspirar_sub_menu_bg_color = get_theme_mod('inspirar_sub_menu_bg_color');
    $inspirar_sub_menu_font_color = get_theme_mod('inspirar_sub_menu_font_color');
    $inspirar_sub_menu_font_hover_color = get_theme_mod('inspirar_sub_menu_font_hover_color');
    $inspirar_sub_menu_border_color = get_theme_mod('inspirar_sub_menu_border_color');

    // page banner variable
    $inspirar_page_banner_height = get_theme_mod('inspirar_page_banner_height');
    $inspirar_page_banner_bg_color = get_theme_mod('inspirar_page_banner_bg_color');
    $inspirar_page_banner_bg_blend_mode = get_theme_mod('inspirar_page_banner_bg_blend_mode', true);
    $inspirar_page_banner_bg_opacity = get_theme_mod('inspirar_page_banner_bg_opacity');
    $inspirar_page_banner_font_color = get_theme_mod('inspirar_page_banner_font_color');
    $inspirar_page_banner_font_size = get_theme_mod('inspirar_page_banner_font_size');

    // page breadcrumbs variable
    $inspirar_page_breadcrumbs_font_color = get_theme_mod('inspirar_page_breadcrumbs_font_color');
    $inspirar_page_breadcrumbs_active_font_color = get_theme_mod('inspirar_page_breadcrumbs_active_font_color');
    $inspirar_page_breadcrumbs_font_size = get_theme_mod('inspirar_page_breadcrumbs_font_size');

	// footer widgets variable
    $inspirar_footer_widgets_padding_top = get_theme_mod('inspirar_footer_widgets_padding_top');
    $inspirar_footer_widgets_padding_bottom = get_theme_mod('inspirar_footer_widgets_padding_bottom');
    $inspirar_footer_widgets_section_bg_color = get_theme_mod('inspirar_footer_widgets_section_bg_color');
    $inspirar_footer_widgets_heading_text_fz = get_theme_mod('inspirar_footer_widgets_heading_text_fz');
    $inspirar_footer_widgets_heading_text_color = get_theme_mod('inspirar_footer_widgets_heading_text_color');
    $inspirar_footer_widgets_link_text_fz = get_theme_mod('inspirar_footer_widgets_link_text_fz');
    $inspirar_footer_widgets_link_text_color = get_theme_mod('inspirar_footer_widgets_link_text_color');

	// footer copright variable
    $inspirar_copyright_section_border_top_color = get_theme_mod('inspirar_copyright_section_border_top_color');
    $inspirar_copyright_section_bg_color = get_theme_mod('inspirar_copyright_section_bg_color');
    $inspirar_copyright_text_fz = get_theme_mod('inspirar_copyright_text_fz');
    $inspirar_copyright_padding_top = get_theme_mod('inspirar_copyright_padding_top');
    $inspirar_copyright_padding_bottom = get_theme_mod('inspirar_copyright_padding_bottom');
    $inspirar_copyright_section_text_color = get_theme_mod('inspirar_copyright_section_text_color');
    $inspirar_copyright_section_link_color = get_theme_mod('inspirar_copyright_section_link_color');
    $inspirar_copyright_section_link_hover_color = get_theme_mod('inspirar_copyright_section_link_hover_color');

	$output = '';

	// general css
    if( $inspirar_site_padding_top ){
        $output .= '.inspirar-content-area { padding-top:' . $inspirar_site_padding_top .' }';
    }
    if( $inspirar_site_padding_bottom ){
        $output .= '.inspirar-content-area { padding-bottom:' . $inspirar_site_padding_bottom .' }';
    }
	// header css
    if( $inspirar_logo_width ){
        $output .= '.site-logo img{ width:' . $inspirar_logo_width .' }';
    }

    if( $inspirar_logo_height ){
        $output .= '.site-logo img{ height:' . $inspirar_logo_height .' }';
    }

    if( $inspirar_logo_uc ){
        $output .= '.heading_nav_default .site-logo h1.site-title { text-transform: uppercase; }';
    }
    
    if( $inspirar_logo_font_color ){
        $output .= '.heading_nav_default .site-logo h1.site-title a { color:' . $inspirar_logo_font_color .' }';
    }

    if( $inspirar_logo_font_size ){
        $output .= '.heading_nav_default .site-logo h1.site-title { font-size:' . $inspirar_logo_font_size .' }';
    }

    if( $inspirar_logo_font_weight ){
        $output .= '.heading_nav_default .site-logo h1.site-title { font-weight:' . $inspirar_logo_font_weight .' }';
    }

    if( $inspirar_tagline_visibility ){
        $output .= '.heading_nav_default .site-logo p.site-description { display: block; }';
    } else {
        $output .= '.heading_nav_default .site-logo p.site-description { display: none; }';
    }

    if( $inspirar_tagline_uc ){
        $output .= '.heading_nav_default .site-logo p.site-description { text-transform: uppercase; }';
    }

    if( $inspirar_tagline_font_size ){
        $output .= '.heading_nav_default .site-logo p.site-description { font-size:' . $inspirar_tagline_font_size .' }';
    }

    if( $inspirar_tagline_font_color ){
        $output .= '.heading_nav_default .site-logo p.site-description { color:' . $inspirar_tagline_font_color .' }';
    }

	// main menu css
	if( $inspirar_menu_bg_color ){
		$output .= '.heading_nav_default, .heading_nav_default.lawyer-menu{ background:' . $inspirar_menu_bg_color .' !important }';
	}

    if( $inspirar_main_menu_text_transform ){
        $output .= '.heading_nav_default ul li a { text-transform: capitalize; }';
    }

    if( $inspirar_main_menu_fz ){
        $output .= '.heading_nav_default ul li a { font-size:' . $inspirar_main_menu_fz .' }';
    }

    if( $inspirar_main_menu_fw ){
        $output .= '.heading_nav_default ul li a { font-weight:' . $inspirar_main_menu_fw .' }';
    }

	if( $inspirar_menu_text_color ){
		$output .= '.heading_nav_default ul li a{ color:' . $inspirar_menu_text_color .' }';
	}

	if( $inspirar_menu_text_hover_color ){
		$output .= '.heading_nav_default ul li a:hover{ color:' . $inspirar_menu_text_hover_color .' }';
	}

	if( $inspirar_menu_text_border_color ){
		$output .= 'ul.nav li a:after { background-color:' . $inspirar_menu_text_border_color .' }';
	}

    if( $inspirar_sub_menu_width ){
        $output .= '.main-navigation ul ul a { width:' . $inspirar_sub_menu_width .' }';
    }

    if( $inspirar_sub_menu_bg_color ){
        $output .= '.main-navigation ul ul { background-color:' . $inspirar_sub_menu_bg_color .' }';
    }

    if( $inspirar_sub_menu_fz ){
        $output .= '.main-navigation ul ul a { font-size:' . $inspirar_sub_menu_fz .' }';
    }

    if( $inspirar_sub_menu_fw ){
        $output .= '.main-navigation ul ul a { font-weight:' . $inspirar_sub_menu_fw .' }';
    }

    if( $inspirar_sub_menu_text_transform ){
        $output .= '.main-navigation ul ul a { text-transform: capitalize; }';
    }

    if( $inspirar_sub_menu_font_color ){
        $output .= '.main-navigation ul ul a { color:' . $inspirar_sub_menu_font_color .' }';
    }

    if( $inspirar_sub_menu_font_hover_color ){
        $output .= '.main-navigation ul ul a:hover { color:' . $inspirar_sub_menu_font_hover_color .' }';
    }
    
    if( $inspirar_sub_menu_border_color ){
        $output .= '.main-navigation ul ul a { color:' . $inspirar_sub_menu_border_color .' }';
    }

    // page banner css
    if( $inspirar_page_banner_height ){
        $output .= '.inspirar-page-banner { height:' . $inspirar_page_banner_height .' }';
    }

    if( $inspirar_page_banner_bg_color ){
        $output .= '.inspirar-page-banner, .site .inspirar-page-banner.overlay:before { background-color:' . $inspirar_page_banner_bg_color .' }';
    }

    if( $inspirar_page_banner_bg_blend_mode ){
        $output .= '.site .inspirar-page-banner { background-blend-mode: overlay; }';
        $output .= '.site .inspirar-page-banner.overlay:before { background-color: transparent; opacity:1; }';
    }

    if( $inspirar_page_banner_bg_opacity ){
        $output .= '.inspirar-page-banner, .site .inspirar-page-banner.overlay:before { opacity:' . $inspirar_page_banner_bg_opacity .' }';
    }

    if( $inspirar_page_banner_font_color ){
        $output .= '.inspirar-page-banner .inspirar-page-banner-content .inspirar-header-title h1 { color:' . $inspirar_page_banner_font_color .' }';
    }

    if( $inspirar_page_banner_font_size ){
        $output .= '.inspirar-page-banner .inspirar-page-banner-content .inspirar-header-title h1 { font-size:' . $inspirar_page_banner_font_size .' }';
    }

    // page breadcrumbs css
    if( $inspirar_page_breadcrumbs_font_size ){
        $output .= '.inspirar-page-banner .inspirar-page-banner-content ul.inspirar-breadcrumbs li { font-size:' . $inspirar_page_breadcrumbs_font_size .' }';
    }

    if( $inspirar_page_breadcrumbs_font_color ){
        $output .= '.inspirar-page-banner .inspirar-page-banner-content ul.inspirar-breadcrumbs li a, .inspirar-page-banner .inspirar-page-banner-content ul.inspirar-breadcrumbs li span { color:' . $inspirar_page_breadcrumbs_font_color .' }';
    }

    if( $inspirar_page_breadcrumbs_active_font_color ){
        $output .= '.inspirar-page-banner .inspirar-page-banner-content ul.inspirar-breadcrumbs li span, .inspirar-page-banner .inspirar-page-banner-content ul.inspirar-breadcrumbs span.separator { color:' . $inspirar_page_breadcrumbs_active_font_color .' }';
    }

	// footer widgets css
	if( $inspirar_footer_widgets_section_bg_color ){
		$output .= '.footer-widgets{ background-color:' . $inspirar_footer_widgets_section_bg_color .' }';
	}

    if( $inspirar_footer_widgets_padding_top ){
		$output .= '.footer-widgets{ padding-top:' . $inspirar_footer_widgets_padding_top .' }';
	}

	if( $inspirar_footer_widgets_padding_top ){
		$output .= '.footer-widgets{ padding-bottom:' . $inspirar_footer_widgets_padding_bottom .' }';
	}

    if( $inspirar_footer_widgets_heading_text_fz ){
        $output .= '.footer-widgets .widget h3.widget-title { font-size:' . $inspirar_footer_widgets_heading_text_fz .' }';
    }

    if( $inspirar_footer_widgets_heading_text_color ){
        $output .= '.footer-widgets .widget h3.widget-title { color:' . $inspirar_footer_widgets_heading_text_color .' }';
    }

    if( $inspirar_footer_widgets_link_text_color ){
        $output .= '.footer-widgets .widget ul li a { color:' . $inspirar_footer_widgets_link_text_color .' }';
    }

    if( $inspirar_footer_widgets_link_text_fz ){
        $output .= '.footer-widgets .widget ul li a { font-size:' . $inspirar_footer_widgets_link_text_fz .' }';
    }

	// footer copright css
	if( $inspirar_copyright_section_bg_color ){
		$output .= '.site-copyright{ background-color:' . $inspirar_copyright_section_bg_color .' }';
	}

	if( $inspirar_copyright_section_border_top_color ){
		$output .= '.site-copyright{ border-top: 1px solid ' . $inspirar_copyright_section_border_top_color .' }';
	}

    if( $inspirar_copyright_padding_top ){
		$output .= '.site-copyright{ padding-top:' . $inspirar_copyright_padding_top .' }';
	}

	if( $inspirar_copyright_padding_bottom ){
		$output .= '.site-copyright{ padding-bottom:' . $inspirar_copyright_padding_bottom .' }';
	}

	if( $inspirar_copyright_text_fz ){
		$output .=  '.site-copyright p, .site-copyright a{ font-size:' . $inspirar_copyright_text_fz .'}';
	}

	if( $inspirar_copyright_section_text_color ){
		$output .=  '.site-copyright p, .site-copyright a{ color:' . $inspirar_copyright_section_text_color .' }';
	}

	if( $inspirar_copyright_section_link_color ){
		$output .=  '.site-copyright p a, .site-copyright p span, .site-copyright a span{ color:' . $inspirar_copyright_section_link_color .' }';
	}

	if( $inspirar_copyright_section_link_hover_color ){
		$output .=  '.site-copyright p a:hover, .site-copyright p span:hover, .site-copyright a span:hover{ color:' . $inspirar_copyright_section_link_hover_color .' }';
	}

    $output = esc_attr($output);

    wp_add_inline_style( 'inspirar-style', $output );

}
add_action( 'wp_enqueue_scripts', 'inspirar_custom_styling' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function inspirar_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function inspirar_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

// Sanitization to validate that the input value is an integer
function inspirar_sanitize_number( $input ){
    return absint( $input );
}

// Sanitization to validate that the input value is true
function inspirar_sanitize_checkbox( $input ){
    return ( isset( $input ) && true == $input ? true : false );
}

function inspirar_sanitize_select( $input, $setting ){
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                     
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


 //file input sanitization function
function inspirar_sanitize_file( $file, $setting ) {
    //allowed file types
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png'
    );
     
    //check file type from file name
    $file_ext = wp_check_filetype( $file, $mimes );
     
    //if file has a valid mime type return it, otherwise return default
    return ( $file_ext['ext'] ? $file : $setting->default );
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function inspirar_customize_preview_js() {
	wp_enqueue_script( 'inspirar-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'inspirar_customize_preview_js' );
