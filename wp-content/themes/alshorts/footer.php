<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-3 footer-social">
                <a class="logo" href="<?= home_url("/"); ?>">
                    <img alt="" src="<?= get_template_directory_uri(); ?>/images/logo-2.svg" alt="alshorts">
                </a>
                <!-- Copyright section -->
                <p><?= !empty(get_field('footer_copyright_text', 'option')) ? get_field('footer_copyright_text', 'option') : "&copy; AlShorts 2020. All Rights Reserved."; ?></p>
                <!-- social Medai Section -->
                <?php if (have_rows('social_media', 'option')): ?>
                    <ul class="social-outer">
                        <?php
                        while (have_rows('social_media', 'option')): the_row();
                            ?>
                            <li>
                                <a href="<?= get_sub_field('link_url'); ?>" target="_blank">
                                    <?= wp_get_attachment_image(get_sub_field('icon'), 'full', false, array('class' => 'img-fluid', 'alt' => get_sub_field('name'))); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="col-md-8 col-lg-6 footer-menu">
                <!-- App Menu Section -->
                <?php if (have_rows('app_menus', 'option')): ?>
                    <ul>
                        <h6><?= get_field('app_menu_heading', 'option'); ?></h6>
                        <?php
                        while (have_rows('app_menus', 'option')): the_row();
                            ?>
                            <li><a href="<?= home_url(get_sub_field("link_url")); ?>"><?= get_sub_field("heading"); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>

                <!-- Company Menu Section -->
                <?php if (have_rows('company_menus', 'option')): ?>
                    <ul>
                        <h6><?= get_field('company_menu_heading', 'option'); ?></h6>
                        <?php
                        while (have_rows('company_menus', 'option')): the_row();
                            ?>
                            <li><a href="<?= home_url(get_sub_field("link_url")); ?>"><?= get_sub_field("heading"); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>

                <!-- Need Help Menu Section -->
                <ul>
                    <h6>NEED HELP</h6>
                    <li><a href="<?= home_url("/contact/"); ?>">Contact</a></li>
                    <li><a href="<?= home_url("/faqs/"); ?>">FAQ's</a></li>
                </ul>

            </div>
            <div class="col-md-6 col-lg-3 download-app text-right">
                <h6>AVAILABLE ON</h6>
                <a href="#0" target="_blank"><img alt="" src="<?= get_template_directory_uri(); ?>/images/apple.svg" alt="playstrore icon"></a>
                <a href="#0" target="_blank"><img alt="" src="<?= get_template_directory_uri(); ?>/images/app-store.svg" alt="appstoreicon"></a>
            </div>
        </div>
    </div>
</footer>
<body>
    <?php wp_footer(); ?>
</body>
</html>
