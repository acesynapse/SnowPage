<?php

/**
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('ABSPATH') || die(http_response_code(418));

require_once('../../../wp-config.php');
global $wpdb;

defined('ICEJAM') || database_wipe_and_reinstall ();

function database_wipe_and_reinstall () {
  define('ICEJAM', 1);
  $dbposts = $wpdb->get_results("SELECT ID FROM $wpdb->wp_posts WHERE post_type = 'databases'");
  $wpdb->delete( 'wp_posts', array( 'post_type' => 'databases' ) );
  foreach ($dbposts as $x => $val) {
    $wpdb->delete( 'wp_posts', array( 'post_parent' => $val ) );
    $wpdb->delete( 'wp_postmeta', array( 'post_id' => $val ) );
  }

  $wpdb->insert( 'wp_posts', array(
    'post_author' => '1',
    'post_date' => '2022-01-01 00:00:01',
    'post_date_gmt' => '2022-01-01 00:00:01',
    'post_title' => 'Libby.',
    'post_status' => 'publish',
    'comment_status' => 'closed',
    'ping_status' => 'closed',
    'post_name' => 'libby',
    'post_modified' => '2022-01-01 00:00:01',
    'post_modified_gmt' => '2022-01-01 00:00:01',
    'post_type' => 'databases'
  ) );
  $dbposts = $wpdb->get_results("SELECT ID FROM $wpdb->wp_posts WHERE post_type = 'databases' ORDER BY ID DESC LIMIT 1");
  foreach ($dbposts as $x => $val) {
      $wpdb->insert( 'wp_postmeta', array( 'post_id' => $current_id, '_links_to' => '#', '_links_to_target' => '_blank', '_thumbnail_id' => '81' ) );
  }

  $wpdb->insert( 'wp_posts', array(
    'post_author' => '1',
    'post_date' => '2022-01-01 00:00:01',
    'post_date_gmt' => '2022-01-01 00:00:01',
    'post_title' => 'NovelNY',
    'post_status' => 'publish',
    'comment_status' => 'closed',
    'ping_status' => 'closed',
    'post_name' => 'novelny',
    'post_modified' => '2022-01-01 00:00:01',
    'post_modified_gmt' => '2022-01-01 00:00:01',
    'post_type' => 'databases'
  ) );
  $dbposts = $wpdb->get_results("SELECT ID FROM $wpdb->wp_posts WHERE post_type = 'databases' ORDER BY ID DESC LIMIT 1");
  foreach ($dbposts as $x => $val) {
      $wpdb->insert( 'wp_postmeta', array( 'post_id' => $current_id, '_links_to' => '#', '_links_to_target' => '_blank', '_thumbnail_id' => '81' ) );
  }
}
