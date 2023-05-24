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
			color: #363535;
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
	<header class="site-header__container">
		<?php $header_logo = get_field('header_logo', 'option'); ?>
		<div class="site-header__content container container--medium">
			<a class="site-header__logo" href="<?= pll_home_url() ?>" aria-label="Homepage Link">
				<img src="<?= esc_url($header_logo['url']) ?>" alt="<?= bloginfo('name') . ' - Τα πάντα για τον Βόλο' ?>">
			</a>
			<div class="site-header__search">
				<?php get_template_part('template-parts/search/form'); ?>
			</div>
			<div class="site-header__icons">
				<?php get_template_part('template-parts/utils/languages'); ?>
				<?php if (is_user_logged_in()) : ?>
					<a href="<?php echo wp_logout_url(home_url()); ?>" class="site-header__icons-logout" id="logout" aria-label="Logout">
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
		<?php get_template_part('template-parts/menus/header-menu'); ?>
	</header>