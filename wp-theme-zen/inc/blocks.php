<?php

function mytheme_enqueue_block_assets()
{
    // エディタ用のスクリプトとスタイル
    wp_enqueue_script(
        'mytheme-blocks-editor',
        get_template_directory_uri() . '/blocks/index.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        filemtime(get_template_directory() . '/blocks/index.js'),
        true
    );

    wp_enqueue_style(
        'mytheme-blocks-editor-style',
        get_template_directory_uri() . '/blocks/editor-style.css', // 必要に応じてエディタ用のスタイルを追加
        array(),
        filemtime(get_template_directory() . '/blocks/editor-style.css')
    );
}
add_action('enqueue_block_editor_assets', 'mytheme_enqueue_block_assets');

function mytheme_enqueue_frontend_assets()
{
    // フロントエンド用のスクリプトとスタイル
    wp_enqueue_script(
        'mytheme-blocks-frontend',
        get_template_directory_uri() . '/js/blocks.js',
        array(),
        filemtime(get_template_directory() . '/js/blocks.js'),
        true
    );

    wp_enqueue_style(
        'mytheme-blocks-frontend-style',
        get_template_directory_uri() . '/blocks/frontend-style.css', // 必要に応じてフロントエンド用のスタイルを追加
        array(),
        filemtime(get_template_directory() . '/blocks/frontend-style.css')
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_frontend_assets');
