<?php

/**
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('ABSPATH') || die(http_response_code(418));

  $dbversion = '0.0.1';
  global $wpdb;
  if (($wpdb->get_results("SELECT option_value FROM $wpdb->wp_options WHERE option_name = 'sp_db_version'")) == null) {
    $wpdb->insert( 'wp_options', array('option_value' => '0.0.0', 'option_name' => 'sp_db_version', 'autoload' => 'yes') );
  }
  $currentversion = $wpdb->get_results("SELECT option_value FROM $wpdb->wp_options WHERE option_name = 'sp_db_version'");

if ($dbversion != $currentversion) {
  if ($dbversion != '0.0.0') {
  $taxid = $wpdb->get_results("SELECT term_id FROM $wpdb->wp_term_taxonomy WHERE taxonomy = 'systemwide'");
  $objectid = $wpdb->get_results("SELECT object_id FROM $wpdb->wp_term_relationships WHERE term_taxonomy_id = '$taxid'");

  foreach ($objectid as $x => $val) {
    $wpdb->delete( 'wp_posts', array( 'id' => $val ) );
    $wpdb->delete( 'wp_posts', array( 'post_parent' => $val ) );
    $wpdb->delete( 'wp_postmeta', array( 'post_id' => $val ) );
    $wpdb->delete( 'wp_term_relationships', array( 'object_id' => $val ) );
  }
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
      $wpdb->insert( 'wp_postmeta', array( 'post_id' => $val, '_links_to' => '#', '_links_to_target' => '_blank', '_thumbnail_id' => '81' ) );
      $wpdb->insert( 'wp_term_relationships', array( 'object_id' => $val, 'term_taxonomy_id' => $taxid, 'term_order' => '0' ) );
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
      $wpdb->insert( 'wp_postmeta', array( 'post_id' => $val, '_links_to' => '#', '_links_to_target' => '_blank', '_thumbnail_id' => '81' ) );
      $wpdb->insert( 'wp_term_relationships', array( 'object_id' => $val, 'term_taxonomy_id' => $taxid, 'term_order' => '0' ) );
  }

  $wpdb->update( 'wp_options', array('option_value' => $dbversion) , array('option_name' => 'sp_db_version') );

}
