<?php
/**
 * Template Name: FAQ Page
 *
 * @package WordPress
 * @subpackage Alshorts
 * @since Alshorts 1.0
 */
get_header();
?>

<!-- Advertisement Section  -->
<section class="advertisement">
    <div class="container">
        <div class="them-img"><img alt="" src="<?= get_template_directory_uri(); ?>/images/advertisement-2.jpg"></div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-9">
                <div class="faq-heading">
                    <h3 class="product-title">FAQs</h3>
                </div>
                <div id="faq-accordion" class="faq-accordion">
                    <?php
                    if (have_rows('faqs')):
                        $faq_counter = 1;
                        while (have_rows('faqs')): the_row();
                            ?>
                            <div class="faq-content-outer">
                                <div class="faq-header" id="account-<?= $faq_counter; ?>">
                                    <div class="mb-0 title" data-toggle="collapse" data-target="#account<?= $faq_counter; ?>" aria-expanded="<?php if ($faq_counter == 1) { ?> true <?php } else { ?> false <?php } ?>" aria-controls="account<?= $faq_counter; ?>">
                                        <img src="<?= get_template_directory_uri(); ?>/images/question-mark.svg" alt="question-mark"/><?= get_sub_field('heading'); ?></div>
                                </div>
                                <div id="account<?= $faq_counter; ?>" class="collapse <?php if ($faq_counter == 1) { ?> show <?php } ?>" aria-labelledby="account-<?= $faq_counter; ?>" data-parent="#faq-accordion">
                                    <div class="faq-body">
                                        <p><?= get_sub_field('description'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $faq_counter++;
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>

            <!-- Advertisement Section -->
            <div class="col-12 col-sm-3 text-right">
                <div class="them-img"><img alt="" src="<?= get_template_directory_uri(); ?>/images/advertisement-1.jpg"></div>
            </div>

        </div>
    </div>
</section>

<!-- Advertisement Section -->
<section class="advertisement news-add">
    <div class="container">
        <div class="them-img text-center"><img alt="" src="<?= get_template_directory_uri(); ?>/images/advertisement-3.jpg"></div>
    </div>
</section>
<?php get_footer(); ?>
