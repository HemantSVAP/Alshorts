<?php

/**
 * alshorts functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package alshorts
 */
/**
 * Include New Custom Function File.
 */
require_once get_parent_theme_file_path('/inc/sub-function.php');

/**
 * Disable automatic WordPress plugin updates
 */
add_filter('auto_update_plugin', '__return_false');

/**
 * Disable automatic WordPress theme updates
 */
add_filter('auto_update_theme', '__return_false');

/**
 * https://www.wpoptimus.com/626/7-ways-disable-update-wordpress-notifications/
 * To Disable Update WordPress nag :
 * To Disable all the Nags & Notifications :
 */
add_action('after_setup_theme', 'remove_core_updates');
add_filter('pre_site_transient_update_core', 'remove_core_updates');
add_filter('pre_site_transient_update_plugins', 'remove_core_updates');
add_filter('pre_site_transient_update_themes', 'remove_core_updates');

function remove_core_updates() {
    global $wp_version;
    return(object) array('last_checked' => time(), 'version_checked' => $wp_version,);
    if (!current_user_can('update_core')) {
        return;
    }
    add_action('init', create_function('$a', "remove_action( 'init', 'wp_version_check' );"), 2);
    add_filter('pre_option_update_core', '__return_null');
    add_filter('pre_site_transient_update_core', '__return_null');
}

/**
 * https://www.wpoptimus.com/626/7-ways-disable-update-wordpress-notifications/
 * To Disable Plugin Update Notifications :
 */
add_filter('pre_site_transient_update_plugins', '__return_null');
remove_action('load-update-core.php', 'wp_update_plugins');

/**
 * Disable all plugins updates
 */
add_filter('site_transient_update_plugins', '__return_false');

/**
 * Disable Admin Bar for All Users Except for Administrators
 */
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    //if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
    //}
}

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

if (!function_exists('alshorts_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function alshorts_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on alshorts, use a find and replace
         * to change 'alshorts' to the name of your theme in all the template files.
         */
        load_theme_textdomain('alshorts', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
                array(
                    'menu-1' => esc_html__('Primary', 'alshorts'),
                )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
                'html5', array(
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
                'custom-background', apply_filters(
                        'alshorts_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
                        )
                )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
                'custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
                )
        );
        
        add_image_size('blogs-front-image', 376, 242, true); //Front page Blogs image size.
        add_image_size('blogs-detail-image', 990, 468, true); //Blogs Details image size.
        add_image_size('blogs-detail-more-list-image', 418, 207, true); //Blogs Details List image size.
    }

endif;
add_action('after_setup_theme', 'alshorts_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function alshorts_content_width() {
    $GLOBALS['content_width'] = apply_filters('alshorts_content_width', 640);
}

add_action('after_setup_theme', 'alshorts_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function alshorts_widgets_init() {
    register_sidebar(
            array(
                'name' => esc_html__('Sidebar', 'alshorts'),
                'id' => 'sidebar-1',
                'description' => esc_html__('Add widgets here.', 'alshorts'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            )
    );
}

add_action('widgets_init', 'alshorts_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function alshorts_scripts() {

    // Theme bootstrap stylesheet.
    wp_enqueue_style('alshorts-bootstrap-style', get_theme_file_uri('/css/bootstrap.min.css'), array(), false, 'all');

    //Theme slick stylesheet.
    wp_enqueue_style('alshorts-slick-style', get_theme_file_uri('/css/slick.css'), array(), false, 'all');

    //Theme slick-theme stylesheet.
    wp_enqueue_style('alshorts-slick-theme-style', get_theme_file_uri('/css/slick-theme.css'), array(), false, 'all');

    // Theme stylesheet.
    wp_enqueue_style('alshorts-style', get_stylesheet_uri(), array(), _S_VERSION);

    //Theme responsive stylesheet.
    wp_enqueue_style('alshorts-responsive-style', get_theme_file_uri('/css/responsive.css'), array(), false, 'all');

    //wp_style_add_data('alshorts-style', 'rtl', 'replace');
    //Theme jquery min script.
    wp_enqueue_script('alshorts-jquery-min-script', get_theme_file_uri('/js/jquery.min.js'), array('jquery'), false, true);

    //Theme bootstrap min script.
    wp_enqueue_script('alshorts-bootstrap-min-script', get_theme_file_uri('/js/bootstrap.min.js'), array('jquery'), false, true);

    //Theme slick script.
    wp_enqueue_script('alshorts-slick-script', get_theme_file_uri('/js/slick.js'), array('jquery'), false, true);

    //Theme custom script.
    wp_enqueue_script('alshorts-custom-script', get_theme_file_uri('/js/custom.js'), array('jquery'), false, true);
}

add_action('wp_enqueue_scripts', 'alshorts_scripts');

/**
 * To create an options page
 */
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Header Settings',
        'menu_title' => 'Header',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Footer Settings',
        'menu_title' => 'Footer',
        'parent_slug' => 'theme-general-settings',
    ));
}

/**
 * Disabled the Add New button from the Contacts CPT
 */
add_action('admin_menu', 'disable_new_contacts_posts');

function disable_new_contacts_posts() {
    // Hide sidebar link
    global $submenu;
    unset($submenu['edit.php?post_type=contacts']);
    // Hide link on listing page
    if (isset($_GET['post_type']) && $_GET['post_type'] == 'contacts') {
        echo '<style type="text/css">
        #favorite-actions, .add-new-h2, .tablenav { display:none; }
        </style>';
    }
}

/**
 * Remove Auto paragraph from post type.
 */
remove_filter('the_content', 'wpautop');

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

