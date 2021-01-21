<?php
/**
 * Template Name: About Us Page
 *
 * @package WordPress
 * @subpackage Alshorts
 * @since Alshorts 1.0
 */
get_header();
?>
<!-- Main Top Sec -->
<section class="about-main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="faq-heading">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="about-content">
                    <p><?= get_field('about_us_description_first'); ?></p>
                </div>
            </div>

            <!--/*==================== Vision and Mission Section Start ==========*/-->
            <?php
            if (have_rows('about_us_vision_and_mission')):
                ?>
                <div class="vision-outer d-flex flex-wrap">
                    <div class="col-12">
                        <div class="vision-heading">
                            <h2 class="title position-relative"><?= get_field('about_us_vision_mission_heading'); ?></h2>
                        </div>
                    </div>
                    <?php
                    while (have_rows('about_us_vision_and_mission')) : the_row();
                        ?>
                        <div class="col-12 col-md-6">
                            <div class="vision-left missions">
                                <div class="img-outer">
        <!--                                    <img src="<?= get_template_directory_uri(); ?>/images/vision-img1.png" alt=""/>-->
                                    <?= wp_get_attachment_image(get_sub_field('image'), 'full', false, array('alt' => get_sub_field('title'))); ?>
                                </div>
                                <div class="vision-content">
                                    <h5><?= get_sub_field('title'); ?></h5>
                                    <p><?= get_sub_field('description'); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    ?>
                </div>
            <?php endif; ?>
            <!--/*==================== Vision and Mission Section End ==========*/-->

            <div class="col-12">
                <div class="about-content">
                    <p><?= get_field('about_us_description_second'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>

