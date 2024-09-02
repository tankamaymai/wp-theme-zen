<?php
if (function_exists('register_block_pattern')) {
    register_block_pattern(
        'mytheme/flex-section',
        array(
            'title' => __('横並びセクション', 'mytheme'),
            'description' => _x('顧客の声を表示するセクション', 'Block pattern description', 'mytheme'),
            'content' => '
<!-- wp:group {"className":"flex-section"} -->
<div class="wp-block-group flex-section">
    <div class="wp-block-group__inner-container">
        <!-- wp:heading {"textAlign":"center","level":2,"className":"flex-title design-heading"} -->
        <h2 class="has-text-align-center flex-title design-heading">タイトル</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center","className":"flex-subtitle"} -->
        <p class="has-text-align-center flex-subtitle">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
        <!-- /wp:paragraph -->

        <!-- wp:columns {"className":"flex-columns"} -->
        <div class="wp-block-columns flex-columns">
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"className":"flex-name"} -->
                <h3 class="flex-name">小タイトル</h3>
                <!-- /wp:heading -->
                
                <!-- wp:image {"align":"center","id":123,"sizeSlug":"medium","className":"flex-image"} -->
                <figure class="wp-block-image aligncenter size-medium flex-image"><img src="https://tokoton02.xsrv.jp/images/zen01.jpg" alt="テキスト"/></figure>
                <!-- /wp:image -->
                
                <!-- wp:paragraph {"className":"flex-text"} -->
                <p class="flex-text">サンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキスト</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"className":"flex-name"} -->
                <h3 class="flex-name">小タイトル</h3>
                <!-- /wp:heading -->
                
                <!-- wp:image {"align":"center","id":124,"sizeSlug":"medium","className":"voice-image"} -->
                <figure class="wp-block-image aligncenter size-medium flex-image"><img src="https://tokoton02.xsrv.jp/images/zen01.jpg" alt="テキスト"/></figure>
                <!-- /wp:image -->
                
                <!-- wp:paragraph {"className":"flex-text"} -->
                <p class="voice-text">サンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキスト</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:heading {"level":3,"className":"flex-name"} -->
                <h3 class="flex-name">小タイトル</h3>
                <!-- /wp:heading -->
                
                <!-- wp:image {"align":"center","id":125,"sizeSlug":"medium","className":"flex-image"} -->
                <figure class="wp-block-image aligncenter size-medium flex-image"><img src="https://tokoton02.xsrv.jp/images/zen01.jpg" alt="テキスト"/></figure>
                <!-- /wp:image -->
                
                <!-- wp:paragraph {"className":"flex-text"} -->
                <p class="flex-text">サンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキスト</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
</div>
<!-- /wp:group -->
',
            'categories' => array('zen'),
        )
    );
}