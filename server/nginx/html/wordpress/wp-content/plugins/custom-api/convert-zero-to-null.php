<?php
// Callback function to process the request
function convert_zero_to_null($data) {
    // Get the entry_id and field_ids from query parameters
    $entry_id = isset($_GET['entry_id']) ? sanitize_text_field($_GET['entry_id']) : null;
    $field_ids = isset($_GET['field_ids']) ? sanitize_text_field($_GET['field_ids']) : null;

    // Ensure that entry_id and field_ids are provided
    if (empty($entry_id) || empty($field_ids)) {
        return new WP_Error('invalid_request', 'Missing entry_id or field_ids', array('status' => 400));
    }

    // Convert the comma-separated field_ids into an array
    $field_ids_array = explode(',', $field_ids);

    // Use Gravity Forms API to retrieve the entry data
    if (!class_exists('GFAPI')) {
        return new WP_Error('api_error', 'Gravity Forms API not available', array('status' => 500));
    }

    // Get the entry by entry_id
    $entry = GFAPI::get_entry($entry_id);

    // Check if the entry was retrieved successfully
    if (is_wp_error($entry)) {
        return new WP_Error('api_error', 'Error retrieving entry', array('status' => 500));
    }

    // Prepare the result by processing only the requested fields
    $result = [];
    foreach ($field_ids_array as $field_id) {
        if (isset($entry[$field_id])) {
            // Replace "0" with an empty string
            $result[$field_id] = ($entry[$field_id] === "0") ? "" : $entry[$field_id];
        }
    }

    // Return the modified data
    return rest_ensure_response($result);
}
