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
    <section class="dashboard__container container container--medium">
        <?php get_template_part('template-parts/account/user-details'); ?>
        <div class="dashboard__content">
            <h1 class="section-title section-title--dashboard"><?php _e('Καταχώρηση επιχείρησης'); ?><span class="divider"></span></h1>
            <?php if (!get_transient('custom_hotel_form_success') && !get_transient('custom_hotel_form_error')) : ?>
                <div class="store-categories__container">
                    <h3 class="section-subtitle section-subtitle--dashboard"><?php _e('Βήμα 1ο') ?></h3>
                    <h2 class="subsection-title"><?php _e('Επιλέξτε κατηγορία επιχείρησης'); ?></h2>
                    <select name="shop-category" id="shop-category">
                        <option value="bars" <?= isset($_GET['store']) && $_GET['store'] === 'bars' ? 'selected' : '' ?>><?php _e('Μπαρ'); ?></option>
                        <option value="coffee-houses" <?= isset($_GET['store']) && $_GET['store'] === 'coffee-houses' ? 'selected' : '' ?>><?php _e('Καφετέρια'); ?></option>
                        <option value="hotels" <?= isset($_GET['store']) && $_GET['store'] === 'hotels' ? 'selected' : '' ?>><?php _e('Ξενοδοχείο'); ?></option>
                        <option value="night-clubs" <?= isset($_GET['store']) && $_GET['store'] === 'night-clubs' ? 'selected' : '' ?>><?php _e('Night Club'); ?></option>
                        <option value="restaurants" <?= isset($_GET['store']) && $_GET['store'] === 'restaurants' ? 'selected' : '' ?>><?php _e('Εστιατόριο'); ?></option>
                        <option value="freelancers" <?= isset($_GET['store']) && $_GET['store'] === 'freelancers' ? 'selected' : '' ?>><?php _e('Ελεύθερος επαγγελματίας'); ?></option>
                        <option value="travel-agents" <?= isset($_GET['store']) && $_GET['store'] === 'travel-agents' ? 'selected' : '' ?>><?php _e('Ταξιδιωτικό γραφείο'); ?></option>
                        <option value="shops" <?= isset($_GET['store']) && $_GET['store'] === 'shops' ? 'selected' : '' ?>><?php _e('Καταστήματα λιανικού εμπορίου'); ?></option>
                    </select>
                </div>
            <?php endif; ?>
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
            <div class="store-forms-container">
                <?php
                switch ($store):
                    case 'hotels':
                        get_template_part('template-parts/forms/add-hotels');
                        break;
                    case 'bars':
                        get_template_part('template-parts/forms/add-bars');
                        break;
                    case 'restaurants':
                        get_template_part('template-parts/forms/add-restaurants');
                        break;
                    case 'coffee-houses':
                        get_template_part('template-parts/forms/add-coffee-houses');
                        break;
                    case 'night-clubs':
                        get_template_part('template-parts/forms/add-night-clubs');
                        break;
                    case 'travel-agents':
                        get_template_part('template-parts/forms/add-travel-agents');
                        break;
                    case 'shops':
                        get_template_part('template-parts/forms/add-shops');
                        break;
                    case 'freelancers':
                        get_template_part('template-parts/forms/add-freelancers');
                        break;
                    default:
                        break;
                endswitch;
                ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>