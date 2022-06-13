<?php

/**
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('ABSPATH') || die(http_response_code(418));

if (defined('ICEJAM')) {
  exit();
} else {
  define('ICEJAM', 1);
  $dbposts = $wpdb->get_results("SELECT ID FROM $wpdb->wp_posts WHERE post_type = 'databases'");
  $wpdb->delete( 'wp_posts', array( 'post_type' => 'databases' ) );
  foreach ($dbposts as $x => $val) {
    $wpdb->delete( 'wp_posts', array( 'post_parent' => $val ) );
    $wpdb->delete( 'wp_postmeta', array( 'post_id' => $val ) );
  }
}
