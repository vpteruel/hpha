<?php
/*
Plugin Name: HPHA Holidays
Description: This plugin adds holiday-themed decorations to your WordPress site, including styles and HTML content for various holidays.
Version: 1.0.0
Author: Vinicius Teruel
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define global variables for start and end dates
global $holiday_dates;
$holiday_dates = array(
    // New Year's Day (Jan 1)
    'new_year' => array(
        'start' => date('Y') . '-01-01',
        'end' => date('Y') . '-01-01'
    ),
    // Good Friday (date varies)
    'good_friday' => array(
        'start' => date('Y-m-d', strtotime('last Friday', strtotime('April 1'))),
        'end' => date('Y-m-d', strtotime('last Friday', strtotime('April 1')))
    ),
    // Easter Monday (date varies)
    'easter_monday' => array(
        'start' => date('Y-m-d', strtotime('next Monday', strtotime('April 1'))),
        'end' => date('Y-m-d', strtotime('next Monday', strtotime('April 1')))
    ),
    // Victoria Day (last Monday before May 25)
    'victoria_day' => array(
        'start' => date('Y-m-d', strtotime('last Monday', strtotime('May 25'))),
        'end' => date('Y-m-d', strtotime('last Monday', strtotime('May 25')))
    ),
    // Canada Day (Jul 1)
    'canada_day' => array(
        'start' => date('Y') . '-07-01',
        'end' => date('Y') . '-07-01'
    ),
    // Civic Holiday (first Monday in August)
    'civic_holiday' => array(
        'start' => date('Y-m-d', strtotime('first Monday of August')),
        'end' => date('Y-m-d', strtotime('first Monday of August'))
    ),
    // Labour Day (first Monday in September)
    'labour_day' => array(
        'start' => date('Y-m-d', strtotime('first Monday of September')),
        'end' => date('Y-m-d', strtotime('first Monday of September'))
    ),
    // Thanksgiving (second Monday in October)
    'thanksgiving' => array(
        'start' => date('Y-m-d', strtotime('second Monday of October')),
        'end' => date('Y-m-d', strtotime('second Monday of October'))
    ),
    // Remembrance Day (Nov 11)
    'remembrance_day' => array(
        'start' => date('Y') . '-11-11',
        'end' => date('Y') . '-11-11'
    ),
    // Christmas Day (Dec 25)
    'christmas' => array(
        'start' => date('Y') . '-12-01',
        'end' => date('Y') . '-12-31'
    ),
    // Boxing Day (Dec 26)
    'boxing_day' => array(
        'start' => date('Y') . '-12-26',
        'end' => date('Y') . '-12-26'
    ),
    // Halloween (Oct 31)
    'halloween' => array(
        'start' => date('Y') . '-10-01',
        'end' => date('Y') . '-10-31'
    )
);

// Function to check if the current date is between two dates
function is_between_dates($start_date, $end_date) {
    $current_date = time();
    return ($current_date >= strtotime($start_date) && $current_date <= strtotime($end_date));
}

// Enqueue the CSS file
function enqueue_hpha_holidays_styles() {
    global $holiday_dates;

    foreach ($holiday_dates as $holiday => $dates) {
        if (is_between_dates($dates['start'], $dates['end'])) {
            wp_enqueue_style("hpha-{$holiday}-style", plugin_dir_url(__FILE__) . "templates/hpha-{$holiday}.css");
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_hpha_holidays_styles');

// Add the HTML content below the header
function add_hpha_holidays_html() {
    if (is_singular()) {
        global $holiday_dates;

        foreach ($holiday_dates as $holiday => $dates) {
            if (is_between_dates($dates['start'], $dates['end'])) {
                include plugin_dir_path(__FILE__) . "templates/hpha-{$holiday}.html";
            }
        }
    }
}
add_action('wp_head', 'add_hpha_holidays_html');
