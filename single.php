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
  * The Template for displaying all single posts
  */

 $gantry = Gantry::instance();

 /** @var Theme $theme */
 $theme  = $gantry['theme'];

 // We need to render contents of <head> before plugin content gets added.
 $context              = Timber::get_context();
 $context['page_head'] = $theme->render('partials/page_head.html.twig', $context);

 $post            = Timber::query_post();
 $context['post'] = $post;
 $context['wp_title'] .= ' - ' . $post->title();

 Timber::render(['single-' . $post->ID . '.html.twig', 'single-' . $post->post_type . '.html.twig', 'single.html.twig'], $context);
