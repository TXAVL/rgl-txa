<?php
/**
 * Global configuration for the RGL TXA link shortener project.
 *
 * These constants define database credentials, site configuration and other
 * default values used throughout the application. Adjust them to match
 * your environment. In production, you should store sensitive data in
 * environment variables instead of committing them to source control.
 */

// -----------------------------------------------------------------------------
// Database configuration
// -----------------------------------------------------------------------------
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'rgl');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('CHARSET', 'utf8mb4');

// -----------------------------------------------------------------------------
// Site configuration
// -----------------------------------------------------------------------------
// Base URL for the site. Adjust this to the domain where the app will run.
define('SITE_URL', 'http://localhost');

// Length of the generated short slug. You can change this to adjust how
// long the default shortened identifiers are. Slug length affects collision
// probability – longer slugs reduce the chance of collisions.
define('LENGTH_SHORTEN', 5);

// Enable debug mode to display errors and write logs. In production you
// typically disable debug mode. See the logging system for more details.
define('DEBUG_MODE', true);

// Directory where logs are written when DEBUG_MODE is enabled. Make sure this
// directory is writable by the web server if you plan to store logs.
define('LOG_DIRECTORY', __DIR__ . '/../logs');

// -----------------------------------------------------------------------------
// Additional configuration options can be added here. For example, you might
// define API keys for reCAPTCHA, mail server settings or other constants.
// -----------------------------------------------------------------------------

// Example reCAPTCHA keys (placeholder values). Replace with your own keys.
define('RECAPTCHA_SITE_KEY', '');
define('RECAPTCHA_SECRET_KEY', '');

?>
