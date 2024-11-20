<?php
// Database connection parameters
$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "wordpress";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit();
}

// Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $user = findUser($pdo, $name);
        if ($user !== null) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing name parameter']);
    }
}

// Helper function to find user by name
function findUser($pdo, $name) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM wp_custom_employee_fields WHERE name = :name");
        $stmt->execute(['name' => $name]);
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);
        return $employee ? $employee : null;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
        exit();
    }
}
?>
