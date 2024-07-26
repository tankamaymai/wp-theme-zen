<?php
function mytheme_customize_floating_button($wp_customize)
{
    // フローティングボタン設定セクションの追加
    $wp_customize->add_section('mytheme_floating_button_settings', array(
        'title'    => __('フローティングボタン設定', 'mytheme'),
        'priority' => 35
    ));

    // フローティングボタンの表示設定
    $wp_customize->add_setting('mytheme_display_floating_button', array(
        'default'   => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_display_floating_button', array(
        'type'     => 'checkbox',
        'section'  => 'mytheme_floating_button_settings',
        'label'    => __('フローティングボタンを表示する', 'mytheme'),
        'description' => __('チェックすると、フローティングボタンが表示されます。', 'mytheme'),
    ));

    // フローティングボタンのPC表示設定
    $wp_customize->add_setting('mytheme_display_floating_button_pc', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_display_floating_button_pc', array(
        'type'     => 'checkbox',
        'section'  => 'mytheme_floating_button_settings',
        'label'    => __('PCでフローティングボタンを表示する', 'mytheme'),
        'active_callback' => function() use ($wp_customize) {
            return $wp_customize->get_setting('mytheme_display_floating_button')->value();
        },
    ));

    // フローティングボタンのSP表示設定
    $wp_customize->add_setting('mytheme_display_floating_button_sp', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('mytheme_display_floating_button_sp', array(
        'type'     => 'checkbox',
        'section'  => 'mytheme_floating_button_settings',
        'label'    => __('スマホでフローティングボタンを表示する', 'mytheme'),
        'active_callback' => function() use ($wp_customize) {
            return $wp_customize->get_setting('mytheme_display_floating_button')->value();
        },
    ));

    // フローティングボタンのタイプ設定
    $wp_customize->add_setting('mytheme_floating_button_type', array(
        'default'   => 'text',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_floating_button_type', array(
        'label'    => __('フローティングボタンのタイプ', 'mytheme'),
        'section'  => 'mytheme_floating_button_settings',
        'type'     => 'select',
        'choices'  => array(
            'text'  => __('テキスト', 'mytheme'),
            'image' => __('画像', 'mytheme'),
            'fullwidth_image' => __('画像(全幅)', 'mytheme'), // 追加
        ),
    ));

    // フローティングボタンの背景色設定
    $wp_customize->add_setting('mytheme_floating_button_background_color', array(
        'default'   => '#ff0000',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_floating_button_background_color', array(
        'label'    => __('フローティングボタンの背景色', 'mytheme'),
        'section'  => 'mytheme_floating_button_settings',
        'settings' => 'mytheme_floating_button_background_color',
    )));

    // フローティングボタンの文字色設定
    $wp_customize->add_setting('mytheme_floating_button_text_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mytheme_floating_button_text_color', array(
        'label'    => __('フローティングボタンの文字色', 'mytheme'),
        'section'  => 'mytheme_floating_button_settings',
        'settings' => 'mytheme_floating_button_text_color',
    )));

    // フローティングボタンのテキスト設定
    $wp_customize->add_setting('mytheme_floating_button_text', array(
        'default'   => __('お問い合わせ', 'mytheme'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_floating_button_text', array(
        'label'    => __('フローティングボタンのテキスト', 'mytheme'),
        'section'  => 'mytheme_floating_button_settings',
        'type'     => 'text',
    ));

    // フローティングボタンのリンク先設定
    $wp_customize->add_setting('mytheme_floating_button_link', array(
        'default'   => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('mytheme_floating_button_link', array(
        'label'    => __('フローティングボタンのリンク先', 'mytheme'),
        'section'  => 'mytheme_floating_button_settings',
        'type'     => 'url',
    ));

    // フローティングボタンの位置設定
    $wp_customize->add_setting('mytheme_floating_button_position', array(
        'default'   => 'right',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_floating_button_position', array(
        'label'    => __('フローティングボタンの位置', 'mytheme'),
        'section'  => 'mytheme_floating_button_settings',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __('左', 'mytheme'),
            'center' => __('中央', 'mytheme'),
            'right'  => __('右', 'mytheme'),
        ),
    ));

    // フローティングボタンの画像設定
    $wp_customize->add_setting('mytheme_floating_button_image', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'mytheme_floating_button_image', array(
        'label'    => __('フローティングボタンの画像', 'mytheme'),
        'section'  => 'mytheme_floating_button_settings',
        'settings' => 'mytheme_floating_button_image',
    )));
}
add_action('customize_register', 'mytheme_customize_floating_button');

function mytheme_floating_button_styles()
{
    $display_button = get_theme_mod('mytheme_display_floating_button', false);
    $display_button_pc = get_theme_mod('mytheme_display_floating_button_pc', true);
    $display_button_sp = get_theme_mod('mytheme_display_floating_button_sp', true);

    if ($display_button) {
        $button_type = get_theme_mod('mytheme_floating_button_type', 'text');
        $button_bg_color = get_theme_mod('mytheme_floating_button_background_color', '#ff0000');
        $button_text_color = get_theme_mod('mytheme_floating_button_text_color', '#ffffff');
        $button_text = get_theme_mod('mytheme_floating_button_text', __('お問い合わせ', 'mytheme'));
        $button_link = get_theme_mod('mytheme_floating_button_link', '#');
        $button_position = get_theme_mod('mytheme_floating_button_position', 'right');
        $button_image = get_theme_mod('mytheme_floating_button_image', '');

        $position_css = '';
        switch ($button_position) {
            case 'left':
                $position_css = 'left: 20px;';
                break;
            case 'center':
                $position_css = 'left: 50%; transform: translateX(-50%);';
                break;
            case 'right':
                $position_css = 'right: 20px;';
                break;
        }

        $custom_css = "
            .floating-button {
                position: fixed;
                bottom: 20px;
                {$position_css}
                z-index: 9999;
                text-align: center;
                text-decoration: none;
                display: inline-block;
            }

            .floating-button.text {
                background-color: {$button_bg_color};
                color: {$button_text_color};
                padding: 10px 20px;
                border-radius: 50px;
            }

            .floating-button.image img {
                max-width: 200px;
                height: auto;
                width: 100%;
            }

            .floating-button.fullwidth_image img {
                width: 100%;
                height: auto;
            }

            " . ($display_button_pc ? "" : "
            @media (min-width: 769px) {
                .floating-button {
                    display: none;
                }
            }") . "

            " . ($display_button_sp ? "" : "
            @media (max-width: 768px) {
                .floating-button {
                    display: none;
                }
            }") . "

            @media (max-width: 768px) {
                .floating-button.fullwidth_image {
                    width: 100%;
                    left: 50%;
                    transform: translateX(-50%);
                    text-align: center;
                }
            }
        ";
        wp_add_inline_style('mytheme-style', $custom_css);

        // フローティングボタンのHTMLを追加
        add_action('wp_footer', function () use ($button_type, $button_text, $button_link, $button_image) {
            if ($button_type === 'image' && $button_image) {
                echo '<a href="' . esc_url($button_link) . '" class="floating-button image"><img src="' . esc_url($button_image) . '" alt="Floating Button"></a>';
            } elseif ($button_type === 'fullwidth_image' && $button_image) {
                echo '<a href="' . esc_url($button_link) . '" class="floating-button fullwidth_image"><img src="' . esc_url($button_image) . '" alt="Floating Button"></a>';
            } else {
                echo '<a href="' . esc_url($button_link) . '" class="floating-button text">' . esc_html($button_text) . '</a>';
            }
        });
    }
}
add_action('wp_enqueue_scripts', 'mytheme_floating_button_styles');

// JavaScriptを追加して、PCとSPのチェックボックスの状態に応じてフローティングボタンの表示設定を制御
function mytheme_customizer_script() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        function updateFloatingButtonDisplay() {
            var displayButton = $('#customize-control-mytheme_display_floating_button input');
            var displayButtonPC = $('#customize-control-mytheme_display_floating_button_pc input');
            var displayButtonSP = $('#customize-control-mytheme_display_floating_button_sp input');

            if (!displayButtonPC.is(':checked') && !displayButtonSP.is(':checked')) {
                displayButton.prop('checked', false).change();
            }
        }

        $('#customize-control-mytheme_display_floating_button_pc input, #customize-control-mytheme_display_floating_button_sp input').on('change', function() {
            updateFloatingButtonDisplay();
        });

        updateFloatingButtonDisplay();
    });
    </script>
    <?php
}
add_action('customize_controls_print_footer_scripts', 'mytheme_customizer_script');