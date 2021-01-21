<?php

/**
 * ==================================== Contact CPT ============================
 */

/**
 * Creating a function to create our Contacts CPT
 */
function custom_contacts_post_type() {
// Set UI labels for Custom Post Type
    $labels = array(
        'name' => _x('Contacts', 'Post Type General Name', 'alshorts'),
        'singular_name' => _x('Contact', 'Post Type Singular Name', 'alshorts'),
        'menu_name' => __('Contact', 'alshorts'),
        'parent_item_colon' => __('Parent Contacts', 'alshorts'),
        'all_items' => __('All Contact', 'alshorts'),
        'view_item' => __('View Contacts', 'alshorts'),
        'add_new_item' => __('Add New Contacts', 'alshorts'),
        'add_new' => __('Add New', 'alshorts'),
        'edit_item' => __('Edit Contacts', 'alshorts'),
        'update_item' => __('Update Contacts', 'alshorts'),
        'search_items' => __('Search Contacts', 'alshorts'),
        'not_found' => __('Not Found', 'alshorts'),
        'not_found_in_trash' => __('Not found in Trash', 'alshorts'),
    );

// Set other options for Custom Contacts Post Type
    $args = array(
        'label' => __('contacts', 'alshorts'),
        'description' => __('Contact news and reviews', 'alshorts'),
        'labels' => $labels,
        // Features this CPT supports in Post Editor
        'supports' => array('title', 'editor', 'custom-fields'),
        /** A hierarchical CPT is like Pages and can have
         * Parent and child items. A non-hierarchical CPT
         * is like Posts.
         */
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'query_var' => true,
//        'capabilities' => array(
//            'create_posts' => 'do_not_allow' //Remove the add new button
//        ),
    );

    // Registering your Custom Post Type
    register_post_type('contacts', $args);
}

/** Hook into the 'init' action so that the function
 * Containing our post type registration is not 
 * unnecessarily executed. 
 */
add_action('init', 'custom_contacts_post_type', 0);

/**
 * ==================================== Videos CPT ============================
 */

/**
 * Creating a function to create our Videos CPT
 */
function custom_videos_post_type() {
// Set UI labels for Custom Post Type
    $labels = array(
        'name' => _x('Videos', 'Post Type General Name', 'alshorts'),
        'singular_name' => _x('Video', 'Post Type Singular Name', 'alshorts'),
        'menu_name' => __('Videos', 'alshorts'),
        'parent_item_colon' => __('Parent Video', 'alshorts'),
        'all_items' => __('All Videos', 'alshorts'),
        'view_item' => __('View Video', 'alshorts'),
        'add_new_item' => __('Add New Video', 'alshorts'),
        'add_new' => __('Add New', 'alshorts'),
        'edit_item' => __('Edit Video', 'alshorts'),
        'update_item' => __('Update Video', 'alshorts'),
        'search_items' => __('Search Video', 'alshorts'),
        'not_found' => __('Not Found', 'alshorts'),
        'not_found_in_trash' => __('Not found in Trash', 'alshorts'),
    );
    // Set other options for Custom Videos Post Type
    $args = array(
        'label' => __('videos', 'alshorts'),
        'description' => __('Videos news and reviews', 'alshorts'),
        'labels' => $labels,
        // Features this CPT supports in Post Editor
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies' => array('category'),
        /** A hierarchical CPT is like Pages and can have
         * Parent and child items. A non-hierarchical CPT
         * is like Posts.
         */
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 6,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'query_var' => true,
    );

    // Registering your Custom Post Type
    register_post_type('videos', $args);
}

/** Hook into the 'init' action so that the function
 * Containing our post type registration is not 
 * unnecessarily executed. 
 */
add_action('init', 'custom_videos_post_type', 0);

/**
 * ==================================== Blogs CPT ============================
 */

/**
 * Creating a function to create our Blogs CPT
 */
function custom_blogs_post_type() {
// Set UI labels for Custom Post Type
    $labels = array(
        'name' => _x('Blogs', 'Post Type General Name', 'alshorts'),
        'singular_name' => _x('Blogs', 'Post Type Singular Name', 'alshorts'),
        'menu_name' => __('Blogs', 'alshorts'),
        'parent_item_colon' => __('Parent Blog', 'alshorts'),
        'all_items' => __('All Blogs', 'alshorts'),
        'view_item' => __('View Blog', 'alshorts'),
        'add_new_item' => __('Add New Blog', 'alshorts'),
        'add_new' => __('Add New', 'alshorts'),
        'edit_item' => __('Edit Blog', 'alshorts'),
        'update_item' => __('Update Blog', 'alshorts'),
        'search_items' => __('Search Blog', 'alshorts'),
        'not_found' => __('Not Found', 'alshorts'),
        'not_found_in_trash' => __('Not found in Trash', 'alshorts'),
    );
    // Set other options for Custom Blogs Post Type
    $args = array(
        'label' => __('blogs', 'alshorts'),
        'description' => __('Blogs news and reviews', 'alshorts'),
        'labels' => $labels,
        // Features this CPT supports in Post Editor
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies' => array('category'),
        /** A hierarchical CPT is like Pages and can have
         * Parent and child items. A non-hierarchical CPT
         * is like Posts.
         */
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 7,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'query_var' => true,
    );

    // Registering your Custom Post Type
    register_post_type('blogs', $args);
}

/** Hook into the 'init' action so that the function
 * Containing our post type registration is not 
 * unnecessarily executed. 
 */
add_action('init', 'custom_blogs_post_type', 0);

/**
 * Modify main query on post type archive page
 * CPT Blogs
 */
add_action('pre_get_posts', 'wpse222471_query_blogs_post_type_portofolio', 1, 1);

function wpse222471_query_blogs_post_type_portofolio($query) {
    if (!is_admin() && is_post_type_archive('blogs') && $query->is_main_query()) {
        $query->set('post_status', 'publish');
        $query->set('orderby', 'ID');
        $query->set('order', 'DESC');
        $query->set('posts_per_page', 6); //set query arg ( key, value )
    }
}
?>

