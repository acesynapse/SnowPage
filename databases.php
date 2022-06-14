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
  if (!($wpdb->get_results("SELECT option_name FROM wp_options WHERE option_name = 'sp_db_version'"))) {
    $wpdb->insert( 'wp_options', array('option_name' => 'sp_db_version', 'option_value' => '0.0.0', 'autoload' => 'yes') );
  }
  $currentversionobject = $wpdb->get_results("SELECT option_value FROM wp_options WHERE option_name = 'sp_db_version'");
  $currentversionarray = json_decode(json_encode($currentversionobject), true);
  $currentversion = $currentversionarray[0]['option_value'];

if ($dbversion != $currentversion) {
  if ($dbversion != '0.0.0') {
  $taxidobject = $wpdb->get_results("SELECT term_id FROM wp_term_taxonomy WHERE taxonomy = 'systemwide'");
  $taxidarray = json_decode(json_encode($taxidobject), true);
  $taxid = $taxidarray[0]['term_id'];
  $objectidobject = $wpdb->get_results("SELECT object_id FROM wp_term_relationships WHERE term_taxonomy_id = $taxid");
  $objectidarray = json_decode(json_encode($objectidobject), true);
  $objectid = $objectidarray;
  foreach ($objectid as $x => $val) {
    $isolated_val = ($val['object_id']);
    $wpdb->delete( 'wp_posts', array( 'id' => $isolated_val ) );
    $wpdb->delete( 'wp_posts', array( 'post_parent' => $isolated_val ) );
    $wpdb->delete( 'wp_postmeta', array( 'post_id' => $isolated_val ) );
    $wpdb->delete( 'wp_term_relationships', array( 'object_id' => $isolated_val ) );
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
  $dbpostsobject = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_type = 'databases' ORDER BY ID DESC LIMIT 1");
  $dbpostsarray = json_decode(json_encode($dbpostsobject), true);
  $dbposts = $dbpostsarray[0];
  foreach ($dbposts as $x => $val) {
      $wpdb->insert( 'wp_postmeta', array( 'post_id' => $val, 'meta_key' => '_links_to', 'meta_value' => '#' ) );
      $wpdb->insert( 'wp_postmeta', array( 'post_id' => $val, 'meta_key' => '_links_to_target', 'meta_value' => '_blank' ) );
      $wpdb->insert( 'wp_postmeta', array( 'post_id' => $val, 'meta_key' => '_thumbnail_id', 'meta_value' => '81' ) );
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
  $dbpostsobject = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_type = 'databases' ORDER BY ID DESC LIMIT 1");
  $dbpostsarray = json_decode(json_encode($dbpostsobject), true);
  $dbposts = $dbpostsarray[0];
  foreach ($dbposts as $x => $val) {
      $wpdb->insert( 'wp_postmeta', array( 'post_id' => $val, 'meta_key' => '_links_to', 'meta_value' => '#' ) );
      $wpdb->insert( 'wp_postmeta', array( 'post_id' => $val, 'meta_key' => '_links_to_target', 'meta_value' => '_blank' ) );
      $wpdb->insert( 'wp_postmeta', array( 'post_id' => $val, 'meta_key' => '_thumbnail_id', 'meta_value' => '81' ) );
      $wpdb->insert( 'wp_term_relationships', array( 'object_id' => $val, 'term_taxonomy_id' => $taxid, 'term_order' => '0' ) );
  }

  $wpdb->update( 'wp_options', array('option_value' => $dbversion) , array('option_name' => 'sp_db_version') );

}
