<?php

/*
Plugin Name: CH5
Plugin URI: sig-ad.com
Description: Adds a basic homepage banner with area for text.
Author: Phillip Werner
Author URI:
License: GPLv2
*/


add_action( 'post_edit_form_tag', 'ch5_cfu_form_add_enctype' );

function ch5_cfu_form_add_enctype() {
	echo ' enctype="multipart/form-data"';
}

add_action( 'add_meta_boxes', 'ch5_cfu_register_meta_box' );

function ch5_cfu_register_meta_box() {
	add_meta_box( 'ch5_cfu_upload_file', 'Upload Banner',
		'ch5_cfu_upload_meta_box', 'post', 'normal' );
	add_meta_box( 'ch5_cfu_upload_file', 'Upload Banner',
		'ch5_cfu_upload_meta_box', 'page', 'normal' );

}
function ch5_cfu_upload_meta_box( $post ) { 
	$post_source_header1 =
esc_html( get_post_meta( $post->ID, 'post_source_header1',
true ) );
$post_source_header2 =
esc_html( get_post_meta( $post->ID,
'post_source_header2',
true ) );
?>
<table>
	<tr>
		<td style="width: 150px">Banner Image</td>
		<td>
			<?php
// Retrieve attachment data for post
			$attachment_data = get_post_meta( $post->ID,
				'attach_data',
				true );
// Display post link if data is present
			if ( empty ( $attachment_data ) ) {
				echo 'No Attachment Present';
			} else {
				echo '<img src="';
				echo esc_url( $attachment_data['url'] );
				echo '"/>';
			}
			?>
		</td>
	</tr>
	<tr>
		<td>Top Banner: </td>
		<td><input name="upload_pdf" type="file" /></td>
	</tr>
	<tr>
		<td>Header 1</td>
		<td>
			<input type="text" size="40" name="post_source_header1" value="<?php echo $post_source_header1; ?>" />
		</td> 
	</tr>
	<tr>
		<td>Header 2</td>
		<td>
			<input type="text" size="40" name="post_source_header2" value="<?php echo $post_source_header2; ?>" />
		</td> 
	</tr>
	<tr>
		<td>Delete Banner:</td>
		<td><input type="submit" name="delete_attachment"
			class="button-primary"
			id="delete_attachment"
			value="Delete Banner" /></td>
		</tr>
	</table>
	<?php }

	add_action( 'save_post', 'ch5_cfu_save_uploaded_file', 10, 2 );

	function ch5_cfu_save_uploaded_file( $post_id = false,
		$post = false ) {
		if ( 'post' == $post->post_type ||
			'page' == $post->post_type ) {
// Store data in post meta table if present in post data
			if ( isset( $_POST['post_source_header1'] ) ) {
				update_post_meta( $post_id, 'post_source_header1',
					sanitize_text_field(
						$_POST['post_source_header1'] ) );
			}
			if ( isset( $_POST['post_source_header2'] ) ) {
				update_post_meta( $post_id, 'post_source_header2',
					sanitize_text_field(
						$_POST['post_source_header2'] ) );			}
		}
		if ( isset($_POST['delete_attachment'] ) ) {
			$attach_data = get_post_meta( $post_id, 'attach_data',
				true );
			if ( !empty( $attach_data ) ) {
				unlink( $attach_data['file'] );
				delete_post_meta( $post_id, 'attach_data' );
			}
		} elseif ( 'post' == $post->post_type ||
			'page' == $post->post_type ) {
// Look to see if file has been uploaded by user
			if( array_key_exists( 'upload_pdf', $_FILES ) &&
				!$_FILES['upload_pdf']['error'] ) {
// Retrieve file type and store lower-case version
				$file_type_array = wp_check_filetype( basename(
					$_FILES['upload_pdf']['name'] ) );
			$file_ext = strtolower( $file_type_array['ext'] );
// Display error message if file is not a png or jpg
			if ( $file_ext !== 'jpg' ) {
				wp_die( 'Only files of jpg type are allowed.' );
				exit;
			} else {
// Send uploaded file data to upload directory
				$upload_return = wp_upload_bits(
					$_FILES['upload_pdf']['name'], null,
					file_get_contents(
						$_FILES['upload_pdf']['tmp_name'] ) );
// Replace backslashes with slashes for Windows
// web servers
				$upload_return['file'] =
				str_replace( '\\', '/',
					$upload_return['file'] );
// Set upload path data if successful.
				if ( isset( $upload_return['error'] ) &&
					$upload_return['error'] != 0 ) {
					$errormsg = 'There was an error uploading';
				$errormsg .= 'your file. The error is: ';
				$errormsg .= $upload_return['error'];
				wp_die( $errormsg );
				exit;
			} else {
				$attach_data = get_post_meta( $post_id,
					'attach_data',[ 203 ], true );
				if ( !empty( $attach_data ) ) {
					unlink( $attach_data['file'] );
				}
				update_post_meta( $post_id, 'attach_data',
					$upload_return );
			}
		}
	}
}
}
add_filter( 'the_content', 'ch5_cfu_display_pdf_link' );

function ch5_cfu_display_pdf_link ( $content ) {
	$post_id = get_the_ID();
	if ( !empty( $post_id ) ) {
		if ( 'post' == get_post_type( $post_id ) ||
			'page' == get_post_type( $post_id ) ) {
			$attachment_data = get_post_meta( $post_id, 'attach_data', true );
		$post_source_header1 = get_post_meta($post_id, 'post_source_header1', true);
		$post_source_header2 = get_post_meta($post_id, 'post_source_header2', true);
		if ( !empty( $attachment_data ) ) {
			$image = '<div class="file_attachment"><div class="cover">'.$post_source_header1 . $post_source_header2.'</div>';
			$image .= '<img src="';
			$image .= esc_url( $attachment_data['url'] );
			$image .= '" width="100%" />' ;
			$image .= '</div>';
			$content = $image . $content;
		}
	}
}
return $content;
}
