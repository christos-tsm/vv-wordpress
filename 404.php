<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Volos_Voyage
 */
get_header();
?>

<main class="site-main site-main--404">
	<section class="error-404 not-found">
		<span class="texture">404</span>
		<h1 class="page-title"><?php _e('Η σελίδα δεν βρέθηκε.', 'volos-voyage'); ?></h1>
		<a class="cta cta--primary" href="<?= home_url(); ?>">
			<span>
				<?php _e('Επιστροφή στην αρχική') ?>
			</span>
		</a>
	</section>
</main>

<?php
get_footer();
