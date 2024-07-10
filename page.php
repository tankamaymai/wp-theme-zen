<?php
get_header();

// 固定ページのサイドバー表示設定を取得
$display_sidebar = get_theme_mod('mytheme_display_sidebar_page', true);
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        if (have_posts()) : // 追加: have_posts のチェック
            while (have_posts()) : the_post();
        ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    </header>

                    <div class="entry-content">
                        <?php
                        the_content();
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'your-text-domain'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <?php if (get_edit_post_link()) : ?>
                        <footer class="entry-footer">
                            <?php
                            edit_post_link(
                                sprintf(
                                    wp_kses(
                                        __('Edit <span class="screen-reader-text">%s</span>', 'your-text-domain'),
                                        array(
                                            'span' => array(
                                                'class' => array(),
                                            ),
                                        )
                                    ),
                                    get_the_title()
                                ),
                                '<span class="edit-link">',
                                '</span>'
                            );
                            ?>
                        </footer>
                    <?php endif; ?>
                </article>
        <?php
            endwhile; // End of the loop.
        else :
            // 現在のクエリに投稿がない場合の表示
            echo '<p>' . esc_html__('Sorry, no posts matched your criteria.', 'your-text-domain') . '</p>';
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php if ($display_sidebar) : ?>
    <aside id="secondary" class="widget-area">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </aside><!-- #secondary -->
<?php endif; ?>

<?php get_footer(); ?>