<?php
/**
 * blogwaves functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blogwaves
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'blogwaves_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blogwaves_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on blogwaves, use a find and replace
		 * to change 'blogwaves' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'blogwaves', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header-menu' => esc_html__( 'Primary Menu', 'blogwaves' ),
				'top-menu' => esc_html__( 'Top Menu', 'blogwaves' ),
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
				'blogwaves_custom_background_args',
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
endif;
add_action( 'after_setup_theme', 'blogwaves_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogwaves_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blogwaves_content_width', 640 );
}
add_action( 'after_setup_theme', 'blogwaves_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogwaves_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'blogwaves' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here.', 'blogwaves' ),
			'before_widget' => '<div id="%1$s" class="widget sidebar-post sidebar %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="sidebar-title"><h3 class="title mb-20">',
			'after_title'   => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Widgets', 'blogwaves' ),
			'id'            => 'footer-widgets',
			'description'   => __( 'Add widgets here.', 'blogwaves' ),
			'before_widget' => '<div class="%2$s footer-widget col-md-3 col-sm-6 col-xs-12">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="sidebar-title"><h3 class="widget-title mb-20">',
			'after_title'   => '</h3></div>',
		)
	);
}
add_action( 'widgets_init', 'blogwaves_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blogwaves_scripts() {
	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
	wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
	wp_enqueue_style('blogwaves-meanmenu-css', get_template_directory_uri() . '/assets/css/meanmenu.css');
	wp_enqueue_style('blogwaves-responsive-css', get_template_directory_uri() . '/assets/css/responsive.css');
	wp_enqueue_style('blogwaves-custom-css', get_template_directory_uri() . '/assets/css/custom.css');


	wp_enqueue_style( 'blogwaves-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'blogwaves-style', 'rtl', 'replace' );

	wp_enqueue_script( 'blogwaves-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/assets/js/popper.min.js',array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js',array(), _S_VERSION, true );
	wp_enqueue_script( 'blogwaves-meanmenu-js', get_template_directory_uri() . '/assets/js/meanmenu.js',array(), _S_VERSION, true );
	wp_enqueue_script( 'blogwaves-main-js', get_template_directory_uri() . '/assets/js/main.js',array(), _S_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blogwaves_scripts' );

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
require get_template_directory() . '/inc/controls.php';

require get_template_directory() . '/inc/customizer.php';