<?php get_header(); ?>

<!-- advertisement section -->
<section class="advertisement">
    <div class="container">
        <div class="them-img"><img alt="advertisement" src="<?= get_template_directory_uri(); ?>/images/advertisement-2.jpg"></div>
    </div>
</section>

<?php
while (have_posts()) :
    the_post();
    ?>
    <section class="main-top-sec news-top">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-9">
                    <div class="main-sec-item">
                        <div class="them-img">
                            <!--<img alt="" src="<?= get_template_directory_uri(); ?>/images/news-top-img.png">-->
                            <?= wp_get_attachment_image(get_field('blog_image', get_the_ID()), 'blogs-detail-image', false, array('alt' => get_the_title())); ?>
                        </div>
                        <div class="info">
                            <h1><?= get_the_title(); ?></h1>
                            <div class="date">
                                <span>
                                    <img alt="<?= get_the_title(); ?>" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg"><?= get_the_date($format = '', get_the_ID()); ?>
                                </span>
                                <span>
                                    <img alt="<?= get_the_title(); ?>" src="<?= get_template_directory_uri(); ?>/images/user-icon.svg"><?= ucwords(strtolower(get_field('blog_created_by', get_the_ID()))); ?>
                                </span>
                            </div>

                            <?= get_the_content(); ?>

                        </div>
                    </div>
                </div>
                
                <!-- advertisement section -->
                <div class="col-12 col-sm-3 text-right">
                    <div class="them-img">
                        <img alt="advertisement" src="<?= get_template_directory_uri(); ?>/images/advertisement-1.jpg">
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <?php
endwhile;
?>

<!--/*================================ More Blogs Section =====================*/-->
<?php
//Dispaly CPT Blogs
$blogs_args = array(
    'post_type' => 'blogs',
    'posts_per_page' => -1,
    'post__not_in' => array(get_the_ID()),
    'post_status' => 'publish',
    'orderby' => 'ID',
    'order' => 'DESC',
    'cache_results' => false,
    'update_post_term_cache' => false,
);
$blogsQuery = new WP_Query($blogs_args);
if (!empty($blogsQuery->posts)) {
    if ($blogsQuery->have_posts()) :
        ?>
        <section class="more-news">
            <div class="container">
                <div class="top-bar">
                    <div class="row align-items-center">
                        <div class="col-8 col-md-6">
                            <h2 class="product-title">More Blog</h2>
                        </div>
                        <div class=" col-4 col-md-6">
                            <div class="btn-block text-right"><a href="<?= home_url("/blogs/");?>" class="btn btn-primary">View all</a></div>
                        </div>
                    </div>
                </div>
                <?php
                while ($blogsQuery->have_posts()) :
                    $blogsQuery->the_post();
                    ?>
                    <div class="news-outer">
                        <div class="row align-items-center">
                            <div class="col-6 col-sm-4">
                                <div class="news-img">
                                    <!--<img src="<?= get_template_directory_uri(); ?>/images/news-img1.png" alt=""/>-->
                                    <?= wp_get_attachment_image(get_field('blog_image', get_the_ID()), 'blogs-detail-more-list-image', false, array('alt' => get_the_title())); ?>
                                </div>
                            </div>
                            <div class="col-6 col-sm-8">
                                <div class="news-content">
                                    <h3 class="product-title"><?= get_the_title(); ?></h3>
                                    <div class="date">
                                        <span>
                                            <img alt="<?= get_the_title(); ?>" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg"><?= get_the_date($format = '', get_the_ID()); ?>
                                        </span>
                                    </div>
                                    <a href="<?= get_post_permalink(get_the_ID(), false, false); ?>" class="btn-link">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </section>
        <?php
    endif;
}
?>
<!-- advertisement section -->
<section class="advertisement news-add">
    <div class="container">
        <div class="them-img"><img alt="advertisement" src="<?= get_template_directory_uri(); ?>/images/advertisement-2.jpg"></div>
    </div>
</section>

<?php get_footer(); ?>
