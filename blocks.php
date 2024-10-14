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

function mytheme_register_accordion_block()
{
    wp_register_script(
        'accordion-block',
        get_template_directory_uri() . '/blocks/accordion/accordion.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components'),
        '1.0.0',
        true
    );

    wp_register_style(
        'accordion-block-style',
        get_template_directory_uri() . '/blocks/accordion/accordion.css',
        array(),
        '1.0.0'
    );

    register_block_type('mytheme/accordion', array(
        'editor_script' => 'accordion-block',
        'editor_style'  => 'accordion-block-style',
        'style'         => 'accordion-block-style',
    ));
}

add_action('init', 'mytheme_register_accordion_block');

// FAQブロックは一旦非表示

// function mytheme_register_faq_block()
// {
//     wp_register_script(
//         'faq-block',
//         get_template_directory_uri() . '/blocks/faq/faq.js',
//         array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components'),
//         '1.0.0',
//         true
//     );

//     wp_register_style(
//         'faq-block-style',
//         get_template_directory_uri() . '/blocks/faq/faq.css',
//         array(),
//         '1.0.0'
//     );

//     register_block_type('mytheme/faq', array(
//         'editor_script' => 'faq-block',
//         'editor_style'  => 'faq-block-style',
//         'style'         => 'faq-block-style',
//     ));
// }

// add_action('init', 'mytheme_register_faq_block');

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

function mytheme_register_separator_block()
{
    wp_register_script(
        'separator-block',
        get_template_directory_uri() . '/blocks/separator/separator.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        '1.0.0',
        true
    );

    wp_register_style(
        'separator-block-style',
        get_template_directory_uri() . '/blocks/separator/separator.css',
        array(),
        '1.0.0'
    );

    register_block_type('mytheme/separator', array(
        'editor_script' => 'separator-block',
        'editor_style'  => 'separator-block-style',
        'style'         => 'separator-block-style',
    ));
}

add_action('init', 'mytheme_register_separator_block');

function mytheme_register_arrow_block()
{
    wp_register_script(
        'arrow-block',
        get_template_directory_uri() . '/blocks/arrow/arrow.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components'),
        '1.0.0',
        true
    );

    wp_register_style(
        'arrow-block-style',
        get_template_directory_uri() . '/blocks/arrow/arrow.css',
        array(),
        '1.0.0'
    );

    register_block_type('mytheme/arrow', array(
        'editor_script' => 'arrow-block',
        'editor_style'  => 'arrow-block-style',
        'style'         => 'arrow-block-style',
    ));
}

add_action('init', 'mytheme_register_arrow_block');


function mytheme_register_custom_list_styles()
{
    wp_register_script(
        'custom-list-styles',
        get_template_directory_uri() . '/blocks/list/list.js',
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
        filemtime(get_template_directory() . '/blocks/list/list.js')
    );

    wp_register_style(
        'custom-list-styles',
        get_template_directory_uri() . '/blocks/list/list.css',
        array(),
        filemtime(get_template_directory() . '/blocks/list/list.css')
    );

    wp_enqueue_script('custom-list-styles');
    wp_enqueue_style('custom-list-styles');
}
add_action('enqueue_block_editor_assets', 'mytheme_register_custom_list_styles');


// フロントエンド用のスタイルを読み込む
function mytheme_enqueue_custom_block_styles()
{
    wp_enqueue_style(
        'custom-list-styles',
        get_template_directory_uri() . '/blocks/list/list.css',
        array(),
        filemtime(get_template_directory() . '/blocks/list/list.css')
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_custom_block_styles');
