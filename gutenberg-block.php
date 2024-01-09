<?php
/**
 * Plugin Name: Gutenberg Block
 * Description: An example plugin for registering a Gutenberg block.
 * Version: 0.0.1
 * Author: Tom Nowell, Automattic
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: gutenberg-block
 */


function gutenberg_block_dynamic_render_callback ($attributes, $content)
{
    $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 1,
        'post_status' => 'publish',
    ));

    if (count($recent_posts) === 0) {
        return 'No posts';
    }

    $post = $recent_posts[0];
    $post_id = $post['ID'];

    return sprintf(
        '<a class="wp-block-my-plugin-latest-post" href="%1$s">%2$s</a>',
        esc_url(get_permalink($post_id)),
        esc_html(get_the_title($post_id))
    );


}


function gutenberg_register_block ()
{

    $asset_file = include(plugin_dir_path(__FILE__) . 'build/index.asset.php');

    wp_register_script(
        'gutenberg-block',
        plugins_url('build/index.js', __FILE__),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type('gutenberg-block/gutenberg-block', array(
        'api_version' => 3,
        'editor_script' => 'gutenberg-block',
        'render_callback' => 'gutenberg_block_dynamic_render_callback',
    ));
}

add_action('init', 'gutenberg_register_block');


//Create a block category for our blocks
function gutenberg_block_register_category ($categories)
{

    $categories [] = [
        'slug' => 'gutenberg-block-category',
        'title' => __('Gutenberg Block (Custom)', 'gutenberg-block'),
        'icon' => 'wordpress',
    ];

    return $categories;

}

add_filter('block_categories_all', 'gutenberg_block_register_category');


add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script(
        'gutenberg-block',
        plugins_url('build/index.js', __FILE__),
        array( 'wp-blocks', 'wp-block-editor', 'wp-element' ),
        filemtime(plugin_dir_path(__FILE__) . 'build/index.js')
    );
});


// Loads both the editor and frontend scripts
function gutenberg_block_enqueue_scripts ()
{

}

add_action('enqueue_block_assets', 'gutenberg_block_enqueue_scripts');