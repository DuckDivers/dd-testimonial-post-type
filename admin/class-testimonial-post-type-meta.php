<?php 
/**
 * The Class responsible for adding the meta box to the custom post type.
 *
 * @since    1.0.0
 */

class Testimonial_Post_Type_Meta {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes',        array( $this, 'add_metabox' )         );
		add_action( 'save_post',             array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		add_meta_box(
			'testimonial-meta',
			__( 'Testimonial Data', 'dd_theme' ),
			array( $this, 'render_testi_meta' ),
			'testi',
			'normal',
			'high'
		);

	}

	public function render_testi_meta( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'dd_testi_nonce_action', 'dd_testi_nonce' );

		// Retrieve an existing value from the database.
		$dd_testi_name = get_post_meta( $post->ID, 'dd_testi_name', true );
		$dd_testi_url = get_post_meta( $post->ID, 'dd_testi_url', true );
		$dd_testi_email = get_post_meta( $post->ID, 'dd_testi_email', true );
		$dd_testi_info = get_post_meta( $post->ID, 'dd_testi_info', true );
		$dd_testi_date = get_post_meta( $post->ID, 'dd_testi_date', true );

		// Set default values.
		if( empty( $dd_testi_name ) ) $dd_testi_name = '';
		if( empty( $dd_testi_url ) ) $dd_testi_url = '';
		if( empty( $dd_testi_email ) ) $dd_testi_email = '';
		if( empty( $dd_testi_info ) ) $dd_testi_info = '';
		if( empty( $dd_testi_date ) ) $dd_testi_date = '';

		// Form fields.
        echo '  <h4>All Fields are Optional, but recommended</h4>';
        echo '<table class="form-table">';
		echo '	<tr>';
		echo '		<th><label for="dd_testi_name" class="dd_testi_name_label">' . __( 'Name', 'dd_theme' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="dd_testi_name" name="dd_testi_name" class="dd_testi_name_field" placeholder="' . esc_attr__( '', 'dd_theme' ) . '" value="' . esc_attr( $dd_testi_name ) . '">';
		echo '			<p class="description">' . __( 'Name of person who left testimonial', 'dd_theme' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';
        echo '	<tr>';
		echo '		<th><label for="dd_testi_date" class="dd_testi_date_label">' . __( 'Date Posted', 'dd_theme' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="date" id="dd_testi_date" name="dd_testi_date" class="dd_testi_date_field" placeholder="' . esc_attr__( '', 'dd_theme' ) . '" value="' . esc_attr( $dd_testi_date ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="dd_testi_url" class="dd_testi_url_label">' . __( 'Web Address of Testimonial', 'dd_theme' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="url" id="dd_testi_url" name="dd_testi_url" class="dd_testi_url_field" placeholder="' . esc_attr__( '', 'dd_theme' ) . '" value="' . esc_attr( $dd_testi_url ) . '">';
		echo '			<p class="description">' . __( 'Where can someone view this testimonial on the web', 'dd_theme' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="dd_testi_email" class="dd_testi_email_label">' . __( 'Email of Person', 'dd_theme' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="email" id="dd_testi_email" name="dd_testi_email" class="dd_testi_email_field" placeholder="' . esc_attr__( '', 'dd_theme' ) . '" value="' . esc_attr( $dd_testi_email ) . '">';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="dd_testi_info" class="dd_testi_info_label">' . __( 'Additional Info', 'dd_theme' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="dd_testi_info" name="dd_testi_info" class="dd_testi_info_field" placeholder="' . esc_attr__( '', 'dd_theme' ) . '" value="' . esc_attr( $dd_testi_info ) . '">';
		echo '		</td>';
		echo '	</tr>';
		echo '</table>';

	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['dd_testi_nonce'] ) ? $_POST['dd_testi_nonce'] : '';
		$nonce_action = 'dd_testi_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $post_id ) )
			return;

		// Sanitize user input.
		$dd_testi_new_name = isset( $_POST[ 'dd_testi_name' ] ) ? sanitize_text_field( $_POST[ 'dd_testi_name' ] ) : '';
		$dd_testi_new_url = isset( $_POST[ 'dd_testi_url' ] ) ? esc_url( $_POST[ 'dd_testi_url' ] ) : '';
		$dd_testi_new_email = isset( $_POST[ 'dd_testi_email' ] ) ? sanitize_email( $_POST[ 'dd_testi_email' ] ) : '';
		$dd_testi_new_info = isset( $_POST[ 'dd_testi_info' ] ) ? sanitize_text_field( $_POST[ 'dd_testi_info' ] ) : '';
		$dd_testi_new_date = isset( $_POST[ 'dd_testi_date' ] ) ? sanitize_text_field( $_POST[ 'dd_testi_date' ] ) : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'dd_testi_name', $dd_testi_new_name );
		update_post_meta( $post_id, 'dd_testi_url', $dd_testi_new_url );
		update_post_meta( $post_id, 'dd_testi_email', $dd_testi_new_email );
		update_post_meta( $post_id, 'dd_testi_info', $dd_testi_new_info );
		update_post_meta( $post_id, 'dd_testi_date', $dd_testi_new_date );

	}

}
