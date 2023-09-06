<?php
// $languages = pll_the_languages(array('raw' => 1));
// $clang = pll_current_language('name');
?>
<?php /* foreach ($languages as $language) :
    if ($language['name'] == $clang) : ?>
        <span class="site-header__language site-header__language--current"><?= $language['name']; ?></span>
    <?php else : ?>
        <a class="site-header__language" href="<?= $language['url']; ?>"><?= $language['name']; ?></a>
<?php endif;
endforeach; */ ?>
<span class="site-header__language site-header__language--current"><?= _e('ΕΛ', 'volos-voyage'); ?></span>
<a class="site-header__language" href="<?= $language['url']; ?>"><?= _e('EN', 'volos-voyage'); ?></a>