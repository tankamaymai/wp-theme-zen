<?php
function mytheme_zen_block_categories($categories, $post)
{

    $new_category = array(
        array(
            'slug' => 'zen', // カテゴリーのスラッグ
            'title' => 'zenブロック', // 表示名
            // 'icon' => 'wordpress', // アイコン（任意で設定）
        ),
    );

    // 新しいカテゴリーを既存のカテゴリーの先頭に追加する
    return array_merge($new_category, $categories);
}

add_filter('block_categories_all', 'mytheme_zen_block_categories', 10, 2);


function mytheme_register_design_heading_block()
{
    wp_register_script(
        'design-heading-block',
        get_template_directory_uri() . '/blocks/design-heading/design-heading.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        '1.0.0',
        true
    );

    wp_register_style(
        'design-heading-block-style',
        get_template_directory_uri() . '/blocks/design-heading/design-heading.css',
        array(),
        '1.0.0'
    );

    register_block_type('mytheme/design-heading', array(
        'editor_script' => 'design-heading-block',
        'editor_style'  => 'design-heading-block-style',
        'style'         => 'design-heading-block-style',
    ));
}

add_action('init', 'mytheme_register_design_heading_block');


function mytheme_register_fullwidth_block()
{
    wp_register_script(
        'fullwidth-block',
        get_template_directory_uri() . '/blocks/fullwidth/fullwidth.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        '1.0.0',
        true
    );

    wp_register_style(
        'fullwidth-block-style',
        get_template_directory_uri() . '/blocks/fullwidth/fullwidth.css',
        array(),
        '1.0.0'
    );

    register_block_type('mytheme/fullwidth', array(
        'editor_script' => 'fullwidth-block',
        'editor_style'  => 'fullwidth-block-style',
        'style'         => 'fullwidth-block-style',
        'supports' => array(
            'align' => array('full')
        )
    ));
}

add_action('init', 'mytheme_register_fullwidth_block');


function mytheme_register_faq_block()
{
    wp_register_script(
        'faq-block',
        get_template_directory_uri() . '/blocks/faq/faq.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components'),
        '1.0.0',
        true
    );

    wp_register_style(
        'faq-block-style',
        get_template_directory_uri() . '/blocks/faq/faq.css',
        array(),
        '1.0.0'
    );

    register_block_type('mytheme/faq', array(
        'editor_script' => 'faq-block',
        'editor_style'  => 'faq-block-style',
        'style'         => 'faq-block-style',
    ));
}

add_action('init', 'mytheme_register_faq_block');

function mytheme_register_heading_box_block()
{
    wp_register_script(
        'heading-box-block',
        get_template_directory_uri() . '/blocks/heading-box/heading-box.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        '1.0.0',
        true
    );

    wp_register_style(
        'heading-box-block-style',
        get_template_directory_uri() . '/blocks/heading-box/heading-box.css',
        array(),
        '1.0.0'
    );

    register_block_type('mytheme/heading-box', array(
        'editor_script' => 'heading-box-block',
        'editor_style'  => 'heading-box-block-style',
        'style'         => 'heading-box-block-style',
    ));
}

add_action('init', 'mytheme_register_heading_box_block');

function mytheme_register_comparison_table_block()
{
    wp_register_script(
        'comparison-table-block',
        get_template_directory_uri() . '/blocks/comparison-table/comparison-table.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        '1.0.0',
        true
    );

    wp_register_style(
        'comparison-table-block-style',
        get_template_directory_uri() . '/blocks/comparison-table/comparison-table.css',
        array(),
        '1.0.0'
    );

    register_block_type('mytheme/comparison-table', array(
        'editor_script' => 'comparison-table-block',
        'editor_style'  => 'comparison-table-block-style',
        'style'         => 'comparison-table-block-style',
    ));
}
add_action('init', 'mytheme_register_comparison_table_block');
