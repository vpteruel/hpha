<?php
/*
Plugin Name: Custom Plugin Modifications
Description: This plugin modifies functionality of the Gravity Forms and Flow.
Version: 1.0.0
Author: Vinicius Teruel
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// custom code

/*
Display the full date/timestamp on each note
*/

// add_filter( 'gravityflow_timeline_notes', 'jo_timeline_granular', 10, 2 );

// function jo_timeline_granular( $notes, $entry ) {
// 	foreach ( $notes as &$note ) {
// 		$magic = true;
// 		$note->value = $note->date_created . ' - ' . $note->value;
// 	}
// 	return $notes;
// }

/*
Sends the file uploaded in a 'File Upload' field as an  attachment to the assignee of an Approval step
*/


add_filter( 'gravityflow_notification', 'jo_gravityflow_notification', 10, 4 );

function jo_gravityflow_notification( $notification, $form, $entry, $step ) {
    
    if ( $step->get_type() == 'notification' ) {

        // attachments

        $fileupload_fields = GFCommon::get_fields_by_type( $form, array( 'fileupload' ) );

        if ( ! is_array( $fileupload_fields ) ) {
            return $notification;
        }

        $notification['attachments'] = rgar( $notification, 'attachments', array() );
        $upload_root = RGFormsModel::get_upload_root();

        foreach( $fileupload_fields as $field ) {

            $url = rgar( $entry, $field->id );

            if ( empty( $url ) ) {
                continue;
            } elseif ( $field->multipleFiles ) {
                $uploaded_files = json_decode( stripslashes( $url ), true );
                foreach ( $uploaded_files as $uploaded_file ) {
                    $attachment = preg_replace( '|^(.*?)/gravity_forms/|', $upload_root, $uploaded_file );
                    $notification['attachments'][] = $attachment;
                }
            } else {
                $attachment = preg_replace( '|^(.*?)/gravity_forms/|', $upload_root, $url );
                $notification['attachments'][] = $attachment;
            }
        }

        // Purchase Requisition Form
        if ( $form['id'] === 1 ) {

            $notification['disableAutoformat']  = '1';
            $notification['message_format']  = 'html';
            
            // Template variable
            $number_fields = GFCommon::get_fields_by_type( $form, array( 'number' ) );

            // https://codex.gravitykit.com/class_gravity_view___merge___tags.html#a3b71ab6eb3434b794090baf825b3338a
            $workflow_timeline = GFCommon::replace_variables( '{workflow_timeline} ', $form, $entry, false, true, true, 'html' );

            $assignee_steps = array( 129, 130, 131, 132, 133, 134, 135, 136, 137, 138 );

            ob_start();

            if ( $step->get_id() === 37 ) { // Send to submitter (pre-approval)
                include 'templates/purchase-requisition-form/not-authorized.php';
            } elseif ( in_array( $step->get_id(), $assignee_steps ) ) {
                include 'templates/purchase-requisition-form/assignee.php';
            } else {
                include 'templates/purchase-requisition-form/approved.php';
            }

            $template_content = ob_get_clean();
            
            $notification['message'] = $template_content;
        }

        // Personal Expense Reimbursement Form
        if ( $form['id'] === 3 ) {

            $notification['disableAutoformat']  = '1';
            $notification['message_format']  = 'html';
            
            // Template variable
            $number_fields = GFCommon::get_fields_by_type( $form, array( 'number' ) );

            // https://codex.gravitykit.com/class_gravity_view___merge___tags.html#a3b71ab6eb3434b794090baf825b3338a
            $workflow_timeline = GFCommon::replace_variables( '{workflow_timeline} ', $form, $entry, false, true, true, 'html' );

            $expense_type = rgar( $entry, '420' );
            ob_start();
            if ( $expense_type === 'Travel Expense' ) {
                if ( $step->get_id() === 109 ) {
                    include 'templates/travel-expense-reimbursement-form-declined.php';
                } else if ( $step->get_id() === 110 ) {
                    include 'templates/travel-expense-reimbursement-form-approved.php';
                } else if ( $step->get_id() === 111 ) {
                    include 'templates/travel-expense-reimbursement-form-FIN.php';
                }
            }
            if ( $expense_type === 'Non-Travel Personal Expense' ) {
                if ( $step->get_id() === 109 ) {
                    include 'templates/personal-expense-reimbursement-form-declined.php';
                } else if ( $step->get_id() === 110 ) {
                    include 'templates/personal-expense-reimbursement-form-approved.php';
                } else if ( $step->get_id() === 111 ) {
                    include 'templates/personal-expense-reimbursement-form-FIN.php';
                }
            }    
        
            $template_content = ob_get_clean();
            
            $notification['message'] = $template_content;
        }
    }

    gravity_flow()->log_debug( 'Attachment for entry_id ' . $entry['id'] . ' ' . var_export( $notification, true ) );

    return $notification;
    
}

add_filter('gform_pre_render_3', 'populate_supervisor_and_department_choices'); 
add_filter('gform_pre_validation_3', 'populate_supervisor_and_department_choices');
add_filter('gform_pre_submission_filter_3', 'populate_supervisor_and_department_choices');
add_filter('gform_admin_pre_render_3', 'populate_supervisor_and_department_choices');

function populate_supervisor_and_department_choices($form) {
    global $wpdb;

    // Fetch all supervisors (emails and IDs)
    $all_supervisors = $wpdb->get_results("SELECT id, email FROM hpha_users", ARRAY_A);

    // Fetch all departments with their associated user_id and function_centre_number
    $all_departments = $wpdb->get_results("SELECT department_function_centre, function_centre_number, user_id FROM hpha_departments_users_summary_view", ARRAY_A);

    // Prepare a map of departments per supervisor
    $department_data = array();
    foreach ($all_departments as $department) {
        $user_id = $department['user_id'];
        $department_data[$user_id][] = array(
            'department_function_centre' => $department['department_function_centre'],
            'function_centre_number' => $department['function_centre_number']
        );
    }

    // Add Supervisor choices to the form
    foreach ($form['fields'] as &$field) {
        if ($field->id == 567) { // Supervisor field ID
            $field->choices = array();
            foreach ($all_supervisors as $supervisor) {
                $field->choices[] = array(
                    'text' => $supervisor['email'],
                    'value' => $supervisor['id']
                );
            }
        }

        // Set default choices for Department field for validation purposes
        if ($field->id == 565) { // Department field ID
            $field->choices = array();
            foreach ($department_data as $departments) {
                foreach ($departments as $department) {
                    $field->choices[] = array(
                        'text' => $department['department_function_centre'],
                        'value' => $department['function_centre_number']
                    );
                }
            }
        }
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var supervisorField = $('#input_3_567');
            var departmentField = $('#input_3_565');
            var departmentData = <?php echo json_encode($department_data); ?>;

            // Variables to store selected values
            var supervisorSelectedValue = sessionStorage.getItem('supervisorSelectedValue');
            var departmentSelectedValue = sessionStorage.getItem('departmentSelectedValue');

            if (supervisorField.length && departmentField.length) {
                departmentField.html('');

                // Populate the supervisor dropdown
                supervisorField.html('<option value="">Select a Supervisor</option>');
                <?php foreach ($all_supervisors as $supervisor): ?>
                    supervisorField.append(
                        $('<option>', {
                            value: '<?php echo $supervisor["id"]; ?>',
                            text: '<?php echo $supervisor["email"]; ?>'
                        })
                    );
                <?php endforeach; ?>

                // Initialize Tom Select
                var tomSelectInstance = departmentField[0].tomselect || new TomSelect(departmentField[0], {
                    placeholder: 'Select a Department',
                });

                // Restore previously selected values
                if (supervisorSelectedValue) {
                    supervisorField.val(supervisorSelectedValue).change();
                }
                if (departmentSelectedValue) {
                    tomSelectInstance.setValue(departmentSelectedValue);
                }

                // Handle supervisor selection change
                supervisorField.on('change', function() {
                    supervisorSelectedValue = $(this).val();
                    tomSelectInstance.clearOptions();
                    tomSelectInstance.clear();

                    if (supervisorSelectedValue && departmentData[supervisorSelectedValue]) {
                        departmentData[supervisorSelectedValue].forEach(function(department) {
                            tomSelectInstance.addOption({ 
                                value: department.function_centre_number, 
                                text: department.department_function_centre 
                            });
                        });
                        tomSelectInstance.refreshOptions();
                    }

                    sessionStorage.setItem('supervisorSelectedValue', supervisorSelectedValue);
                });

                // Save department selection change
                tomSelectInstance.on('change', function() {
                    departmentSelectedValue = tomSelectInstance.getValue();
                    sessionStorage.setItem('departmentSelectedValue', departmentSelectedValue);
                });

                // Clear sessionStorage on form submission
                $(document).on('gform_confirmation_loaded', function(event, form_id) {
                    if (form_id == 3) { 
                        sessionStorage.removeItem('supervisorSelectedValue');
                        sessionStorage.removeItem('departmentSelectedValue');
                    }
                });
            } else {
                console.error("Supervisor or department field not found on the page.");
            }
        });
    </script>

    <style>
        /* Set fixed height for the dropdown to prevent resizing */
        #input_3_565.tomselected, .ts-control {
            height: 37px; /* Set to match the default field height */
            line-height: 37px; /* Ensure text vertically aligns within the field */
            padding: 0 8px; /* Adjust as needed to match your theme */
            box-sizing: border-box;
        }

        /* Ensure consistent dropdown width and control spacing */
        .ts-dropdown {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
        }

        /* Control the dropdown items appearance */
        .ts-dropdown-content .option {
            padding: 8px 10px; /* Adjust padding to match your form's styling */
            line-height: 0.8em; /* Consistent line height for items */
            box-sizing: border-box;
        }

        /* Maintain field appearance when focused */
        .ts-control.focus {
            border-color: #ddd; /* Match your form's focus border color */
        }

        /* Style adjustments for disabled state */
        #input_3_565:disabled {
            background-color: #e0e0e0;
            color: #666;
        }
    </style>
    <?php
    return $form;
}

// Define the log file path
define('CUSTOM_PLUGIN_MODIFICATIONS_LOG_FILE', plugin_dir_path(__FILE__) . 'logs/debug.log');

function write_debug_log( $message ) {
    // Get the current timestamp
    $timestamp = date('Y-m-d H:i:s');
    
    // Format the log entry
    $log_entry = "[$timestamp] DEBUG: $message" . PHP_EOL;
    
    // Write the log entry to the file
    file_put_contents( CUSTOM_PLUGIN_MODIFICATIONS_LOG_FILE, $log_entry, FILE_APPEND );
}

add_action( 'login_head', 'custom_login_css' );

function custom_login_css() {
    echo '
    <style type="text/css">
		.login h1 a {
			background-image: 
				url(https://formsanyware.hpha.ca/wp-content/uploads/2024/08/robot.png),	
				url(https://formsanyware.hpha.ca/wp-content/uploads/2024/08/logo.png);
			background-size: 64px, contain;
			background-position: top right, center;
			background-repeat: no-repeat, no-repeat;
            background-blend-mode: hue;
			margin: 0;
			width: 100%;
			height: 338px;
			pointer-events: none;
			cursor: default;
		}
        
		#loginform {
			background-color: transparent;
			border: 0;
			box-shadow: none;
		}
        #loginform:before {
            content: "Forms Anyware";
            font-size: 2.48rem;
            color: #2271b1;
        }
        
        .login form { margin-top: 0; }
		.login label { display: none; }
		.login .wp-pwd button { display: none !important; }
		.login .button.wp-hide-pw .dashicons { display: none; }
		.login form .input { display: none; }
		.login form .forgetmenot { display: none; }
		.login #nav a, .login #backtoblog a { display: none; }
		.login .submit { display: none; }

		.login #mo_saml_button { 
            height: auto !important;
            margin-top: 20px;
        }
		.login #mo_saml_button b { display: none; }
		.login #mo_saml_login_sso_button { 
			font-size: 1.2rem !important;
			margin-bottom: 0 !important; 
		}

        #login-message {
            position: absolute;
            top: 32px;
        }
    </style>';
}

add_filter('login_redirect', 'admin_default_page');

function admin_default_page() {
    return '/home';
}
