<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php echo esc_html__('Oops! That page can’t be found.', 'your-text-domain'); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php echo esc_html__('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'your-text-domain'); ?></p>

                <?php get_search_form(); ?>

                <?php the_widget('WP_Widget_Recent_Posts'); ?>

                <div class="widget widget_categories">
                    <h2 class="widget-title"><?php echo esc_html__('Most Used Categories', 'your-text-domain'); ?></h2>
                    <ul>
                        <?php wp_list_categories(array('orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10)); ?>
                    </ul>
                </div>

                <?php the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>"); ?>
            </div><!-- .page-content -->
        </section><!-- .error-404 -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>