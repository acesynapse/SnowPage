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

 use Gantry\Framework\Gantry;
 use Gantry\Framework\Theme;
 use Timber\Timber;

 /*
  * Third party plugins that hijack the theme will call wp_head() to get the header template.
  * We use this to start our output buffer and render into the views/page-plugin.html.twig template in footer.php
  */

 $gantry = Gantry::instance();

 /** @var Theme $theme */
 $theme  = $gantry['theme'];

 // We need to render contents of <head> before plugin content gets added.
 $context              = Timber::get_context();
 $context['page_head'] = $theme->render('partials/page_head.html.twig', $context);

 $GLOBALS['timberContext'] = $context;

 ob_start();
