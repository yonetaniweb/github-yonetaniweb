<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	<link
		href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Roboto:wght@400;700&display=swap"
		rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="site-header">
		<div class="contents fl-between fl-align-center">
			<p class="site-header__logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="NIPPATech ロゴ"></a>
			</p>
			<nav class="main-nav">
				<ul class="fl-align-center">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a></li>
					<li><a href="#">製品事例</a></li>
					<li><a href="#">製品ができるまで</a></li>
					<li><a href="#">ニッパテックを知る</a></li>
					<li><a href="#">会社案内</a></li>
					<li><a href="#">採用情報</a></li>
					<li><a href="#">お問い合わせ</a></li>
				</ul>
			</nav>
			<button class="menu-toggle"><span></span><span></span><span></span></button>
		</div>
	</header>
