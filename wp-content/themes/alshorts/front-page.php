<?php
get_header();
?>
<!--/*=========================== Marquee Breaking News Section Start ==================*/-->
<?php
$breakingnews_data_array = array();
$breakingnews_api_url = API_BASEURL . "v1/web/breakingnews";
//  Initiate curl
$ch = curl_init();
//Use Post Method
curl_setopt($ch, CURLOPT_POST, 1);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL, $breakingnews_api_url);
// Execute
$breakingnews_api_result = curl_exec($ch);
// Closing
curl_close($ch);

$breakingnews_api_data_array = json_decode($breakingnews_api_result, true);

if (!empty($breakingnews_api_data_array['data']['results'])) {
    $breakingnews_datas = $breakingnews_api_data_array['data']['results'];

    //Impload the Array Heading into String
    foreach ($breakingnews_datas as $breakingnews_data) {
        if (!empty($breakingnews_data['heading'])) {
            $breakingnews_data_array[] = $breakingnews_data['heading'];
        }
    }
}

if (!empty($breakingnews_data_array)) {
    ?>
    <section class="breaking-news">
        <div class="container">
            <div class="breaking-news-inner">
                <div class="row">
                    <div class="col-12">
                        <p class="m-0">Breaking News :</p>
                        <p class="m-0">
                        <marquee behavior="scroll" direction="left">
                            <?= implode(" | ", $breakingnews_data_array); ?>
                        </marquee>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!--/*=========================== Marquee Breaking News Section End ==================*/-->

<!--/*=========================== Trending News Section Start ========================*/-->
<?php
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

$trendingnews_api_data_array = json_decode($trendingnews_api_result, true);
if (!empty($trendingnews_api_data_array['data']['results'])) {
    $trendingnews_data_array['results'] = $trendingnews_api_data_array['data']['results']; //data records
    $trendingnews_data_array['imagePath'] = $trendingnews_api_data_array['data']['result']['imagePath']; //image directory path
}

if (!empty($trendingnews_data_array['results'])) {
    //echo "<pre>".print_r($trendingnews_data_array['results'],TRUE)."</pre>";
    //die;
    ?>
    <section class="main-top-sec">
        <div class="container">
            <div class="row">

                <!-- Trending News Slider Section -->
                <?php
                $trending_news_counter = 1;
                foreach ($trendingnews_data_array['results'] as $trendingnews_data) {
                    if ($trending_news_counter == 1) {
                        ?>
                        <div class="col-md-12 col-lg-6">
                            <div class="main-sec-item">
                                <div class="them-img">
            <!--                                    <img alt="<?= $trendingnews_data['heading']; ?>" src="<?= get_template_directory_uri(); ?>/images/blog-img.jpg">-->
                                    <img alt="<?= $trendingnews_data['heading']; ?>" src="<?= $trendingnews_data_array['imagePath'] . $trendingnews_data['hdImage']; ?>">
                                </div>
                                <div class="info">
                                    <h1><?= $trendingnews_data['heading']; ?></h1>
                                    <div class="date">
                                        <span>
                                            <img alt="timestamp" src="<?= get_template_directory_uri(); ?>/images/icon-3.svg"><?= date("M d, Y", ($trendingnews_data['timestamp'] / 1000)); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    $trending_news_counter++;
                }
                ?>

                <!-- Trending News Right Listing Section -->
                <div class="col-md-8 col-lg-4">
                    <div class="info-wrepr">
                        <?php foreach ($trendingnews_data_array['results'] as $trendingnews_data) { ?>
                            <div class="maininfo-item">
                                <div class="info">
                                    <p><?= $trendingnews_data['heading']; ?></p>
                                </div>
                                <div class="btn-block">
                                    <!--<a href="<?= home_url("/news/?categoryId=" . $trendingnews_data['categoryId'] . "&id=" . $trendingnews_data['_id']); ?>" class="btn-link">Read More</a>-->
                                    <a href="<?= home_url("/news/?categoryId=" . $trendingnews_data['categoryId'] . "&id=" . $trendingnews_data['_id'] . "&slug=" . $trendingnews_data['slug']); ?>" class="btn-link">Read More</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- advertisement Section -->
                <div class="col-md-4 col-lg-2">
                    <div class="them-img"><img alt="advertisement" src="<?= get_template_directory_uri(); ?>/images/advertisement-1.jpg"></div>
                </div>

            </div>
        </div>
    </section>
<?php } ?>
<!--/*=========================== Trending News Section End ========================*/-->

<section class="advertisement">
    <div class="container">
        <div class="them-img"><img alt="" src="<?= get_template_directory_uri(); ?>/images/advertisement-2.jpg"></div>
    </div>
</section>
<section class="prodect-wrep">
    <div class="container">
        <div class="top-bar">
            <div class="row align-items-center">
                <div class="col-6 col-md-3 col-lg-2 product-outer">
                    <h2 class="product-title">Category 1</h2>
                </div>
                <div class="col-12 col-md-7 col-lg-8 product-tabs">
                    <ul class="prodect-menu nav nav-tabs">
                        <li><a href="#home" class="active" data-toggle="tab" role="tab" aria-controls="home" aria-selected=" true" id="home-tab">Sub Category 1</a></li>
                        <li><a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sub Category 2</a></li>
                        <li><a id="profile-tab2" data-toggle="tab" href="#menu2" role="tab" aria-controls="menu2" aria-selected="false">Sub Category 3</a></li>
                        <li><a id="profile-tab3" href="#menu3" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">Sub Category 4</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 col-lg-2 product-view">
                    <div class="btn-block text-right"><a href="#0" class="btn btn-primary">View all</a></div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="menu3" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-md-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-md-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="prodect-wrep">
    <div class="container">
        <div class="top-bar">
            <div class="row align-items-center">
                <div class="col-6 col-md-3 col-lg-2 product-outer">
                    <h3 class="product-title">Category 2</h3>
                </div>
                <div class="col-12 col-md-7 col-lg-8 product-tabs">
                    <ul class="prodect-menu nav nav-tabs">
                        <li><a href="#home02" class="active" data-toggle="tab" role="tab" aria-controls="home" aria-selected=" true" id="home-tab">Sub Category 1</a></li>
                        <li><a id="profile-tab" data-toggle="tab" href="#profile02" role="tab" aria-controls="profile" aria-selected="false">Sub Category 2</a></li>
                        <li><a id="profile-tab2" data-toggle="tab" href="#menu02" role="tab" aria-controls="menu2" aria-selected="false">Sub Category 3</a></li>
                        <li><a id="profile-tab3" href="#menu05" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">Sub Category 4</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 col-lg-2 product-view">
                    <div class="btn-block text-right"><a href="#0" class="btn btn-primary">View all</a></div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="home02" role="tabpanel" aria-labelledby="home-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="profile02" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="menu02" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="menu05" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--/* ============== Video Section Start ==================*/ -->
<?php
//Dispaly CPT Videos
$video_category_data_array = array();
$video_cats = get_categories();
if (!empty($video_cats)) {
    foreach ($video_cats as $cat) {
        $videos_args = array(
            'post_type' => 'videos',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'orderby' => 'ID',
            'order' => 'DESC',
            'cache_results' => false,
            'update_post_term_cache' => false,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $cat->cat_ID,
                ),
            ),
        );
        $video_category_data_array[$cat->cat_ID] = $videos_args;
    }
}

if (!empty($video_category_data_array)) {
    ?>
    <section class="prodect-wrep">
        <div class="container">
            <div class="top-bar">
                <div class="row align-items-center">
                    <div class="col-6 col-md-3 col-lg-2 product-outer">
                        <h3 class="product-title"><?= get_field('video_heading', 'option'); ?></h3>
                    </div>
                    <div class="col-12 col-md-7 col-lg-8 product-tabs">
                        <ul class="prodect-menu nav nav-tabs">
                            <?php
                            $category_count = 1;
                            foreach ($video_category_data_array as $category_id => $videos_arg) {
                                ?>
                                <li><a href="#home<?= $category_id; ?>" <?php if ($category_count == 1) { ?> class="active" <?php } ?> id="home-<?= $category_id; ?>" data-toggle="tab" role="tab" aria-controls="home<?= $category_id; ?>" aria-selected="<?= (($category_count == 1) ? true : false); ?>" data-toggle="tab"><?= get_cat_name($category_id); ?></a></li>
                                <?php
                                $category_count++;
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-6 col-md-2 col-lg-2 product-view">
                        <div class="btn-block text-right"><a href="#0" class="btn btn-primary">View all</a></div>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <?php
                $category_count = 1;
                foreach ($video_category_data_array as $category_id => $videos_arg) {
                    ?>                            
                    <div class="tab-pane fade <?php if ($category_count == 1) { ?> show active <?php } ?>" id="home<?= $category_id; ?>" role="tabpanel" aria-labelledby="home-<?= $category_id; ?>">
                        <!-- Video Sec -->
                        <?php
                        $videosQuery = new WP_Query($videos_arg);
                        if (!empty($videosQuery->posts)) {
                            if ($videosQuery->have_posts()) :
                                ?>
                                <div class="video-sec">
                                    <div class="row">
                                        <?php
                                        $youtube_player_counter = 1;
                                        while ($videosQuery->have_posts()) :
                                            $videosQuery->the_post();
                                            if ($youtube_player_counter == 1) {
                                                ?>
                                                <div class="col-md-7">
                                                    <div class="video-wrep">
                                                        <div class="info">
                                                            <div class="them-img">
                                                                <input type="hidden" class="youtube_video_url_hidden" data-category-id="<?= $category_id; ?>" value="<?= get_field('video_source_url', get_the_ID()); ?>">
                                                                <iframe class="youtube_video_url_hidden_iframe_<?= $category_id; ?>" width="720" height="500" src="<?= get_field('video_source_url', get_the_ID()); ?>" frameborder="0" allowtransparency="true"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            $youtube_player_counter++;
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>

                                        <div class="col-md-5">
                                            <div class="video-info-wrep">
                                                <?php
                                                while ($videosQuery->have_posts()) :
                                                    $videosQuery->the_post();
                                                    ?>
                                                    <div class="video-info item">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-4">
                                                                <div class="video-wrep style-2">
                                                                    <div class="info">
                                                                        <div class="them-img">
                                                                            <!--<img alt="" src="<?= get_template_directory_uri(); ?>/images/video-img-2.jpg">-->
                                                                            <!--https://i.ytimg.com/vi/IZ9XuWHrYTM/mq1.jpg-->
                                                                            <?php
                                                                            //parse_str(parse_url(get_field('video_source_url', get_the_ID()), PHP_URL_QUERY), $youtube_url_vars);
                                                                            preg_match('/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', get_field('video_source_url', get_the_ID()), $youtube_url_vars);
                                                                            //echo "<pre>".print_r($youtube_url_vars,TRUE)."</pre>";
                                                                            ?>
                                                                            <img alt="<?= get_the_title(); ?>" src="https://i.ytimg.com/vi/<?= $youtube_url_vars[6]; ?>/mq1.jpg"/>
                                                                        </div>
                                                                        <div class="play-btn-wrep">
                                                                            <div class="display-table">
                                                                                <div class="table-call">
                                                                                    <div class="play-btn">
                                                                                        <a href="javascript:void(0);">
                                                                                            <img alt="<?= get_the_title(); ?>" src="<?= get_template_directory_uri(); ?>/images/play-icon.svg">
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="info">
                                                                    <h3><?= get_the_title(); ?></h3>
                                                                    <p>Source : <?= get_field('video_source_name', get_the_ID()); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="link-btn list_youtube_data" data-category-id="<?= $category_id; ?>"><a href="javascript:void(0);" data-youtube-url="<?= get_field('video_source_url', get_the_ID()); ?>"></a></div>
                                                    </div>
                                                    <?php
                                                endwhile;
                                                wp_reset_postdata();
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endif;
                        }
                        ?>
                    </div>
                    <?php
                    $category_count++;
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}
?>
<!--/* ============== Video Section End ==================*/ -->

<section class="advertisement">
    <div class="container">
        <div class="them-img"><img alt="" src="<?= get_template_directory_uri(); ?>/images/advertisement-2.jpg"></div>
    </div>
</section>
<section class="prodect-wrep">
    <div class="container">
        <div class="top-bar">
            <div class="row align-items-center">
                <div class="col-6 col-md-3 col-lg-2 product-outer">
                    <h3 class="product-title">Category 3</h3>
                </div>
                <div class="col-12 col-md-7 col-lg-8 product-tabs">
                    <ul class="prodect-menu nav nav-tabs">
                        <li><a href="#home03" class="active" data-toggle="tab" role="tab" aria-controls="home" aria-selected=" true"data-toggle="tab" id="home-tab">Sub Category 1</a></li>
                        <li><a href="#profile03" id="profile-tab" data-toggle="tab"  role="tab" aria-controls="profile" aria-selected="false">Sub Category 2</a></li>
                        <li><a href="#menu03" id="profile-tab2" data-toggle="tab"  data-toggle="tab" role="tab" aria-controls="menu2" aria-selected="false">Sub Category 3</a></li>
                        <li><a href="#menu06" id="profile-tab3"  data-toggle="tab" href="#menu2" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sub Category 4</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 col-lg-2 product-view">
                    <div class="btn-block text-right"><a href="#0" class="btn btn-primary">View all</a></div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="home03" role="tabpanel" aria-labelledby="home-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="profile03" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="menu03" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="menu06" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="prodect-wrep">
    <div class="container">
        <div class="top-bar">
            <div class="row align-items-center">
                <div class="col-6 col-md-3 col-lg-2 product-outer">
                    <h3 class="product-title">Category 4</h3>
                </div>
                <div class="col-12 col-md-7 col-lg-8 product-tabs">
                    <ul class="prodect-menu nav nav-tabs">
                        <li><a href="#home04" class="active" data-toggle="tab" role="tab" aria-controls="home" aria-selected=" true"data-toggle="tab" id="home-tab">Sub Category 1</a></li>
                        <li><a href="#profile04" id="profile-tab" data-toggle="tab"  role="tab" aria-controls="profile" aria-selected="false">Sub Category 2</a></li>
                        <li><a href="#menu04" id="profile-tab2" data-toggle="tab"  data-toggle="tab" role="tab" aria-controls="menu2" aria-selected="false">Sub Category 3</a></li>
                        <li><a href="#menu07" id="profile-tab3"  data-toggle="tab" href="#menu2" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sub Category 4</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 col-lg-2 product-view">
                    <div class="btn-block text-right"><a href="#0" class="btn btn-primary">View all</a></div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="home04" role="tabpanel" aria-labelledby="home-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="profile04" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="menu04" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="menu07" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="prodect-wrep">
    <div class="container">
        <div class="top-bar">
            <div class="row align-items-center">
                <div class="col-6 col-md-3 col-lg-2 product-outer">
                    <h3 class="product-title">Category 5</h3>
                </div>
                <div class="col-12 col-md-7 col-lg-8 product-tabs">
                    <ul class="prodect-menu nav nav-tabs">
                        <li><a href="#home05" class="active" data-toggle="tab" role="tab" aria-controls="home" aria-selected=" true" id="home-tab">Sub Category 1</a></li>
                        <li><a href="#profile05" id="profile-tab" data-toggle="tab"  role="tab" aria-controls="profile" aria-selected="false">Sub Category 2</a></li>
                        <li><a href="#menu06" id="profile-tab2" data-toggle="tab" role="tab" aria-controls="menu2" aria-selected="false">Sub Category 3</a></li>
                        <li><a href="#menu08" id="profile-tab3"  data-toggle="tab" href="#menu2" role="tab" aria-controls="profile" aria-selected="false">Sub Category 4</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 col-lg-2 product-view">
                    <div class="btn-block text-right"><a href="#0" class="btn btn-primary">View all</a></div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="home05" role="tabpanel" aria-labelledby="home-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="profile05" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="menu06" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="tab-pane fade" id="menu08" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prodect-list">
                    <div class="prodect-slider your-class" id="prodect-slider">
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-2.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-6.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slid-item">
                            <div class="prodect-item">
                                <div class="them-img"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/blog-img-5.jpg"></a></div>
                                <div class="info"><a href="#0">
                                        <h3>How Long Does COVID-19 Live on Different Surfaces?</h3>
                                    </a>
                                    <div class="date">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 col-lg-6"><span>May 28 2020</span></div>
                                            <div class="col-md-5 col-lg-6 text-right">
                                                <div class="arrow-btn"><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/arrow-2.svg"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="advertisement style-2">
    <div class="container">
        <div class="them-img"><img alt="" src="<?= get_template_directory_uri(); ?>/images/advertisement-2.jpg"></div>
    </div>
</section>
<!--/* ================= Blogs Section Start ==================*/-->
<?php
//Dispaly CPT Blogs
$blogs_args = array(
    'post_type' => 'blogs',
    'posts_per_page' => -1,
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
        <section class="prodect-wrep style-2">
            <div class="container">
                <div class="top-bar">
                    <div class="row align-items-center">
                        <div class="col-8 col-md-6">
                            <h3 class="product-title"><?= get_field('blog_heading', 'option'); ?></h3>
                        </div>
                        <div class=" col-4 col-md-6">
                            <div class="btn-block text-right"><a href="<?= home_url("/blogs/"); ?>" class="btn btn-primary">View all</a></div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home06" role="tabpanel" aria-labelledby="home-tab">
                        <div class="prodect-list style-2">
                            <div class="prodect-slider your-class" id="prodect-slider">
                                <?php
                                while ($blogsQuery->have_posts()) :
                                    $blogsQuery->the_post();
                                    ?>
                                    <div class="slid-item">
                                        <div class="prodect-item">
                                            <div class="them-img">
                                                <a href="<?= get_post_permalink(get_the_ID(), false, false); ?>">
                                                    <!--<img alt="<?= get_the_title(); ?>" src="<?= wp_get_attachment_url(get_field('blog_image', get_the_ID())); ?>"/>-->
                                                    <?= wp_get_attachment_image(get_field('blog_image', get_the_ID()), 'blogs-front-image', false, array('alt' => get_the_title())); ?>
                                                </a>
                                            </div>
                                            <div class="info">
                                                <a href="<?= get_post_permalink(get_the_ID(), false, false); ?>">
                                                    <h3><?= mb_strimwidth(get_the_title(), 0, 40, '...'); ?></h3>
                                                </a>
                                                <p><?= mb_strimwidth(get_field('blog_short_description', get_the_ID()), 0, 201, '...'); ?></p>
                                                <div class="date style-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <span><?= get_the_date($format = '', get_the_ID()); ?>  |<strong>By - <?= ucwords(strtolower(get_field('blog_created_by', get_the_ID()))); ?></strong></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="share-icon">
                                                    <a href="<?= get_post_permalink(get_the_ID(), false, false); ?>">
                                                        <img alt="<?= get_the_title(); ?>" src="<?= get_template_directory_uri(); ?>/images/icon-4.svg">
                                                    </a>
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
                    </div>
                </div>
            </div>
        </section>
        <?php
    endif;
}
?>
<!--/* ================= Blogs Section End ==================*/-->
<?php get_footer(); ?>
<script type="text/javascript">
    $(document).ready(function () {

        /**
         * Iframe video play.
         */
        $('.youtube_video_url_hidden').each(function () {
            var category_ids = $(this).attr('data-category-id'); //getting Iframe category id.
            var video_url_hidden = getvvId($(this).val());
            $(".youtube_video_url_hidden_iframe_" + category_ids).removeAttr('src'); //remove Iframe video player previous src.
            $(".youtube_video_url_hidden_iframe_" + category_ids).attr("src", "https://www.youtube.com/embed/" + video_url_hidden); //set new Iframe video player url into src.
        });

        /**
         * Left Side Youtube Video List.
         * @type getvvId.match
         */
        $(document).on('click', '.list_youtube_data', function () {
            var list_category_ids = $(this).attr('data-category-id'); //Getting list category id.
            var list_youtube_url = $(this).find('a').attr('data-youtube-url'); //getting list video url.

            $('.youtube_video_url_hidden').each(function () {
                var category_ids = $(this).attr('data-category-id'); //getting Iframe category id.
                if (category_ids == list_category_ids) {
                    $(this).val(list_youtube_url) //set into Iframe video player hidden field.
                    var video_url_hidden = getvvId($(this).val());
                    $(".youtube_video_url_hidden_iframe_" + category_ids).removeAttr('src'); //remove Iframe video player previous src.
                    $(".youtube_video_url_hidden_iframe_" + category_ids).attr("src", "https://www.youtube.com/embed/" + video_url_hidden); //set new Iframe video player url into src.
                }
            });
        });
    });

    //Convert the video url into embed code.
    function getvvId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return ((match && match[2].length === 11) ? match[2] : null);
    }
</script>