<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use XTS\Options;

/**
 * Performance.
 */
Options::add_section(
	array(
		'id'       => 'performance',
		'name'     => esc_html__( 'Performance', 'woodmart' ),
		'priority' => 150,
		'icon'     => 'dashicons dashicons-performance',
	)
);

Options::add_field(
	array(
		'id'          => 'minified_css',
		'name'        => esc_html__( 'Include minified CSS', 'woodmart' ),
		'description' => esc_html__( 'Minified version of style.css file will be loaded (style.min.css)', 'woodmart' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => '1',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'minified_js',
		'name'        => esc_html__( 'Include minified JS', 'woodmart' ),
		'description' => esc_html__( 'Minified version of functions.js file will be loaded', 'woodmart' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => '1',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'combined_js',
		'name'        => esc_html__( 'Combine JS files', 'woodmart' ),
		'description' => esc_html__( 'Combine all third party libraries and theme functions into one JS file (theme.min.js)', 'woodmart' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => false,
		'priority'    => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'disable_nanoscroller',
		'name'        => esc_html__( 'Nanoscroller library', 'woodmart' ),
		'description' => esc_html__( 'This library adds nice style to elements with scroll bar like cart widget, filters widget, AJAX search results etc. In modern browsers we can style them without this JS libary so you can disable it.', 'woodmart' ),
		'type'        => 'buttons',
		'section'     => 'performance',
		'default'     => 'enable',
		'options'     => array(
			'enable'  => array(
				'name'  => esc_html__( 'Enable', 'woodmart' ),
				'value' => 'enable',
			),
			'disable' => array(
				'name'  => esc_html__( 'Disable', 'woodmart' ),
				'value' => 'disable',
			),
			'webkit'  => array(
				'name'  => esc_html__( 'Enable for old browsers', 'woodmart' ),
				'value' => 'webkit',
			),
		),
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'disable_owl_mobile_devices',
		'name'        => esc_html__( 'Disable OWL Carousel script on mobile devices', 'woodmart' ),
		'description' => esc_html__( 'Using native browser\'s scrolling feature on mobile devices may improve your page loading and performance on some devices. Desktop will be handled with OWL Carousel JS library.', 'woodmart' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => false,
		'priority'    => 41,
	)
);

Options::add_field(
	array(
		'id'          => 'google_font_display',
		'name'        => esc_html__( '"font-display" for Google Fonts', 'woodmart' ),
		'description' => 'You can specify "font-display" property for fonts loaded from Google. Read more information <a href="https://developers.google.com/web/updates/2016/02/font-display">here</a>',
		'type'        => 'select',
		'section'     => 'performance',
		'default'     => 'disable',
		'options'     => array(
			'disable'  => array(
				'name'  => esc_html__( 'Disable', 'woodmart' ),
				'value' => 'disable',
			),
			'block' => array(
				'name'  => esc_html__( 'Block', 'woodmart' ),
				'value' => 'block',
			),
			'swap' => array(
				'name'  => esc_html__( 'Swap', 'woodmart' ),
				'value' => 'swap',
			),
			'fallback' => array(
				'name'  => esc_html__( 'Fallback', 'woodmart' ),
				'value' => 'fallback',
			),
			'optional' => array(
				'name'  => esc_html__( 'Optional', 'woodmart' ),
				'value' => 'optional',
			),
		),
		'priority'    => 42,
	)
);

Options::add_field(
	array(
		'id'          => 'icons_font_display',
		'name'        => esc_html__( '"font-display" for icon fonts (not recommended)', 'woodmart' ),
		'description' => 'You can specify "font-display" property for fonts used for icons in our theme including Font Awesome. Read more information <a href="https://developers.google.com/web/updates/2016/02/font-display">here</a>',
		'type'        => 'select',
		'section'     => 'performance',
		'default'     => 'disable',
		'options'     => array(
			'disable'  => array(
				'name'  => esc_html__( 'Disable', 'woodmart' ),
				'value' => 'disable',
			),
			'block' => array(
				'name'  => esc_html__( 'Block', 'woodmart' ),
				'value' => 'block',
			),
			'swap' => array(
				'name'  => esc_html__( 'Swap', 'woodmart' ),
				'value' => 'swap',
			),
			'fallback' => array(
				'name'  => esc_html__( 'Fallback', 'woodmart' ),
				'value' => 'fallback',
			),
			'optional' => array(
				'name'  => esc_html__( 'Optional', 'woodmart' ),
				'value' => 'optional',
			),
		),
		'priority'    => 43,
	)
);

Options::add_field(
	array(
		'id'          => 'disable_font_awesome_theme_css',
		'name'        => esc_html__( 'Disable Font Awesome font', 'woodmart' ),
		'description' => esc_html__( 'This option will remove font awesome CSS files that are loaded in our theme. It is useful when you have other plugins that loads font awesome library too.', 'woodmart' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => false,
		'priority'    => 44,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_loading',
		'name'        => esc_html__( 'Lazy loading for images', 'woodmart' ),
		'description' => esc_html__( 'Enable this option to optimize your images loading on the website. They will be loaded only when user will scroll the page.', 'woodmart' ),
		'group'       => esc_html__( 'Lazy loading options', 'woodmart' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => false,
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_loading_offset',
		'name'        => esc_html__( 'Offset', 'woodmart' ),
		'description' => esc_html__( 'Start load images X pixels before the page is scrolled to the item', 'woodmart' ),
		'group'       => esc_html__( 'Lazy loading options', 'woodmart' ),
		'type'        => 'range',
		'section'     => 'performance',
		'default'     => 0,
		'min'         => 0,
		'step'        => 10,
		'max'         => 1000,
		'priority'    => 90,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_effect',
		'name'        => esc_html__( 'Appearance effect', 'woodmart' ),
		'description' => esc_html__( 'When enabled, your images will be replaced with their blurred small previews. And when the visitor will scroll the page to that image, it will be replaced with an original image.', 'woodmart' ),
		'group'       => esc_html__( 'Lazy loading options', 'woodmart' ),
		'type'        => 'buttons',
		'section'     => 'performance',
		'default'     => 'fade',
		'options'     => array(
			'fade' => array(
				'name'  => esc_html__( 'Fade', 'woodmart' ),
				'value' => 'fade',
			),
			'blur' => array(
				'name'  => esc_html__( 'Blur', 'woodmart' ),
				'value' => 'blur',
			),
			'none' => array(
				'name'  => esc_html__( 'None', 'woodmart' ),
				'value' => 'none',
			),
		),
		'priority'    => 60,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_generate_previews',
		'name'        => esc_html__( 'Generate previews', 'woodmart' ),
		'description' => esc_html__( 'Create placeholders previews as miniatures from the original images.', 'woodmart' ),
		'group'       => esc_html__( 'Lazy loading options', 'woodmart' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => '1',
		'priority'    => 70,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_base_64',
		'name'        => esc_html__( 'Base 64 encode for placeholders', 'woodmart' ),
		'description' => esc_html__( 'This option allows you to decrease a number of HTTP requests replacing images with base 64 encoded sources.', 'woodmart' ),
		'group'       => esc_html__( 'Lazy loading options', 'woodmart' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => '1',
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_proprtion_size',
		'name'        => esc_html__( 'Proportional placeholders size', 'woodmart' ),
		'description' => esc_html__( 'Will generate proportional image size for the placeholder based on original image size.', 'woodmart' ),
		'group'       => esc_html__( 'Lazy loading options', 'woodmart' ),
		'type'        => 'switcher',
		'section'     => 'performance',
		'default'     => '1',
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'lazy_custom_placeholder',
		'name'        => esc_html__( 'Upload custom placeholder image', 'woodmart' ),
		'description' => esc_html__( 'Add your custom image placeholder that will be used before the original image will be loaded.', 'woodmart' ),
		'group'       => esc_html__( 'Lazy loading options', 'woodmart' ),
		'type'        => 'upload',
		'section'     => 'performance',
		'priority'    => 100,
	)
);
