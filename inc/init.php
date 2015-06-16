<?php

class fireInit{

	function __construct() {
		add_action( 'init', array( $this, '_chat_cpt' ) );
		add_action( 'init', array( $this, '_chat_tax' ) );
	}

	function _chat_cpt() {
		$labels = array(
			'name'               => _x( 'Chat Rooms', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Chat Room', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Chat Rooms', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Chat Room', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New Room', 'chat', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Chat Room', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Room', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Room', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Room', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Chat Rooms', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Chat Rooms', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Rooms:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No chat rooms found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No chat rooms found in Trash.', 'your-plugin-textdomain' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'chat-rooms' ),
			'capability_type'    => 'page',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'page-attributes', 'custom-fields' ),
		);

		register_post_type( 'chatrooms', $args );
	}
	function _chat_tax() {

		$labels = array(
			'name'              => _x( 'Chat Topics', 'taxonomy general name' ),
			'singular_name'     => _x( 'Chat Topic', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Topics' ),
			'all_items'         => __( 'All Topics' ),
			'parent_item'       => __( 'Parent Topic' ),
			'parent_item_colon' => __( 'Parent Tppic:' ),
			'edit_item'         => __( 'Edit Topic' ),
			'update_item'       => __( 'Update Topic' ),
			'add_new_item'      => __( 'Add New Chat Topic' ),
			'new_item_name'     => __( 'New Chat Topic Name' ),
			'menu_name'         => __( 'Topics' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'chat-topics' ),
		);

		register_taxonomy( 'chat-topics', array( 'chatrooms' ), $args );

	}

}
