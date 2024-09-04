<footer id="site-footer" class="site-footer">
    <div class="footer-widgets">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
            <aside class="footer-widget-column footer-widget-column-<?php echo $i; ?>">
                <?php if (is_active_sidebar('footer-widget-area-' . $i)) : ?>
                    <?php dynamic_sidebar('footer-widget-area-' . $i); ?>
                <?php endif; ?>
            </aside>
        <?php endfor; ?>
    </div>

    <div class="site-info">
        <?php echo esc_html(get_theme_mod('mytheme_footer_copyright', '©2024 WP ZEN')); ?>
    </div><!-- .site-info -->
</footer><!-- #site-footer -->

<?php wp_footer(); ?>
</body>

</html>