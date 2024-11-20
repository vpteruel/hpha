<?php
/*
Plugin Name: Custom API Plugin
Description: A custom API for helping with extras functionalities
Version: 1.0
Author: Vinicius Teruel
*/

// Include endpoint files
include_once 'convert-zero-to-null.php';
include_once 'get-approvers.php';

// Hook to register the custom API routes
add_action('rest_api_init', function() {
    header('Access-Control-Allow-Origin: *');

    register_rest_route('custom-api/v1', '/convert-zero-to-null/', [
        'methods' => 'GET',
        'callback' => 'convert_zero_to_null',
        'permission_callback' => '__return_true',
    ]);

    register_rest_route('custom-api/v1', '/get-approvers/', [
        'methods' => 'GET',
        'callback' => 'get_employee_by_email',
        'permission_callback' => '__return_true',
    ]);
});