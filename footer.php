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

use Timber\Timber;

/*
 * Third party plugins that hijack the theme will call wp_footer() to get the footer template.
 * We use this to end our output buffer (started in header.php) and render into the views/page-plugin.html.twig template.
 */

 $timberContext = $GLOBALS['timberContext'];

 if (!isset($timberContext)) {
     throw new RuntimeException('Timber context not set in footer.');
 }

 $timberContext['content'] = ob_get_clean();

 $templates = ['page-plugin.html.twig'];
 Timber::render($templates, $timberContext);
