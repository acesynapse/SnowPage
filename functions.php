<?php

/**
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('ABSPATH') || die(http_response_code(418));

// Note: This file must be PHP 5.2 compatible.

// Check min. required version of Gantry 5
$requiredGantryVersion = '5.5';
$translationDomain = 'snowpage';

// Bootstrap Gantry framework or fail gracefully.
$gantry_include = locate_template('/custom/includes/gantry.php') ?: locate_template('/includes/gantry.php');
if (!$gantry_include) {
    wp_die('Gantry theme is missing a file: includes/gantry.php');
}

$gantry = require $gantry_include;
if (!$gantry) {
    return;
}

if (!$gantry->isCompatible($requiredGantryVersion)) {
    $current_theme = \wp_get_theme();
    $error = sprintf(\__('Please upgrade Gantry 5 Framework to v%s (or later) before using %s theme!', $translationDomain), strtoupper($requiredGantryVersion), $current_theme->get('Name'));

    if(\is_admin()) {
        \add_action('admin_notices', static function () use ($error) {
            echo '<div class="error"><p>' . $error . '</p></div>';
        });
    } else {
        \wp_die($error);
    }
}

/** @var \Gantry\Framework\Theme $theme */
$theme = $gantry['theme'];

// Theme helper files that can contain useful methods or filters
$helpers = array(
    'includes/helper.php', // General helper file
);

// Require custom Functions if the file exists (allows overriding helpers).
if ($customInclude = locate_template('custom/functions.php')) {
    require $customInclude;
}

foreach ($helpers as $file) {
    if (!$filepath = \locate_template($file)) {
        trigger_error(sprintf(\__('Error locating %s for inclusion', $translationDomain), $file), E_USER_ERROR);
    }

    require $filepath;
}

require_once 'snowpage-activation.php';

if(!file_exists('databases.php')) {
      return;
    } else {
    require_once 'databases.php';
  }

/*
* Databases Custom Post Type
*
*/

function custom_post_databases() {

// Set UI labels
    $labels = array(
        'name'                => _x( 'Databases', 'Post Type General Name'),
        'singular_name'       => _x( 'Database', 'Post Type Singular Name'),
        'menu_name'           => __( 'Databases'),
        'parent_item_colon'   => __( 'Parent Database'),
        'all_items'           => __( 'All Databases'),
        'view_item'           => __( 'View Databases'),
        'add_new_item'        => __( 'Add New Database'),
        'add_new'             => __( 'Add New'),
        'edit_item'           => __( 'Edit Database'),
        'update_item'         => __( 'Update Database'),
        'search_items'        => __( 'Search Databases'),
        'not_found'           => __( 'Not Found'),
        'not_found_in_trash'  => __( 'Not found in Trash'),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'databases'),
        'description'         => __( 'Databases for Library Patron Use'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,

    );

    // Registering
    register_post_type( 'databases', $args );

}

add_action( 'init', 'custom_post_databases', 0 );
