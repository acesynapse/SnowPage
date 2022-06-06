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
 * The template for displaying Author Archive pages
 */

global $wp_query;

$gantry = Gantry\Framework\Gantry::instance();

/** @var \Gantry\Framework\Theme $theme */
$theme  = $gantry['theme'];

// We need to render contents of <head> before plugin content gets added.
$context              = Timber::get_context();
$context['page_head'] = $theme->render('partials/page_head.html.twig', $context);

$context['posts'] = Timber::get_posts();

if (isset($authordata)) {
    $author            = new \Timber\User($authordata->ID);
    $context['author'] = $author;
    $context['title']  = \__('Author:', 'snowpage') . ' ' . $author->name();
}

Timber::render(['author.html.twig', 'archive.html.twig', 'index.html.twig'], $context);
