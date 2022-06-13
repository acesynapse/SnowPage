<?php

/**
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('ABSPATH') || die(http_response_code(418));

$wpdb->delete( 'wp_posts', array( 'post_type' => 'databases' ) );
