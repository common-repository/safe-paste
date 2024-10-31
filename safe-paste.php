<?php
/**
 * Plugin Name: Safe Paste
 * Plugin URI: http://www.samuelaguilera.com
 * Description: Removes a lot of HTML tags from post and page content before inserting it to database. Preventing users to paste undesired HTML tags to post content.
 * Author: Samuel Aguilera
 * Version: 1.1.9
 * Author URI: http://www.samuelaguilera.com
 * License: GPL2
 *
 * @package Safe Paste
 */

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License version 2 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Main function.
 *
 * @param array $data    An array of slashed post data.
 * @param array $postarr An array of sanitized, but otherwise unmodified post data.
 */
function sar_clean_post( $data, $postarr ) {

	$post_type = get_post_type( $postarr['ID'] );

	$types_to_filter = array( 'post', 'page' );

	// Allow customization of post types to filter. Use at your own risk!
	$types_to_filter = apply_filters( 'safepaste_post_types', $types_to_filter );

	// Only make the job on specified post types and users without 'unfiltered_html' capability.
	if ( in_array( $post_type, $types_to_filter, true ) && ! current_user_can( 'unfiltered_html' ) ) {

		// These are the tags allowed.
		$allowed_tags = array(
			'p'          => array(),
			'a'          => array(
				'href'  => array(),
				'title' => array(),
			),
			'img'        => array(
				'src'    => array(),
				'alt'    => array(),
				'class'  => array(),
				'width'  => array(),
				'height' => array(),
			),
			'h1'         => array(),
			'h2'         => array(),
			'h3'         => array(),
			'h4'         => array(),
			'h5'         => array(),
			'h6'         => array(),
			'blockquote' => array(),
			'ol'         => array(),
			'ul'         => array(),
			'li'         => array(),
			'em'         => array(),
			'strong'     => array(),
			'del'        => array(),
			'code'       => array(),
			'ins'        => array(
				'datetime' => true,
				'cite'     => true,
			),
		);

		// Allow customization of allowed tags. Use at your own risk!
		$allowed_tags = apply_filters( 'safepaste_allowed_tags', $allowed_tags );

		// Allow only web protocol prefixes.
		$allowed_protocols = array( 'http', 'https' );

		// Allow customization of allowed protocols. Use it at your own risk!
		$allowed_protocols = apply_filters( 'safepaste_allowed_protocols', $allowed_protocols );

		// Doing the clean for HTML tags...
		$data['post_content'] = wp_kses( $data['post_content'], $allowed_tags, $allowed_protocols );

		// Removes only &nbsp; .
		$data['post_content'] = preg_replace( '/&nbsp;/i', '', $data['post_content'] );

	}

	return $data;

}

add_filter( 'wp_insert_post_data', 'sar_clean_post', 99, 2 );
