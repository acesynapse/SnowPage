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
 * Search results page
 */

$gantry = Gantry\Framework\Gantry::instance();

/** @var \Gantry\Framework\Theme $theme */
$theme  = $gantry['theme'];

// We need to render contents of <head> before plugin content gets added.
$context              = Timber::get_context();
$context['page_head'] = $theme->render('partials/page_head.html.twig', $context);

$context['title'] = \__('Search results for:', 'snowpage') . ' ' . \get_search_query();
$context['posts'] = Timber::get_posts();

$templates = ['search.html.twig', 'archive.html.twig', 'index.html.twig'];

Timber::render($templates, $context);
