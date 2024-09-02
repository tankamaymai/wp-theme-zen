<?php
if (class_exists('WP_Customize_Control')) {
    class Customize_Heading_Control extends WP_Customize_Control
    {
        public $type = 'heading';

        public function render_content()
        {
?>
            <h2 class="customize-control-title"><?php echo esc_html($this->label); ?></h2>
<?php
        }
    }
}
?>