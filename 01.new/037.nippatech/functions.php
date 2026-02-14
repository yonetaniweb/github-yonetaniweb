<?php
/****************************
Wordperssデフォルト削除
****************************/

// 絵文字を無効に
function disable_emoji()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'disable_emoji');

// wp_headに入る余計なコードを削除
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('template_redirect', 'rest_output_link_header', 11);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
add_filter('emoji_svg_url', '__return_false');
remove_action('wp_head', 'wp_shortlink_wp_head');

//wordpressのバージョンを非表示
remove_action('wp_head', 'wp_generator');

// 検索エンジンロボットの非表示
remove_filter('wp_robots', 'wp_robots_max_image_preview_large');

//プラグインのバージョンを非表示
function remove_cssjs_ver2($src)
{
    if (strpos($src, 'ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}
add_filter('style_loader_src', 'remove_cssjs_ver2', 9999);
add_filter('script_loader_src', 'remove_cssjs_ver2', 9999);

/*デフォルトのjsを読み込まない
function delete_jquery() {
  if (!is_admin()) {
    wp_deregister_script('jquery');
  }
}
add_action('init', 'delete_jquery');
*/

/* デフォルトの投稿からタグを削除する */
function remove_default_post_tags()
{
    // タグメタボックスをデフォルトの投稿タイプから削除
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'remove_default_post_tags');


/****************************
ログイン画面
****************************/

// ログイン画面の表示を変更
function change_loginpage_username_label($label)
{
    if (in_array($GLOBALS['pagenow'], array('wp-login.php'))) {
        if ($label == 'ユーザー名またはメールアドレス') {
            $label = 'ID';
        }
    }
    return $label;
}
add_filter('gettext', 'change_loginpage_username_label');

//ログイン画面画像差し替え
function logo_custom()
{ ?>
    <style>
        .login #login h1 a {
            width: 250px;
            background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg) no-repeat 0 0;
            background-size: 250px;
            margin-bottom: -2rem;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'logo_custom');

//パスワードをお忘れですか？と～に戻るを消す
function login_nav_backtoblog_hide()
{ ?>
    <style>
        .login #nav,
        .login #backtoblog {
            display: none;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'login_nav_backtoblog_hide');

/****************************
管理画面
****************************/

//ユーザー毎に管理画面表示変える
add_action('admin_menu', 'remove_menus');

function remove_menus()
{
    $current_user = wp_get_current_user();
    $restricted_users = array('edit', 'notake', 'matsui', 'info');

    if (in_array($current_user->user_login, $restricted_users)) {
        remove_menu_page('index.php');                  //ダッシュボードを隠します
        //remove_menu_page( 'edit.php' );                   //投稿メニュを隠します
        //remove_menu_page( 'edit.php?post_type=page' );    //ページ追加を隠します
        remove_menu_page('wpcf7');                        //contact form 7
        remove_menu_page('edit-comments.php');          //コメントメニューを隠します
        remove_menu_page('themes.php');                 //外観メニューを隠します
        remove_menu_page('plugins.php');                //プラグインメニューを隠します
        //remove_menu_page( 'profile.php' );                //プロフィールメニューを隠します
        remove_menu_page('tools.php');                  //ツールメニューを隠します
        remove_menu_page('options-general.php');        //設定メニューを隠します
    }
}


// 「投稿」を任意の名前に変更する
function Change_menulabel()
{
    global $menu;
    global $submenu;
    $name = '癌の治療について';
    $menu[5][0] = $name;
    $submenu['edit.php'][5][0] = '記事一覧';
    $submenu['edit.php'][10][0] = '新規追加';
}
function Change_objectlabel()
{
    global $wp_post_types;
    $name = '癌の治療について';
    $labels = &$wp_post_types['post']->labels;
    $labels->name = $name;
    $labels->singular_name = $name;
    $labels->add_new = _x('追加', $name);
    $labels->add_new_item = $name . 'の新規追加';
    $labels->edit_item = $name . 'の編集';
    $labels->new_item = '新規' . $name;
    $labels->view_item = $name . 'を表示';
    $labels->search_items = $name . 'を検索';
    $labels->not_found = $name . 'が見つかりませんでした';
    $labels->not_found_in_trash = 'ゴミ箱に' . $name . 'は見つかりませんでした';
}
add_action('init', 'Change_objectlabel');
add_action('admin_menu', 'Change_menulabel');

// メニューの並び替え
function custom_menu_order($menu_ord)
{
    if (!$menu_ord)
        return true;
    return array(
        'index.php', // ダッシュボード
        'separator1', // 仕切り
        'separator-last', // 仕切り
        'upload.php', // メディア
        'edit.php?post_type=page', // 固定ページ
        'edit.php?post_type=news', // お知らせ
        'edit.php', // 癌の治療について
    );
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');

// ダイナミックサイドバーを定義する
register_sidebar(array(
    'name' => 'サイドメニュー：癌の治療について',
    'id' => 'sidebar-blog',
    'description' => '癌の治療についてのサイドメニューを設定できます。',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
));
register_sidebar(array(
    'name' => 'サイドメニュー：お知らせ',
    'id' => 'sidebar-news',
    'description' => 'お知らせのサイドメニューを設定できます。',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
));

// カスタムメニュー
function menu_setup()
{
    register_nav_menus(array(
        'news-menu' => 'お知らせメニュー'
    ));
}
add_action('after_setup_theme', 'menu_setup');

/****************************
投稿画面
****************************/

// カラーパレット追加
function mytheme_setup_theme_supported_features()
{
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('main', 'themeLangDomain'),
            'slug' => 'main',
            'color' => '#AB8D63',
        ),
        array(
            'name' => __('sub', 'themeLangDomain'),
            'slug' => 'sub',
            'color' => '#B69C53',
        ),
        array(
            'name' => __('gray', 'themeLangDomain'),
            'slug' => 'gray',
            'color' => '#F2F4F6',
        ),
        array(
            'name' => __('main-base', 'themeLangDomain'),
            'slug' => 'main-base',
            'color' => '#F6F5F2',
        ),
        array(
            'name' => __('gray-base', 'themeLangDomain'),
            'slug' => 'gray-base',
            'color' => '#F7F7F7',
        ),
        array(
            'name' => __('white', 'themeLangDomain'),
            'slug' => 'white',
            'color' => '#fff',
        ),
        array(
            'name' => __('red', 'themeLangDomain'),
            'slug' => 'red',
            'color' => '#B12A1D',
        ),
        array(
            'name' => __('black', 'themeLangDomain'),
            'slug' => 'black',
            'color' => '#231815',
        ),
    ));
}
add_action('after_setup_theme', 'mytheme_setup_theme_supported_features');

// カラーの自由な設定を無効
add_theme_support('disable-custom-colors');

//投稿画面から画像パスを読み込むコード
function imagepassshort($arg)
{
    $content = str_replace('"images/', '"' . get_bloginfo('template_directory') . '/images/', $arg);
    return $content;
}
add_action('the_content', 'imagepassshort');

/****************************
一覧ページ
****************************/

//　記事抜粋文字数制限
add_filter('the_excerpt', 'my_the_excerpt');
function my_the_excerpt($postContent)
{
    $postContent = mb_strimwidth($postContent, 0, 70, "…", "UTF-8");
    return $postContent;
}

//レスポンシブなページネーションを作成する
function responsive_pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
        $paged = 1;

    //ページ情報の取得
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo '<ul class="pagination" role="menubar" aria-label="Pagination">';
        //先頭へ
        echo '<li class="first"><a href="' . get_pagenum_link(1) . '"><span><<</span></a></li>';
        //1つ戻る
        echo '<li class="previous"><a href="' . get_pagenum_link($paged - 1) . '"><span><</span></a></li>';
        //番号つきページ送りボタン
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? '<li class="current"><a>' . $i . '</a></li>' : '<li><a href="' . get_pagenum_link($i) . '" class="inactive" >' . $i . '</a></li>';
            }
        }
        //1つ進む
        echo '<li class="next"><a href="' . get_pagenum_link($paged + 1) . '"><span>></span></a></li>';
        //最後尾へ
        echo '<li class="last"><a href="' . get_pagenum_link($pages) . '"><span>>></span></a></li>';
        echo '</ul>';
    }
}

global $my_archives_post_type;

add_filter('getarchives_where', 'my_getarchives_where', 10, 2);
function my_getarchives_where($where, $r)
{
    global $my_archives_post_type;
    if (isset($r['post_type'])) {
        $my_archives_post_type = $r['post_type'];
        $where = str_replace('\'post\'', '\'' . $r['post_type'] . '\'', $where);
    } else {
        $my_archives_post_type = '';
    }
    return $where;
}

add_filter('get_archives_link', 'my_get_archives_link');
function my_get_archives_link($link_html)
{
    global $my_archives_post_type;
    $add_link = ''; // $add_linkを初期化します

    if ('' != $my_archives_post_type) {
        $add_link .= '?post_type=' . $my_archives_post_type;
    }

    $link_html = preg_replace("/href=\'(.+)\'\s/", "href='$1" . $add_link . " '", $link_html);
    return $link_html;
}


/****************************
画像
****************************/

//記事内の写真をサムネイル画像にする
function catch_that_image()
{
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    if (empty($first_img)) { //Defines a default image
        $first_img = "";
    }
    return $first_img;
}

//アイキャッチ画像設定ONに
add_theme_support('post-thumbnails', array('news'));

// 画像サイズ追加
function my_image_sizes($sizes)
{
    $my_sizes = array(
        'image1500' => __('大サイズ'),
    );
    return array_merge($sizes, $my_sizes);
}
add_filter('image_size_names_choose', 'my_image_sizes');
add_image_size('image1500', 1500, 0, false);

// サムネイルにクラスを付与する
add_filter('post_thumbnail_html', 'custom_attribute');
function custom_attribute($html)
{
    $myclass = 'responsive'; // クラス名
    return preg_replace('/class=".*\w+"/', 'class="' . $myclass . '"', $html);
    // width height を削除する
    $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
    return $html;
}

function my_image_size_names_choose($image_size_names)
{
    $image_size_names = array(
        'full' => __('Full Size'),
    );
    return $image_size_names;
}
add_filter('image_size_names_choose', 'my_image_size_names_choose');

/****************************
スラッグ/パーマリンク
****************************/

//投稿のアーカイブを表示
function post_has_archive($args, $post_type)
{

    if ('post' == $post_type) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'column'; //任意のスラッグ名
    }
    return $args;

}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

/* カスタム投稿タイプのパーマリンク categroryを削除する */
global $wp_rewrite;
$wp_rewrite->flush_rules();

add_theme_support('post-thumbnails', array('post', 'news'));//投稿ページ＆カスタム投稿「実績・事例」
//add_theme_support('post-thumbnails',array('page'));//固定ページ

/* お知らせのパーマリンクを数字ベース */
add_filter('post_type_link', 'my_post_type_link', 1, 2);
function my_post_type_link($link, $post)
{
    if ('works' === $post->post_type) {
        return home_url('/news/' . $post->ID);
    } else {
        return $link;
    }
}
add_filter('rewrite_rules_array', 'my_rewrite_rules_array');

function my_rewrite_rules_array($rules)
{
    $event_list = array(
        'works/([0-9]+)/?$' => 'index.php?post_type=news&p=$matches[1]',
    );
    return $event_list + $rules;
}

/****************************
contactform7
****************************/

//コンタクトフォーム7読み込み制限 
function wpcf7_file_load()
{
    add_filter('wpcf7_load_js', '__return_false');
    add_filter('wpcf7_load_css', '__return_false');
    if (is_page('opinion')) {
        if (function_exists('wpcf7_enqueue_scripts')) {
            wpcf7_enqueue_scripts();
        }
        if (function_exists('wpcf7_enqueue_styles')) {
            wpcf7_enqueue_styles();
        }
    }
}
add_action('template_redirect', 'wpcf7_file_load');


// お問い合わせページを除き、「reCAPTCHA」を読み込ませない
function load_recaptcha_js()
{
    if (!is_page(array('contact', 'entry'))) {
        wp_deregister_script('google-recaptcha');
    }
}
add_action('wp_enqueue_scripts', 'load_recaptcha_js', 100);

/****************************
カスタム投稿タイプ登録
****************************/
function create_post_type_news()
{
    register_post_type(
        'news',
        array(
            'labels' => array(
                'name' => __('お知らせ'),
                'singular_name' => __('お知らせ')
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
            'rewrite' => array('slug' => 'news'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        )
    );
}
add_action('init', 'create_post_type_news');
?>