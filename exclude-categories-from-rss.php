<?php
/**
 * Plugin Name: Exclude Categories from RSS Feed
 * Plugin URI:  # https://github.com/vestrainteractive/exclude-categories-from-rss
 * Description: Exclude specific categories from your WordPress RSS feed.
 * Version: 1.0
 * Author: Vestra Interactive
 * Author URI: # https://vestrainteractive.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Define the excluded category IDs (replace with your actual IDs)
$excluded_categories = array(Your,Categories,Here); // Example: Exclude categories with IDs 1, 3, and 5

add_filter('pre_get_posts', 'exclude_categories_from_feed');

function exclude_categories_from_feed($query) {
  global $excluded_categories;

  if (is_feed()) {
    $query->set('category__not_in', $excluded_categories);
  }
  return $query;
}

// Include the GitHub Updater class
add_action('plugins_loaded', function() {
    $file = plugin_dir_path( __FILE__ ) . 'class-github-updater.php';

    if ( file_exists( $file ) ) {
        require_once $file;
        error_log( 'GitHub Updater file included successfully.' );
    } else {
        error_log( 'GitHub Updater file not found at: ' . $file );
    }

    // Ensure the class exists before instantiating
    if ( class_exists( 'GitHub_Updater' ) ) {
        // Initialize the updater
        new GitHub_Updater( 'exclude-categories-from-rss', 'https://github.com/vestrainteractive/exclude-categories-from-rss', '1.0.0' ); // Replace with actual values
        error_log( 'GitHub Updater class instantiated.' );
    } else {
        error_log( 'GitHub_Updater class not found.' );
    }
});
