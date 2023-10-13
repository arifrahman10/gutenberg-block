<?php
function gutenberg_block_register_block() {

    register_block_type( 'gutenberg-examples/example-01-basic', array(
        'editor_script' => 'gutenberg-examples-01',
    ) );

}

add_action( 'init', 'gutenberg_block_register_block' );



function gutenberg_block_enqueue_assets() {
    wp_enqueue_script(
        'gutenberg-block-script',
        plugins_url('/src/block.js', __FILE__),
        array('wp-blocks', 'wp-components', 'wp-i18n'),
        filemtime(plugin_dir_path(__FILE__) . '/src/block.js')
    );
}

add_action('enqueue_block_editor_assets', 'gutenberg_block_enqueue_assets');
