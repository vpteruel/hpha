<?php
/*
Plugin Name: HPHA Login
Description: This plugin adds a custom login form to your WordPress site.
Version: 1.0.0
Author: Vinicius Teruel
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Add custom login form
add_filter( 'login_redirect', function( $redirect_to, $request, $user ) {
    // If 'redirect_to' parameter is set, use it
    if ( ! empty( $_GET['redirect_to'] ) ) {
        return esc_url_raw( $_GET['redirect_to'] );
    }

    // Default behavior if no 'redirect_to' parameter is present
    return home_url();
}, 10, 3 );

// Add custom login form
add_action('login_head', 'custom_login_css');

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