<?php
/**
 * Template Name: Editorial Policy Page
 *
 * @package WordPress
 * @subpackage Alshorts
 * @since Alshorts 1.0
 */
get_header();
?>
<section class="about-main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="faq-heading">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="about-content">
                    <?= get_the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>

