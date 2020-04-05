<?php

/**
 * Plugin Name: Un ejemplo de plugin con un problema de CSRF
 */

add_action( 'init', 'wp_ajax_envia_email_a_soporte' );
function wp_ajax_envia_email_a_soporte() {

	$text = $_POST['text'];
	$text .= "\n\n" . home_url();

	$headers = array();
	
	$reply_to = sanitize_email( $_POST['email'] );
	$headers[] = "Reply-To: $reply_to";
	
	$current_user = wp_get_current_user();
	$name = ( $current_user instanceof WP_User ) ? $current_user->user_nicename : '';
	$from = $name . ' <' . $current_user->user_email . '>';
	$headers[] = "From: $from";

	wp_mail( 'support-desk@es-un-mal-plugin.com', $_POST['subject'], $text, $headers );
}