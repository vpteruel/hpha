<?php
/*
Plugin Name: Happy Holidays
Description: Add a lightrope.
Version: 1.0.0
Author: Vinicius Teruel
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue the CSS file
function enqueue_happy_holidays_styles() {
    wp_enqueue_style('happy-holidays-style', plugin_dir_url(__FILE__) . 'hpha-happy-holidays.css');
}
add_action('wp_enqueue_scripts', 'enqueue_happy_holidays_styles');

// Add the HTML content below the header
function add_happy_holidays_html() {
    if (is_singular()) {
        include plugin_dir_path(__FILE__) . 'hpha-happy-holidays.html';
    }
}

add_action('wp_head', 'add_happy_holidays_html');
