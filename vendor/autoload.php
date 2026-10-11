<?php
/**
 * vendor/autoload.php
 * Manual autoloader — no Composer needed.
 * Include this file at the top of any script that needs vendor libraries.
 */

define('VENDOR_DIR', __DIR__);

// ── PDF Generation ─────────────────────────────────────────────────────────
require_once VENDOR_DIR . '/fpdf/fpdf.php';

// ── Email (PHPMailer) ──────────────────────────────────────────────────────
require_once VENDOR_DIR . '/phpmailer/src/Exception.php';
require_once VENDOR_DIR . '/phpmailer/src/PHPMailer.php';
require_once VENDOR_DIR . '/phpmailer/src/SMTP.php';

// ── WhatsApp (Evolution API client) ───────────────────────────────────────
require_once VENDOR_DIR . '/evolution/EvolutionClient.php';

// ── RSS Feed Parser ────────────────────────────────────────────────────────
require_once VENDOR_DIR . '/rss/RssParser.php';

// ── AI API Client (Claude) ─────────────────────────────────────────────────
require_once VENDOR_DIR . '/ai/ClaudeClient.php';

// ── Image Generator (social media cards) ──────────────────────────────────
require_once VENDOR_DIR . '/image/SocialCardGenerator.php';
