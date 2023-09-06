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
	<style>
		/* Critical CSS for above-the-fold content */
		body {
			font-family: "Manrope", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
			color: #5a5a5a;
		}

		.archive-item__title-link {
			font-size: 20px;
		}

		a {
			color: #222;
			font-size: 14px;
			transition: color ease-in-out 250ms
		}
	</style>
</head>

<body <?php body_class(); ?> uuid="<?= get_current_user_id(); ?>">
	<?php wp_body_open(); ?>
	<header class="site-header">
		<div class="site-header__topbar">
			<div class="site-header__topbar-content container container--medium">
				<div class="site-header__contact">
					<?php $info_email = get_field('info_email', 'option'); ?>
					<?php $antispam_email = antispambot($info_email); ?>
					<a href="mailto:<?= $antispam_email ?>">
						<span class="icon icon--x-small"><?= file_get_contents(get_stylesheet_directory() . '/assets/images/email.svg'); ?></span>
						<?= esc_attr($info_email); ?>
					</a>
				</div>
				<div class="site-header__social-media">
					<?php $facebook_url = get_field('facebook_url', 'option'); ?>
					<?php $instagram_url = get_field('instagram_url', 'option'); ?>
					<?php $tiktok_url = get_field('tiktok_url', 'option'); ?>
					<a target="_blank" rel="noreferrer" aria-label="Social media link" href="<?= esc_url($facebook_url); ?>" class="icon icon--x-small">
						<?= file_get_contents(get_stylesheet_directory() . '/assets/images/facebook.svg'); ?>
					</a>
					<a target="_blank" rel="noreferrer" aria-label="Social media link" href="<?= esc_url($instagram_url); ?>" class="icon icon--x-small">
						<?= file_get_contents(get_stylesheet_directory() . '/assets/images/instagram.svg'); ?>
					</a>
					<a target="_blank" rel="noreferrer" aria-label="Social media link" href="<?= esc_url($tiktok_url); ?>" class="icon icon--x-small">
						<?= file_get_contents(get_stylesheet_directory() . '/assets/images/tiktok.svg'); ?>
					</a>
				</div>
			</div>
		</div>
		<?php $header_logo = get_field('header_logo', 'option'); ?>
		<div class="site-header__content container container--medium">
			<a class="site-header__logo" href="<?= home_url() ?>" aria-label="Homepage Link">
				<img src="<?= esc_url($header_logo['url']) ?>" alt="<?= bloginfo('name') . ' - Τα πάντα για τον Βόλο' ?>">
			</a>
			<div class="site-header__search">
				<?php get_template_part('template-parts/search/form'); ?>
			</div>
			<div class="site-header__icons">
				<?php get_template_part('template-parts/utils/languages'); ?>
				<?php if (is_user_logged_in()) : ?>
					<a href="<?php echo wp_logout_url(home_url()); ?>" class="site-header__icons-logout" id="logout" aria-label="Logout" title="<?php _e('Αποσύνδεση'); ?>">
						<span class="icon icon--small">
							<?= file_get_contents(get_stylesheet_directory() . '/assets/images/logout.svg'); ?>
						</span>
					</a>
				<?php endif; ?>
				<?php $account_page = get_post(48); ?>
				<a href="<?php the_permalink($account_page); ?>" class="site-header__icons-account <?= is_page_template('page-templates/account.php') ? 'site-header__icons-account--active' : ''; ?>" aria-label="Link to account page" title="<?php _e('Λογαριασμός'); ?>">
					<span class="icon icon--small">
						<?= file_get_contents(get_stylesheet_directory() . '/assets/images/user.svg'); ?>
					</span>
				</a>
			</div>
		</div>
		<?php get_template_part('template-parts/menus/header-menu'); ?>
	</header>