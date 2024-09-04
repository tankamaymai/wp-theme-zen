<?php
if (function_exists('register_block_pattern')) {
    register_block_pattern(
        'mytheme/cta-section',
        array(
            'title' => __('CTAセクション', 'mytheme'),
            'description' => _x('電話番号とボタンが横並びになっているセクション', 'Block pattern description', 'mytheme'),
            'content' => '
<!-- wp:group -->
<div class="wp-block-group">
    <div class="wp-block-group__inner-container">
        <!-- wp:columns -->
        <div class="wp-block-columns">
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"20px"}}} -->
            <p style="font-size:20px; color:#333333;">Call us now: <strong>123-456-7890</strong></p>
            <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"20px"}}} -->
            <p style="font-size:20px; color:#333333;">Call us now: <strong>123-456-7890</strong></p>
            <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
            <!-- wp:column -->
            <div class="wp-block-column">
                <!-- wp:paragraph {"style":{"typography":{"fontSize":"20px"}}} -->
            <p style="font-size:20px; color:#333333;">Call us now: <strong>123-456-7890</strong></p>
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
