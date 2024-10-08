<?php
// Dummy data (replace with actual data source or database queries)
$employees = [
    [
        'id' => 4,
        'email' => 'vinicius.teruel@[domain]',
        'departmentDirector' => 4,
        'manager' => 4,
        'responsibleVp' => 4,
        'vpPerformanceCfe' => 4,
        'presidentCeo' => 4,
        'boardChair' => 4,
        'mmRequisition' => 4, // fixed
    ]
];

function get_employee_by_email($data) {
    global $employees; // Ensure $employees is accessible

    // Get the email parameter from the query string
    $email = isset($_GET['email']) ? sanitize_text_field($_GET['email']) : null;

    // Ensure the email parameter is provided
    if (empty($email)) {
        return new WP_Error('missing_email', 'Missing email parameter', array('status' => 400));
    }

    // Search for the user by email
    $user = find_user_by_email($employees, $email);

    // If user is not found, return a 404 error
    if ($user === null) {
        return new WP_Error('user_not_found', 'User not found', array('status' => 404));
    }

    // Return the user data
    return rest_ensure_response($user);
}

// Helper function to find a user by email
function find_user_by_email($employees, $email) {
    foreach ($employees as $employee) {
        if ($employee['email'] === $email) {
            return $employee;
        }
    }
    return null;
}
