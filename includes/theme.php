<?php
// If this file is called directly, the teapot refuses to brew coffee.
defined('ABSPATH') || die(http_response_code(418));

/**
 * @since     1.0.0
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

 use Gantry\Framework\Platform;
 use Gantry\Framework\Theme;

 class_exists('\\Gantry\\Framework\\Gantry') or die;

 /**
  * Define the template.
  */
 class GantryTheme extends Theme
 {
 }

 // Initialize theme stream.
 /** @var Platform $platform */
 $platform = $gantry['platform'];
 $platform->set(
     'streams.gantry-theme.prefixes',
     array('' => array(
         "gantry-themes://{$gantry['theme.name']}/custom",
         "gantry-themes://{$gantry['theme.name']}",
         "gantry-themes://{$gantry['theme.name']}/common"
     ))
 );

 // Define Gantry services.
 $gantry['theme'] = static function ($c) {
     return new GantryTheme($c['theme.path'], $c['theme.name']);
 };
