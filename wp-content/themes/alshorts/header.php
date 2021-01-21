<!DOCTYPE html>
<html>
    <head>
        <title><?php the_title(); ?></title>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
    </head>
    <!-- Main Header -->
    <header class="main-header" id="main-header">
        <!-- Top Header -->
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-9 col-md-9 col-lg-8">
                        <ul class="top-menu-list">
                            <li class="d-none-2">
                                <span class="them-icon">
                                    <img alt="time" src="<?= get_template_directory_uri(); ?>/images/icon-1.svg">
                                </span>
                                <a href="javascript:void(0);"><?= date('l j F Y'); ?></a>
                            </li>
                            <li><a href="<?= home_url("/gold-forex/"); ?>">Gold/Forex</a></li>
                            <li><span class="them-icon">
                                    <img alt="prayer-time" src="<?= get_template_directory_uri(); ?>/images/icon-1.svg"></span>
                                <a href="<?= home_url("/prayer-time/"); ?>">Prayer Time</a>
                            </li>
                        </ul>
                    </div>
                    <div class=" col-sm-3 col-md-3 col-lg-4">
                        <div class="text-right">
                            <ul class="heder-right-menu">
                                <li><a href="<?= home_url("/blogs/"); ?>">Blog</a></li>
                                <li class="translet">
                                    <div  class="translet"><span class="them-icon"><img alt="" src="<?= get_template_directory_uri(); ?>/images/icon-2.svg"></span>
                                        <?php
                                        //echo ICL_LANGUAGE_CODE;
                                        do_action('wpml_add_language_selector');
                                        ?>
<!--                                        <select class="form-control">
                                            <option>English</option>
                                            <option>English</option>
                                            <option>English</option>
                                        </select>-->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Inner Header -->
        <div class="inner-header-wrep">
            <div class="inner-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6 col-md-4 col-lg-6">
                            <div class="logo"><a href="<?= home_url("/"); ?>"><img alt="" src="<?= get_template_directory_uri(); ?>/images/logo.svg"></a></div>
                        </div>
                        <div class="d-md-block col-6 col-md-8 col-lg-6">
                            <div class="text-right">
                                <ul class="stors-link">
                                    <li><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/appstore.svg"></a><span>Partner with us</span></li>
                                    <li><a href="#0"><img alt="" src="<?= get_template_directory_uri(); ?>/images/playstore.svg"></a><span>Our Services</span></li>
                                </ul>
                            </div>
                            <div class="text-right">
                                <ul class="heder-right-menu style-2">
                                    <li><a href="<?= home_url("/blogs/"); ?>">Blog</a></li>
                                    <li class="translet">
                                        <div class="translet"><span class="them-icon"><img alt="" src="<?= get_template_directory_uri(); ?>/images/icon-2.svg"></span>
                                            <?php do_action('wpml_add_language_selector'); ?>
<!--                                            <select class="form-control">
                                                <option>English</option>
                                                <option>English</option>
                                                <option>English</option>
                                            </select>-->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Header Category Section -->
            <?php
            
            //$getting_current_url = $_SERVER['REQUEST_URI'];
            //echo "<pre>".print_r($getting_current_url,TRUE)."</pre>";
            
            $category_data_array = array();
            $category_api_url = API_BASEURL . "v1/get/GetCategory";
            //  Initiate curl
            $ch = curl_init();
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL, $category_api_url);
            // Execute
            $category_api_result = curl_exec($ch);
            // Closing
            curl_close($ch);

            // Will dump a beauty json :3
            //var_dump(json_decode($category_result, true));
            $category_api_data_array = json_decode($category_api_result, true);

            if (!empty($category_api_data_array['data']['results'])) {
                /**
                 * Shoring the array by position
                 */
                usort($category_api_data_array['data']['results'], function($a, $b) {
                    return $a['position'] <=> $b['position'];
                });

                $category_data_array = $category_api_data_array['data']['results'];
            }
            //echo "<pre>" . print_r($category_data_array, TRUE) . "</pre>";
            //die;
            ?>
            <div class="header-menu">
                <div class="container">
                    <?php if (!empty($category_data_array)) { ?>
                        <ul class="menu">
                            <?php
                            $category_count = 1;
                            foreach ($category_data_array as $category_data) {
                                if (!empty($category_data['position']) && (!empty($category_data['nameHindi'])) && ($category_count <= 11)) {
                                    ?>
                                    <li class="<?php if (!empty($_GET['categoryId']) && ($_GET['categoryId'] == $category_data['_id'])) { ?> active <?php } ?>">
                                        <a href="<?= home_url("/category/?categoryId=" . $category_data['_id']); ?>">
                                            <?= ((ICL_LANGUAGE_CODE == 'hi') ? $category_data['nameHindi'] : $category_data['name']); ?>
                                        </a>
                                    </li>
                                    <?php
                                    $category_count++;
                                }
                            }
                            ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
