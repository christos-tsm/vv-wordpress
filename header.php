<?php
/*
 * @package Volos_Voyage
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<header class="site-header__container">
		<?php $header_logo = get_field('header_logo', 'option'); ?>
		<div class="site-header__content container container--medium">
			<a class="site-header__logo" href="<?= pll_home_url() ?>" aria-label="Homepage Link"><?= file_get_contents($header_logo['url']); ?></a>
			<div class="site-header__search">
				<form action="POST">
					<div class="form-row">
						<input class="input input--search" type="text" placeholder="<?= pll_e('Αναζητώ ηλεκτρολόγο...') ?>">
						<select class="input pointer" name="area" id="area">
							<option value="volos">Πόλη του βόλου</option>
							<option value="anatoliko-pilio">Ανατολικό Πήλιο</option>
							<option value="nea-anchialos">Νέα Αγχίαλος</option>
							<option value="almiros">Αλμυρός</option>
						</select>
						<button class="input btn pointer" type="submit"><?php pll_e('Αναζήτηση'); ?></button>
					</div>
				</form>
			</div>
			<div class="site-header__icons">
				<?php if (is_user_logged_in()) : ?>
					<a href="#!" class="site-header__icons-logout" id="logout" aria-label="Logout">
						<span class="icon icon--small">
							<?= file_get_contents(get_stylesheet_directory() . '/assets/images/logout.svg'); ?>
						</span>
					</a>
				<?php endif; ?>
				<?php $account_page = pll_get_post(48); ?>
				<a href="<?php the_permalink($account_page); ?>" class="site-header__icons-account <?= is_page_template('page-templates/account.php') ? 'site-header__icons-account--active' : ''; ?>" aria-label="Link to account page">
					<span class="icon icon--small">
						<?= file_get_contents(get_stylesheet_directory() . '/assets/images/user.svg'); ?>
					</span>
				</a>
			</div>
		</div>
		<?php if (have_rows('sub_menu', 'options')) : ?>
			<nav class="site-header__menu">
				<ul class="site-header__categories container container--medium">
					<?php while (have_rows('sub_menu', 'options')) : the_row(); ?>
						<?php $link = get_sub_field('link_' . pll_current_language()); ?>
						<li class="site-header__categories-item"><a href="<?= esc_url($link['url']) ?>"><?= esc_attr($link['title']) ?></a></li>
					<?php endwhile; ?>
				</ul>
			</nav>
		<?php endif; ?>
	</header><!-- #masthead -->