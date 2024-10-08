<?php

// Dummy data (replace with actual data source or database queries)
$employees = [
    [
        'id' => 4,
        'email' => 'vinicius.teruel@[domain]',
        'manager' => 4,
        'director' => 4,
        'vp_department' => 4,
        'vp_cfe' => 4,
        'ceo' => 4,
        'mm_requisition' => 4, // fixed
    ]
];

// Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        $user = findUser($employees, $email);
        if ($user !== null) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing email parameter']);
    }
}

// Helper function to find by email
function findUser($employees, $email) {
    foreach ($employees as $employee) {
        if ($employee['email'] === $email) {
            return $employee;
        }
    }
    if (empty($employees)) {
        return null;
    } else {
        return $employees[0];
    }
}
