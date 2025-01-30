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
        $function_centre_number = $_GET['function-centre-number'];
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
                'purchase_initiator' => null,
                'is_user_delegate' => false ? 'yes' : 'no',
                'is_user_manager' => false ? 'yes' : 'no',
                'is_user_director' => false ? 'yes' : 'no',
                'is_user_vp_department' => false ? 'yes' : 'no',
                'is_user_vp_cfe' => false ? 'yes' : 'no',
                'is_user_ceo' => false ? 'yes' : 'no',
                'is_user_board_chair' => false ? 'yes' : 'no',
                'is_user_purchase_initiator' => false ? 'yes' : 'no'
            ));
        } else {
            $department_roles = get_department_roles($pdo, $email, $function_centre_number);
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
                $result->mm_requisition = $department_roles['mm_requisition_id'];
                $result->purchase_initiator = $department_roles['purchase_initiator_id'];
                $result->is_user_delegate = $department_roles['is_user_delegate'];
                $result->is_user_manager = $department_roles['is_user_manager'];
                $result->is_user_director = $department_roles['is_user_director'];
                $result->is_user_vp_department = $department_roles['is_user_vp_department'];
                $result->is_user_vp_cfe = $department_roles['is_user_vp_cfe'];
                $result->is_user_ceo = $department_roles['is_user_ceo'];
                $result->is_user_board_chair = $department_roles['is_user_board_chair'];
                $result->is_user_purchase_initiator = $department_roles['is_user_purchase_initiator'];
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

function get_department_roles($pdo, $email, $function_centre_number) {
    try {
        // Execute SET statements separately
        $pdo->exec("SET @mm_requisition_id = 2");
        $pdo->exec("SET @email = " . $pdo->quote($email));

        $stmt = $pdo->prepare(@"
SELECT
	hdrv.department_id,
    hdrv.department_name,
    hdrv.delegate_1_wp_user_id AS delegate_1_id,
    hdrv.delegate_1_email AS delegate_1_email,
    hdrv.delegate_2_wp_user_id AS delegate_2_id,
    hdrv.delegate_2_email AS delegate_2_email,
    hdrv.delegate_3_wp_user_id AS delegate_3_id,
    hdrv.delegate_3_email AS delegate_3_email,
    hdrv.delegate_4_wp_user_id AS delegate_4_id,
    hdrv.delegate_4_email AS delegate_4_email,
    hdrv.delegate_5_wp_user_id AS delegate_5_id,
    hdrv.delegate_5_email AS delegate_5_email,
    hdrv.manager_wp_user_id AS manager_id,
    hdrv.manager_email AS manager_email,
    hdrv.director_wp_user_id AS director_id,
    hdrv.director_email AS director_email,
    hdrv.vp_department_wp_user_id AS vp_department_id,
    hdrv.vp_department_email AS vp_department_email,
    hdrv.vp_cfe_wp_user_id AS vp_cfe_id,
    hdrv.vp_cfe_email AS vp_cfe_email,
    hdrv.ceo_wp_user_id AS ceo_id,
    hdrv.ceo_email AS ceo_email,
    hdrv.board_chair_wp_user_id AS board_chair_id,
    hdrv.board_chair_email AS board_chair_email,
    @mm_requisition_id AS mm_requisition_id,
    purchase_initiator.wp_user_id AS purchase_initiator_id,
    purchase_initiator.email AS purchase_initiator_email,
    CASE WHEN @email IN (
        hdrv.delegate_1_email,
        hdrv.delegate_2_email,
        hdrv.delegate_3_email,
        hdrv.delegate_4_email,
        hdrv.delegate_5_email
    ) THEN 'yes' ELSE 'no' END AS is_user_delegate,
    CASE WHEN @email = hdrv.manager_email THEN 'yes' ELSE 'no' END AS is_user_manager,
    CASE WHEN @email = hdrv.director_email THEN 'yes' ELSE 'no' END AS is_user_director,
    CASE WHEN @email = hdrv.vp_department_email THEN 'yes' ELSE 'no' END AS is_user_vp_department,
    CASE WHEN @email = hdrv.vp_cfe_email THEN 'yes' ELSE 'no' END AS is_user_vp_cfe,
    CASE WHEN @email = hdrv.ceo_email THEN 'yes' ELSE 'no' END AS is_user_ceo,
    CASE WHEN @email = hdrv.board_chair_email THEN 'yes' ELSE 'no' END AS is_user_board_chair,
    CASE WHEN purchase_initiator.email IS NOT NULL THEN 'yes' ELSE 'no' END AS is_user_purchase_initiator
FROM
    hpha_department_roles_view hdrv
LEFT JOIN hpha_departments_users_roles dupi
    ON hdrv.department_id = dupi.department_id
    AND dupi.role_id = (SELECT id FROM hpha_roles WHERE name = 'Purchase Initiator')
LEFT JOIN hpha_users purchase_initiator
    ON dupi.user_id = purchase_initiator.id 
    AND purchase_initiator.email = @email
WHERE
    hdrv.function_centre_number = :function_centre_number;");

        $stmt->bindParam(':function_centre_number', $function_centre_number);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
        exit();
    }
}
?>
