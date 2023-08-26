<?php
/**
 * Plugin Name: Gutenberg Block
 * Plugin URI:
 * Description: A Gutenberg Block
 * Author: Arif Rahman
 * Author URI: https://arifrahman.tech
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: gutenberg-block
 * Domain Path: /languages
 * @package Gutenberg Block
 */

function my_plugin_enqueue_assets() {
	wp_enqueue_script(
		'my-gutenberg-block-script',
		plugins_url( 'blocks/src/block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-components', 'wp-i18n' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'blocks/src/block.js' )
	);
}

add_action( 'enqueue_block_editor_assets', 'my_plugin_enqueue_assets' );
