<?php
/**
 * Template Name: News Page
 *
 * @package WordPress
 * @subpackage Alshorts
 * @since Alshorts 1.0
 */
get_header();
?>

<?php if (!empty($_GET)) { ?>
    <!-- Advertisement Section -->
    <section class="advertisement">
        <div class="container">
            <div class="them-img"><img alt="" src="<?= get_template_directory_uri(); ?>/images/advertisement-2.jpg"></div>
        </div>
    </section>

    <!-- Single News Details Section -->
    <?php
    if (!empty($_GET) && !empty($_GET['categoryId']) && !empty($_GET['id'])) {
        $trendingnews_data_array = array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_BASEURL . 'v1/web/trendingnews',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ));
        $trendingnews_api_result = curl_exec($curl);
        curl_close($curl);

        $trendingnews_api_data_array = json_decode($trendingnews_api_result, true); //API data getting
        
        if (!empty($trendingnews_api_data_array['data']['results'])) {
            $trendingnews_data_array['results'] = $trendingnews_api_data_array['data']['results']; //data records
            $trendingnews_data_array['imagePath'] = $trendingnews_api_data_array['data']['result']['imagePath']; //image directory path
        }
        if (!empty($trendingnews_data_array['results'])) {
            foreach ($trendingnews_data_array['results'] as $trendingnews_data) {
                if (($trendingnews_data['_id'] == $_GET['id']) && ($trendingnews_data['categoryId'] == $_GET['categoryId'])) {
                    ?>
                    <section class="main-top-sec news-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-sm-9">
                                    <div class="main-sec-item">
                                        <div class="them-img">
                                            <img alt="<?= $trendingnews_data['heading']; ?>" src="<?= $trendingnews_data_array['imagePath'] . $trendingnews_data['hdImage']; ?>">
                                        </div>
                                        <div class="info">
                                            <h1><?= $trendingnews_data['heading']; ?></h1>
                                            <div class="date">
                                                <span><img alt="timestamp" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg"><?= date("M d, Y", ($trendingnews_data['timestamp'] / 1000)); ?></span>
                                                <span><img alt="author" src="<?= get_template_directory_uri(); ?>/images/user-icon.svg">AlShorts Web Desk</span>
                                            </div>
                                            <p><?= $trendingnews_data['newsBody']; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Advertisement Section -->
                                <div class="col-12 col-sm-3 text-right">
                                    <div class="them-img"><img alt="advertisement" src="<?= get_template_directory_uri(); ?>/images/advertisement-1.jpg"></div>
                                </div>

                            </div>
                        </div>
                    </section>
                    <?php
                }
            }
        }
    }
    ?>

    <!-- News Category List Section -->
    <?php if (!empty($_GET) && !empty($_GET['categoryId'])) { ?>
        <section class="more-news">
            <div class="container">
                <div class="top-bar">
                    <div class="row align-items-center">
                        <div class="col-8 col-md-6">
                            <h2 class="product-title">More News</h2>
                        </div>
                        <div class=" col-4 col-md-6">
                            <div class="btn-block text-right"><a href="<?= home_url("/sub-category/");?>" class="btn btn-primary">View all</a></div>
                        </div>
                    </div>
                </div>
                <div class="news-outer">
                    <div class="row align-items-center">
                        <div class="col-6 col-sm-4">
                            <div class="news-img"><img src="<?= get_template_directory_uri(); ?>/images/news-img1.png" alt=""/></div>
                        </div>
                        <div class="col-6 col-sm-8">
                            <div class="news-content">
                                <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur.</h3>
                                <div class="date"><span><img alt="" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg">Dec 23 , 2020</span></div>
                                <a href="#0" class="btn-link">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="news-outer">
                    <div class="row align-items-center">
                        <div class="col-6 col-sm-4">
                            <div class="news-img"><img src="<?= get_template_directory_uri(); ?>/images/news-img1.png" alt=""/></div>
                        </div>
                        <div class="col-6 col-sm-8">
                            <div class="news-content">
                                <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur.</h3>
                                <div class="date"><span><img alt="" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg">Dec 23 , 2020</span></div>
                                <a href="#0" class="btn-link">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="news-outer">
                    <div class="row align-items-center">
                        <div class="col-6 col-sm-4">
                            <div class="news-img"><img src="<?= get_template_directory_uri(); ?>/images/news-img1.png" alt=""/></div>
                        </div>
                        <div class="col-6 col-sm-8">
                            <div class="news-content">
                                <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur.</h3>
                                <div class="date"><span><img alt="" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg">Dec 23 , 2020</span></div>
                                <a href="#0" class="btn-link">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="news-outer">
                    <div class="row align-items-center">
                        <div class="col-6 col-sm-4">
                            <div class="news-img"><img src="<?= get_template_directory_uri(); ?>/images/news-img1.png" alt=""/></div>
                        </div>
                        <div class="col-6 col-sm-8">
                            <div class="news-content">
                                <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur.</h3>
                                <div class="date"><span><img alt="" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg">Dec 23 , 2020</span></div>
                                <a href="#0" class="btn-link">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="news-outer">
                    <div class="row align-items-center">
                        <div class="col-6 col-sm-4">
                            <div class="news-img"><img src="<?= get_template_directory_uri(); ?>/images/news-img1.png" alt=""/></div>
                        </div>
                        <div class="col-6 col-sm-8">
                            <div class="news-content">
                                <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur.</h3>
                                <div class="date"><span><img alt="" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg">Dec 23 , 2020</span></div>
                                <a href="#0" class="btn-link">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="news-outer">
                    <div class="row align-items-center">
                        <div class="col-6 col-sm-4">
                            <div class="news-img"><img src="<?= get_template_directory_uri(); ?>/images/news-img1.png" alt=""/></div>
                        </div>
                        <div class="col-6 col-sm-8">
                            <div class="news-content">
                                <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur.</h3>
                                <div class="date"><span><img alt="" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg">Dec 23 , 2020</span></div>
                                <a href="#0" class="btn-link">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="news-outer">
                    <div class="row align-items-center">
                        <div class="col-6 col-sm-4">
                            <div class="news-img"><img src="<?= get_template_directory_uri(); ?>/images/news-img1.png" alt=""/></div>
                        </div>
                        <div class="col-6 col-sm-8">
                            <div class="news-content">
                                <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur.</h3>
                                <div class="date"><span><img alt="" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg">Dec 23 , 2020</span></div>
                                <a href="#0" class="btn-link">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="news-outer">
                    <div class="row align-items-center">
                        <div class="col-6 col-sm-4">
                            <div class="news-img"><img src="<?= get_template_directory_uri(); ?>/images/news-img1.png" alt=""/></div>
                        </div>
                        <div class="col-6 col-sm-8">
                            <div class="news-content">
                                <h3 class="product-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur.</h3>
                                <div class="date"><span><img alt="" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg">Dec 23 , 2020</span></div>
                                <a href="#0" class="btn-link">Read More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <!-- Advertisement Section -->
    <section class="advertisement news-add">
        <div class="container">
            <div class="them-img"><img alt="" src="<?= get_template_directory_uri(); ?>/images/advertisement-2.jpg"></div>
        </div>
    </section>
    <?php
} else {
    echo "<script type='text/javascript'>window.location.href='" . home_url('/') . "'</script>";
    exit();
}
?>
<?php get_footer(); ?>