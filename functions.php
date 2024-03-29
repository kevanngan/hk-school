<?php
/**
 * HK School functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package HK_School
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hk_school_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on HK School, use a find and replace
		* to change 'hk-school' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'hk-school', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// Custom crop images
	add_image_size(
		'student-thumbnail-200px-300px', // name of crop
		200,							 // maximum width of pixels
		300,							 // maximum height of pixels
		true							 // cropped image
	);

	// Custom crop images
	add_image_size(
		'student-thumbnail-300x257',  // name of crop
		300,                          // width in pixels
		257,                          // height in pixels
		true                          // cropped image
	);

	// Custom crop images
	add_image_size(
		'student-thumbnail-284x300',  // name of crop
		284,                          // width in pixels
		300,                          // height in pixels
		true                          // cropped image
	);


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'hk-school' ),
			'footer' => esc_html__( 'Footer Navigation', 'hk-school' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'hk_school_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'hk_school_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hk_school_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hk_school_content_width', 640 );
}
add_action( 'after_setup_theme', 'hk_school_content_width', 0 );


// Add support for Wide and Full alignment options in the block editor
function hk_school_alignment() {
	add_theme_support('align-wide');
    add_theme_support('align-full');
}
add_action( 'after_setup_theme', 'hk_school_alignment', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hk_school_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'hk-school' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'hk-school' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar( 
		array(
			'name'          => esc_html__( 'Footer Image', 'hk-school' ),
			'id'            => 'footer-image-widget-area',
			'description'   => esc_html__( 'Add footer image here.', 'hk-school' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) 
	);
}
add_action( 'widgets_init', 'hk_school_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hk_school_scripts() {
	// Import Open Sans and Inter Google Font
	wp_enqueue_style( 
		'hk-school-googlefonts',   // Unique handle
		'"https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap',   // Url to font css file
		array(),   // Dependencies
		null,      // Version set to null for Google Fonts
		'all'      // Media
	);

	wp_enqueue_style( 'hk-school-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'hk-school-style', 'rtl', 'replace' );

	wp_enqueue_script( 'hk-school-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Import Animate on Scroll css and script
	if ( get_post_type() === 'post' ) {
		wp_enqueue_style(
			'aos-styles',
			get_template_directory_uri() . '/css/aos.css',
			array(),
			'2.3.1'
		);

		wp_enqueue_script(
			'aos-scripts',
			get_template_directory_uri() . '/js/aos.js',
			array(),
			'2.3.1',
			array( 'strategy' => 'defer' )
		);

		// Initialize AOS
		wp_enqueue_script(
			'aos-init', 
			get_template_directory_uri() . '/js/aos_init.js',
			array( 'aos-scripts' ),
			_S_VERSION,
			array( 'strategy' => 'defer' )
		);
	}

}
add_action( 'wp_enqueue_scripts', 'hk_school_scripts' );

/**
 * Register Custom Post Types & Customer Taxnomies
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Change title placeholder for staff cpt
function change_staff_title_placeholder( $title_placeholder ) {
    global $post_type;

    if ( 'hk-staff' === $post_type ) {
        $title_placeholder = 'Add staff name';
    }

    return $title_placeholder;
}
add_filter( 'enter_title_here', 'change_staff_title_placeholder' );

// Change title placeholder for student cpt
function change_student_title_placeholder( $title_placeholder ) {
    global $post_type;

    if ( 'hk-student' === $post_type ) {
        $title_placeholder = 'Add student name';
    }

    return $title_placeholder;
}
add_filter( 'enter_title_here', 'change_student_title_placeholder' );

// This function adds the custom classes to the anchor tags
function add_custom_classes_to_links($html) {
    $custom_classes = 'main-link underline-link';
    $html = str_replace(
		'<a href=', '<a class="' . $custom_classes . '" href=', 
		$html
	);
    return $html;
}
add_filter( 'the_category', 'add_custom_classes_to_links', 999 );
add_filter( 'the_tags', 'add_custom_classes_to_links', 999 );
add_filter( 'term_links-hk-student-category', 'add_custom_classes_to_links', 999 );
add_filter( 'next_post_link', 'add_custom_classes_to_links', 999 );
add_filter( 'previous_post_link', 'add_custom_classes_to_links', 999 );

// This function adds the custom classes to the 'Leave a Comment' link
function add_custom_classes_to_comments_link($attributes) {
	$attributes .= ' class="main-link underline-link"';
    return $attributes;
}
add_filter( 'comments_popup_link_attributes', 'add_custom_classes_to_comments_link', 999 );

function remove_comment_form_cookies_consent($formFields) {
	unset($formFields['cookies']);
	return $formFields;
}

add_filter( 'comment_form_default_fields', 'remove_comment_form_cookies_consent', 999 );