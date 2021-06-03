<?php

/***
* Plugin Name: Save All Posts from WP-CLI
* Pluin Author: Shawn M. Hooper
* Author URL: https://shawnhooper.ca/
* Plugin Version: 1.0
****/

class AWP_Save_All_Posts {

	function __construct() {
		WP_CLI::add_command( 'save-all-posts', array( $this, 'save_all_posts' ) );
	}

	function save_all_posts( $args, $assoc_args ) {

		$results = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => -1, 'order' => 'ASC' ) );

		foreach ( $results->posts as $post ) {
			WP_CLI::success('Updating Post ID # ' . $post->ID);
			wp_update_post( $post );
		}

	}

}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	$awp_save_all_posts = new AWP_Save_All_Posts();
}
