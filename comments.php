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
 * The template for displaying comments
 */

$context = Timber::get_context();

$post            = new \Timber\Post();
$context['post'] = $post;

if (\post_password_required($post)) {
    return;
}

Timber::render(['partials/comments-' . $post->ID . '.html.twig', 'partials/comments-' . $post->post_type . '.html.twig', 'partials/comments.html.twig'], $context);
