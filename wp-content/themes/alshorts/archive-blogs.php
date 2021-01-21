<?php get_header(); ?>
<section class="prodect-wrep style-3">
    <div class="container">
        <div class="top-bar">        
            <div class="product-outer">
                <h2 class="product-title"><?= get_field('blog_heading','option'); ?></h2>
            </div>                  
        </div>
        <?php
        if (have_posts()) :
            ?>
            <div class="prodect-list">
                <div class="row justify-content-center" id="prodect-slider">
                    <?php
                    while (have_posts()) : the_post();
                        ?>
                        <div class="col-md-4">
                            <div class="prodect-item">
                                <div class="them-img">
                                    <a href="<?= get_post_permalink(get_the_ID(), false, false); ?>">
                                        <?= wp_get_attachment_image(get_field('blog_image', get_the_ID()), 'blogs-front-image', false, array('alt' => get_the_title())); ?>
                                    </a>
                                </div>
                                <div class="info">
                                    <a href="<?= get_post_permalink(get_the_ID(), false, false); ?>">
                                        <h3><?= mb_strimwidth(get_the_title(), 0, 40, '...'); ?></h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span><?= get_the_date($format = '', get_the_ID()); ?></span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn">
                                                    <a href="<?= get_post_permalink(get_the_ID(), false, false); ?>">
                                                        <img alt="<?= get_the_title(); ?>" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

            <!-- Pagination Goes Here -->
            <div class="row">
                <div class="small-12 columns">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => 'Previous',
                        'next_text' => 'Next',
                    ));
                    ?>
                </div>
            </div>
        <?php else : ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php
        endif;
        ?>
    </div>
</section>
<?php get_footer(); ?>
