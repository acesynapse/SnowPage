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
  * The template for displaying all pages.
  *
  * This is the template that displays all pages by default.
  * Please note that this is the WordPress construct of pages
  * and that other 'pages' on your WordPress site will use a
  * different template.
  *
  * To generate specific templates for your pages you can use:
  * /mytheme/views/page-mypage.html.twig
  * (which will still route through this PHP file)
  * OR
  * /mytheme/page-mypage.php
  * (in which case you'll want to duplicate this file and save to the above path)
  */

 $gantry = Gantry::instance();

 /** @var Theme $theme */
 $theme  = $gantry['theme'];

 // We need to render contents of <head> before plugin content gets added.
 $context              = Timber::get_context();
 $context['page_head'] = $theme->render('partials/page_head.html.twig', $context);

 $post            = Timber::query_post();
 $context['post'] = $post;

 Timber::render(['page-' . $post->post_name . '.html.twig', 'page.html.twig'], $context);
