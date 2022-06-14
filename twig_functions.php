<?php

/**
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('ABSPATH') || die(http_response_code(418));

use Timber\Timber;

  global $wpdb;
  $dbpostsobject = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_type = 'bookshelves' ORDER BY ID DESC LIMIT 1");
  $dbpostsarrayss = json_decode(json_encode($dbpostsobject), true);
  $dbpostsarray = $dbpostsarrayss[0]['ID'];

  $bookshelvesobject1 = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE post_id = $dbpostsarray AND meta_key = 'isbn'");
  $bookshelvesarray1 = json_decode(json_encode($bookshelvesobject1[0]), true);
  $bookshelves1 = $bookshelvesarray1['meta_value'];
  $bookshelves12 = preg_replace('/(\W\W[is](\W\d\W|\W\d\d\W)[is](\W\d\d\W\W|\W\d\W\W))/', ';;', $bookshelves1);
  $bookshelves3 = explode(";;", $bookshelves12,8);
  array_shift($bookshelves3);
  array_pop($bookshelves3);

  $bookshelvesobject2 = $wpdb->get_results("SELECT meta_value FROM wp_postmeta WHERE post_id = $dbpostsarray AND meta_key = 'alt'");
  $bookshelvesarray2 = json_decode(json_encode($bookshelvesobject2[0]), true);
  $bookshelves2 = $bookshelvesarray2['meta_value'];
  $bookshelves13 = preg_replace('/(\W\W[is](\W\d\W|\W\d\d\W)[is](\W\d\d\W\W|\W\d\W\W))/', ';;', $bookshelves2);
  $bookshelves4 = explode(";;", $bookshelves13,8);
  array_shift($bookshelves4);
  array_pop($bookshelves4);

  $isbn1 = $bookshelves3[0];
  $title1 = $bookshelves4[0];

  $isbn2 = $bookshelves3[1];
  $title2 = $bookshelves4[1];

  $isbn3 = $bookshelves3[2];
  $title3 = $bookshelves4[2];

  $isbn4 = $bookshelves3[3];
  $title4 = $bookshelves4[3];

  $isbn5 = $bookshelves3[4];
  $title5 = $bookshelves4[4];

  $isbn6 = $bookshelves3[5];
  $title6 = $bookshelves4[5];
