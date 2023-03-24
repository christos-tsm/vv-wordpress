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

<body <?php body_class(); ?> uuid="<?= get_current_user_id(); ?>">
	<?php wp_body_open(); ?>
	<header class="site-header__container">
		<?php $header_logo = get_field('header_logo', 'option'); ?>
		<div class="site-header__content container container--medium">
			<a class="site-header__logo" href="<?= pll_home_url() ?>" aria-label="Homepage Link"><?= file_get_contents($header_logo['url']); ?></a>
			<div class="site-header__search">
				<form method="POST" action="<?php echo esc_url(pll_home_url() . 'profiles/'); ?>">
					<div class="form-row">
						<?php
						$terms = get_terms(array(
							'taxonomy' => 'profile-categories',
							'pad_counts' => true,
						));
						$non_empty_terms = array();
						foreach ($terms as $term) :
							if ($term->count > 0) {
								$non_empty_terms[] = $term;
							}
						endforeach;
						$args = array(
							'post_type' => 'municipalities',
							'posts_per_page' => -1
						);
						$municipalities = new WP_Query($args);
						?>
						<select class="input pointer" name="profile_category" id="profile_category">
							<?php foreach ($non_empty_terms as $term) : ?>
								<?php if (isset($_POST['profile_category'])  && !empty($_POST['profile_category']) && intval($_POST['profile_category']) === $term->term_id) : ?>
									<option selected value="<?= esc_attr($term->term_id) ?>"><?= esc_attr($term->name); ?></option>
								<?php else : ?>
									<option value="<?= esc_attr($term->term_id) ?>"><?= esc_attr($term->name); ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
						<select class="input pointer" name="municipality" id="municipality">
							<?php if ($municipalities->have_posts()) : ?>
								<?php while ($municipalities->have_posts()) : $municipalities->the_post(); ?>
									<?php if (isset($_POST['municipality'])  && !empty($_POST['municipality']) && intval($_POST['municipality']) === get_the_ID()) : ?>
										<option selected value="<?= get_the_ID() ?>"><?php the_title(); ?></option>
									<?php else : ?>
										<option value="<?= get_the_ID() ?>"><?php the_title(); ?></option>
									<?php endif; ?>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							<?php endif; ?>
						</select>
						<button class="input btn pointer" type="submit"><?php pll_e('Αναζήτηση'); ?></button>
					</div>
				</form>
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
	</header><!-- #masthead -->