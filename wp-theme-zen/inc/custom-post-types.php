<?php

// ブロックパーツのカスタム投稿タイプを追加
function mytheme_custom_post_types()
{
    register_post_type('template_part', array(
        'labels' => array(
            'name' => __('ブロックパーツ', 'your-text-domain'),
            'singular_name' => __('ブロックパーツ', 'your-text-domain')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true, // Gutenbergエディタ対応
    ));
}
add_action('init', 'mytheme_custom_post_types');

// カスタムカラムを追加
function add_template_part_columns($columns)
{
    $columns['shortcode'] = __('ショートコード', 'your-text-domain');
    return $columns;
}
add_filter('manage_template_part_posts_columns', 'add_template_part_columns');

// カスタムカラムの内容を表示
function template_part_custom_column($column, $post_id)
{
    if ($column === 'shortcode') {
        echo '[template_part id="' . $post_id . '"]';
    }
}
add_action('manage_template_part_posts_custom_column', 'template_part_custom_column', 10, 2);

// ショートコードを作成
function template_part_shortcode($atts)
{
    // 属性を取得
    $atts = shortcode_atts(array(
        'id' => ''
    ), $atts, 'template_part');

    // 投稿IDが指定されていない場合、何も返さない
    if (empty($atts['id'])) {
        return '';
    }

    // 投稿を取得
    $post = get_post($atts['id']);

    // 投稿が存在しない場合、何も返さない
    if (!$post || $post->post_type !== 'template_part') {
        return '';
    }

    // 投稿内容を返す
    return apply_filters('the_content', $post->post_content);
}
add_shortcode('template_part', 'template_part_shortcode');
