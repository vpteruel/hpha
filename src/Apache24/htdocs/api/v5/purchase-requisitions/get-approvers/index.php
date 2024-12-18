<?php
// Database connection parameters
$servername = "127.0.0.1:3306";
$username = "";
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
    if (isset($_GET['email']) && isset($_GET['function-centre-number'])) {
        $email = $_GET['email'];
        if ($email === 'vinicius.teruel@[domain]') {
            echo json_encode((object)array(
                'delegate_1' => null,
                'delegate_2' => null,
                'delegate_3' => null,
                'delegate_4' => null,
                'delegate_5' => null,
                'manager' => 4,
                'director' => 4,
                'vp_department' => 4,
                'vp_cfe' => 4,
                'ceo' => 4,
                'board_chair' => 4,
                'mm_requisition' => 4, // fixed
                'is_current_user_delegate' => false ? 'yes' : 'no',
                'is_current_user_manager' => false ? 'yes' : 'no',
                'is_current_user_director' => false ? 'yes' : 'no',
                'is_current_user_vp_department' => false ? 'yes' : 'no',
                'is_current_user_vp_cfe' => false ? 'yes' : 'no',
                'is_current_user_ceo' => false ? 'yes' : 'no',
                'is_current_user_board_chair' => false ? 'yes' : 'no'
            ));
        } else {
            $function_centre_number = $_GET['function-centre-number'];
            $department_roles = get_department_roles($pdo, $function_centre_number);
            if ($department_roles !== null) {
                $result = new stdClass();
                $result->delegate_1 = $department_roles['delegate_1_id'];
                $result->delegate_2 = $department_roles['delegate_2_id'];
                $result->delegate_3 = $department_roles['delegate_3_id'];
                $result->delegate_4 = $department_roles['delegate_4_id'];
                $result->delegate_5 = $department_roles['delegate_5_id'];
                $result->manager = $department_roles['manager_id'];
                $result->director = $department_roles['director_id'];
                $result->vp_department = $department_roles['vp_department_id'];
                $result->vp_cfe = $department_roles['vp_cfe_id'];
                $result->ceo = $department_roles['ceo_id'];
                $result->board_chair = $department_roles['board_chair_id'];
                $result->mm_requisition = 2; // fixed
                $result->is_current_user_delegate = is_delegate($email, $department_roles);
                $result->is_current_user_manager = ($email === $department_roles['manager_email']) ? 'yes' : 'no';
                $result->is_current_user_director = ($email === $department_roles['director_email']) ? 'yes' : 'no';
                $result->is_current_user_vp_department = ($email === $department_roles['vp_department_email']) ? 'yes' : 'no';
                $result->is_current_user_vp_cfe = ($email === $department_roles['vp_cfe_email']) ? 'yes' : 'no';
                $result->is_current_user_ceo = ($email === $department_roles['ceo_email']) ? 'yes' : 'no';
                $result->is_current_user_board_chair = ($email === $department_roles['board_chair_email']) ? 'yes' : 'no';
                echo json_encode($result);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Department roles not found']);
            }
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing email or function centre number parameter']);
    }
}

function get_department_roles($pdo, $function_centre_number) {
    try {
        $stmt = $pdo->prepare(@"
SELECT
    d.delegate_1_wp_user_id AS delegate_1_id, d.delegate_1_email AS delegate_1_email,
    d.delegate_2_wp_user_id AS delegate_2_id, d.delegate_2_email AS delegate_2_email,
    d.delegate_3_wp_user_id AS delegate_3_id, d.delegate_3_email AS delegate_3_email,
    d.delegate_4_wp_user_id AS delegate_4_id, d.delegate_4_email AS delegate_4_email,
    d.delegate_5_wp_user_id AS delegate_5_id, d.delegate_5_email AS delegate_5_email,
    d.manager_wp_user_id AS manager_id, d.manager_email AS manager_email,
    d.director_wp_user_id AS director_id, d.director_email AS director_email,
    d.vp_department_wp_user_id AS vp_department_id, d.vp_department_email AS vp_department_email,
    d.vp_cfe_wp_user_id AS vp_cfe_id, d.vp_cfe_email AS vp_cfe_email,
    d.ceo_wp_user_id AS ceo_id, d.ceo_email AS ceo_email,
    d.board_chair_wp_user_id AS board_chair_id, d.board_chair_email AS board_chair_email
FROM 
    hpha_department_roles_view d
WHERE 
    d.function_centre_number = :function_centre_number;");
        $stmt->execute(['function_centre_number' => $function_centre_number]);
        $department_roles = $stmt->fetch(PDO::FETCH_ASSOC);
        return $department_roles ? $department_roles : null;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
        exit();
    }
}

function is_delegate($email, $department_roles) {
    return ($email === $department_roles['delegate_1_email']
        || $email === $department_roles['delegate_2_email']
        || $email === $department_roles['delegate_3_email']
        || $email === $department_roles['delegate_4_email']
        || $email === $department_roles['delegate_5_email']) ? 'yes' : 'no';
}
?>
