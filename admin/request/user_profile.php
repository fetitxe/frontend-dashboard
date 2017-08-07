<?php

/**
 * Save Profile.
 *
 * @param array $request Request
 * @param string $action Action
 * @param string $post_id Post ID
 */
function fed_save_profile_post( $request, $action = '', $post_id = '' ) {
	global $wpdb;
	$input_meta = $request['input_meta'];



	if ( $action === 'profile' ) {
		$table_name = $wpdb->prefix . BC_FED_USER_PROFILE_DB;
	} elseif ( $action === 'post' ) {
		$table_name = $wpdb->prefix . BC_FED_POST_DB;
	} else {
		wp_send_json_error( array( 'message' => __( 'Hey, you are trying something naughty', 'fed' ) ) );
		exit();
	}

	if ( ! empty($post_id )) {

		/**
		 * Check for input meta already exist
		 */

		$duplicate = $wpdb->get_row( "SELECT * FROM $table_name WHERE input_meta LIKE '{$input_meta}' AND NOT id = $post_id " );

		if ( null !== $duplicate ) {
			wp_send_json_error( array( 'message' => 'Sorry, you have previously added ' . strtoupper( $duplicate->label_name ) . ' with input type ' . strtoupper( $duplicate->input_type ) ) );
			exit();
		}

		/**
		 * No duplicate found, so we can update the record.
		 */
		$status = $wpdb->update( $table_name, $request, array( 'id' => (int) $post_id ) );

		if ( $status === false ) {
			wp_send_json_error( array( 'message' => __( 'Sorry no record found to update your new details', 'fed' ) ) );
			exit();
		}

		wp_send_json_success( array( 'message' => $request['label_name'] . ' has been successfully updated' ) );
		exit();
	} else {
		/**
		 * Check for input meta already exist
		 */

		$duplicate = $wpdb->get_row( "SELECT * FROM $table_name WHERE input_meta LIKE '{$input_meta}'" );

		if ( null !== $duplicate ) {
			wp_send_json_error( array( 'message' => 'Sorry, you have previously added ' . strtoupper( $duplicate->label_name ) . ' with input type ' . strtoupper( $duplicate->input_type ) ) );
			exit();
		}
		/**
		 * Now we are free to insert the row
		 */
		$status = $wpdb->insert(
			$table_name,
			$request
		);

		if ( $status === false ) {
			wp_send_json_error( array( 'message' => __('Sorry, Something went wrong in storing values in DB, please try again later or contact support','fed') ) );
			exit();
		}

		wp_send_json_success( array( 'message' => $request['label_name'] . ' has been Successfully added' ) );
		exit();
	}
}