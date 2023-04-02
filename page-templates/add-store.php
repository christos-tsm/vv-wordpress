<?php
require get_stylesheet_directory() . '/inc/protect-direct-access.php';
/**
 * Template Name: Add Store
 */
get_header();
$current_user = wp_get_current_user();
if (isset($_GET['store']) && !empty($_GET['store'])) {
    $store = $_GET['store'];
} else {
    $store = null;
}
?>
<main class="site-main site-main--account">
    <div class="dashboard__container container container--medium">
        <?php get_template_part('template-parts/account/account-menu'); ?>
        <section class="dashboard__content">
            <h1 class="section-title section-title--dashboard"><?php pll_e('Καταχώρηση επιχείρησης'); ?><span class="divider"></span></h1>
            <?php
            if (get_transient('custom_hotel_form_success')) {
                echo '<div class="message message--success">' . get_transient('custom_hotel_form_success') . '</div>';
                delete_transient('custom_hotel_form_success');
            }
            if (get_transient('custom_hotel_form_error')) {
                echo '<div class="message message--error">' . get_transient('custom_hotel_form_error') . '</div>';
                delete_transient('custom_hotel_form_error');
            }
            ?>
            <div class="store-categories__container">
                <h3 class="section-subtitle section-subtitle--dashboard"><?php pll_e('Βήμα 1ο') ?></h3>
                <h2 class="subsection-title"><?php pll_e('Επιλέξτε κατηγορία επιχείρησης'); ?></h2>
                <select name="shop-category" id="shop-category">
                    <option value="bars" <?= isset($_GET['store']) && $_GET['store'] === 'bars' ? 'selected' : '' ?>><?php pll_e('Μπαρ'); ?></option>
                    <option value="coffee-houses" <?= isset($_GET['store']) && $_GET['store'] === 'coffee-houses' ? 'selected' : '' ?>><?php pll_e('Καφετέρια'); ?></option>
                    <option value="hotels" <?= isset($_GET['store']) && $_GET['store'] === 'hotels' ? 'selected' : '' ?>><?php pll_e('Ξενοδοχείο'); ?></option>
                    <option value="night-clubs" <?= isset($_GET['store']) && $_GET['store'] === 'night-clubs' ? 'selected' : '' ?>><?php pll_e('Night Club'); ?></option>
                    <option value="restaurants" <?= isset($_GET['store']) && $_GET['store'] === 'restaurants' ? 'selected' : '' ?>><?php pll_e('Εστιατόριο'); ?></option>
                    <option value="travel-agents" <?= isset($_GET['store']) && $_GET['store'] === 'travel-agents' ? 'selected' : '' ?>><?php pll_e('Ταξιδιωτικό γραφείο'); ?></option>
                </select>
            </div>
            <div class="store-forms-container">
                <?php
                switch ($store):
                    case 'hotels':
                        get_template_part('template-parts/forms/add-hotel');
                        break;
                    case 'bars':
                        get_template_part('template-parts/forms/add-bar');
                        break;
                    default:
                        break;
                endswitch;
                ?>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>