<?php get_header(); ?>

<div class="wrapper">
    <section>
        <div class="contents-140 mt-10">
            <h2 class="fs-43 main-color mt-5 mincho fade-up-d">癌の治療について</h2>
        </div>
    </section>
</div>

<div class="contents-140 sp-mgn mt-5 mb-15">
    <div class="pankuzu"><a href="<?php echo esc_url(home_url('/')); ?>">HOME</a>　＞　癌の治療について</div>
    <div class="flex fl-between mb-5">
        <div class="contents-140 grid-3">

            <?php
            if (have_posts()):
                while (have_posts()):
                    the_post(); ?>

                    <div class="grid-column text-c mt-5 m-auto">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()):
                                the_post_thumbnail(array(420, 315), array('class' => 'responsive'));
                            else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/noimg.jpg" class="responsive">
                            <?php endif; ?>

                            <div class="autoplay-bg text-l">
                                <p class="day-bcg mt-1">
                                    <?php the_time('Y.m.d') ?>
                                </p>
                                <p class="post-title black">
                                    <?php
                                    if (mb_strlen($post->post_title, 'UTF-8') > 40) {
                                        $title = mb_substr($post->post_title, 0, 40, 'UTF-8');
                                        echo $title . '…';
                                    } else {
                                        echo $post->post_title;
                                    }
                                    ?>
                                </p>
                            </div>
                        </a>
                    </div>
                <?php
                endwhile;
            else: ?>

                <p>こちらのページはただいま公開に向けて準備中です。<br>
                    ご迷惑をおかけして申し訳ございませんが、今しばらくお待ちいただけますようお願い申し上げます。</p>

            <?php
            endif; ?>
        </div>

        <div class="pager-wrapper">
            <div class="pager">
                <?php global $wp_rewrite;
                $paginate_base = get_pagenum_link(1);
                if (strpos($paginate_base, '?') || !$wp_rewrite->using_permalinks()) {
                    $paginate_format = '';
                    $paginate_base = add_query_arg('paged', '%#%');
                } else {
                    $paginate_format = (substr($paginate_base, -1, 1) == '/' ? '' : '/') .
                        user_trailingslashit('page/%#%/', 'paged');
                    ;
                    $paginate_base .= '%_%';
                }
                echo paginate_links(array(
                    'base' => $paginate_base,
                    'format' => $paginate_format,
                    'total' => $wp_query->max_num_pages,
                    'end_size' => 1,
                    'mid_size' => 1,
                    'current' => ($paged ? $paged : 1),
                    'prev_text' => '«',
                    'next_text' => '»',
                )); ?>
            </div>
        </div>
    </div>
</div>

<?php wp_reset_query();
if (!is_page(array('inquiry', 'entry'))): ?>
    <?php include("inc/contactarea.php"); ?>
<?php else: ?>
<?php endif; ?>

<?php get_footer(); ?>