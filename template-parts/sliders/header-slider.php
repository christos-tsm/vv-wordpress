<?php if (have_rows('header_slider')) : ?>
    <section class="splide header-slider" aria-label="Header Slider">
        <div class="splide__track">
            <div class="splide__list">
                <?php while (have_rows('header_slider')) : the_row(); ?>
                    <?php $image = get_sub_field('image'); ?>
                    <div class="splide__slide header-slider__single">
                        <img src="<?= esc_url($image['url']) ?>" alt="<?php the_sub_field('title'); ?>">
                        <div class="header-slider__single-content">
                            <h2 class="header-slider__single-content-title"><?php the_sub_field('title'); ?></h2>
                            <div class="header-slider__single-content-text">
                                <?php the_sub_field('text'); ?>
                            </div>
                        </div>
                        <div class="overlay"></div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Add the progress bar element -->
        <div class="header-slider-progress">
            <div class="header-slider-progress-bar"></div>
        </div>
    </section>
<?php endif; ?>