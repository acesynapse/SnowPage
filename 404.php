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
  * The template for displaying 404 pages (Not Found)
  */

 $gantry = Gantry::instance();

 /** @var Theme $theme */
 $theme  = $gantry['theme'];
 $theme->setLayout('_error', true);

 // We need to render contents of <head> before plugin content gets added.
 $context              = Timber::get_context();
 $context['page_head'] = $theme->render('partials/page_head.html.twig', $context);

 Timber::render('404.html.twig', $context);
