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

/*
 * Third party plugins that hijack the theme will call wp_footer() to get the footer template.
 * We use this to end our output buffer (started in header.php) and render into the views/page-plugin.html.twig template.
 */

$timberContext = $GLOBALS['timberContext'];

if (!isset($timberContext)) {
    throw new \Exception('Timber context not set in footer.');
}

$timberContext['content'] = ob_get_contents();
ob_end_clean();

$templates = ['page-plugin.html.twig'];
Timber::render($templates, $timberContext);
