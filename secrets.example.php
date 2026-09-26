<?php
/**
 * secrets.example.php — Template for Server Secrets
 * 
 * Copy this file to secrets.php in the project root:
 *   cp secrets.example.php secrets.php
 * 
 * NOTE: secrets.php is ignored by Git and will never be committed.
 * Alternatively, set the environment variable TRAINING_API_KEY in your hosting environment.
 */

if (!defined('CONTENT_API_KEY')) {
    // Generate a strong random key (e.g. 64-character hex string)
    define('CONTENT_API_KEY', 'CHANGE_THIS_TO_YOUR_STRONG_SECRET_TOKEN_HERE');
}
