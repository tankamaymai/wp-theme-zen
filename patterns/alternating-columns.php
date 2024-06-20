<?php
if (function_exists('register_block_pattern')) {
    register_block_pattern(
        'mytheme/alternating-columns',
        array(
            'title' => __('画像とテキストが互い違いのレイアウト', 'mytheme'),
            'description' => _x('An alternating two-column layout with images and text.', 'Block pattern description', 'mytheme'),
            'content' => '
<!-- wp:group -->
<div class="wp-block-group">
    <div class="wp-block-group__inner-container">
        <!-- wp:columns -->
        <div class="wp-block-columns">
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:image -->
                <figure class="wp-block-image"><img src="https://tokoton02.xsrv.jp/images/zen01.jpg" /></figure>
                <!-- /wp:image -->
            </div>
            <!-- /wp:column -->
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:paragraph -->
                <p>' . __('これはサンプルテキストです。これはサンプルテキストです。これはサンプルテキストです。これはサンプルテキストです。これはサンプルテキストです。', 'mytheme') . '</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->

        <!-- wp:columns -->
        <div class="wp-block-columns">
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:paragraph -->
                <p>' . __('これはサンプルテキストです。これはサンプルテキストです。これはサンプルテキストです。これはサンプルテキストです。これはサンプルテキストです。', 'mytheme') . '</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:image -->
                <figure class="wp-block-image"><img src="https://tokoton02.xsrv.jp/images/zen02.jpg" /></figure>
                <!-- /wp:image -->
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
