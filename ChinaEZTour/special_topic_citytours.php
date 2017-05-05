<?php
/**
 * Template Name:CityTours
 */

get_header();
BookYourTravel_Theme_Utils::breadcrumbs();

global $wp_query,$bookyourtravel_style_helper;


?>
    <script type="text/javascript">
        (function ($) {

            $(document).ready(function () {


                $('#tab-content1').hide();
                $('#tab-content2').show();

                $('#tab-title-tag2').bind('click', function () {
                    $(this).removeClass('tab-title')
                        .addClass('tab-title-act');
                    $('#tab-title-tag1').removeClass('tab-title-act')
                        .addClass('tab-title');

                    $('#tab-content2').show();
                    $('#tab-content1').hide();
                });

                $('#tab-title-tag1').bind('click', function () {
                    $(this).removeClass('tab-title')
                        .addClass('tab-title-act');
                    $('#tab-title-tag2').removeClass('tab-title-act')
                        .addClass('tab-title');
                    $('#tab-content2').hide();
                    $('#tab-content1').show();
                });
            });


        })(jQuery);
    </script>

    <div class="row">

        <?php
        //page的内容
        echo get_post(377)->post_content;
        ?>

        <?php

        query_posts(array(
            'posts_per_page' => 5,
            'post_type' => 'location',
            'meta_key' => 'location_is_featured',
            'meta_value' => '1',
        ));
        while (have_posts()):the_post();
            //search thumbnail
            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
            if ($thumbnail[0] == null || $thumbnail[0] == '') {
                $thumbnail[0] = home_url() . '/skin/img.jpg';
            }
            $locations_id = get_post_meta(get_the_id(), 'locations', true);
            $tour_schedule = $bookyourtravel_tour_helper->list_tour_schedules(null, 1, 'Id', 'ASC', 0, 0, 0, get_the_ID());
            ?>
            <article class="tour_item one-fifth">
                <div>
                    <figure>
                        <img class="lazy" data-original="<?php echo $thumbnail[0] ?>"
                             alt="<?php echo $thumbnail[0] ?>"
                             style="width:100%; height:150px">
                    </figure>
                    <div class="details" style="height: 70px;">
                        <h4 class="over-hidden"><a href="<?php echo get_the_permalink() . '/tour_' . get_the_ID(); ?>"
                                                   title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
                        </h4>


                    </div>
                </div>
            </article>
        <?php endwhile;
        wp_reset_query(); ?>

        <h2 class="text-center main-title">Places to Visit in China (Index)</h2>

        <p class="text-center">It's depend on your interests, budget and dates to choose the destination. If you have a
            week or more, you can travel to some large provinces, such as Tibet, Yunnan, Gansu, Shandong, etc. If you
            are seeking a city break, just choose a short city tour package whick usually takes 3~5 days. If you can't
            find the cities you can interested in on our website, please feel free to contact us. Our experienced travel
            experts can help you customize your own trip to any city in China.</p>

        <div class="one-half tab-title-act" id="tab-title-tag2">By city</div>
        <div class="one-half tab-title" id="tab-title-tag1">By Provinces</div>
        <?php
        $args = array(
            'post_type' => 'location',
            'posts_per_page'=>1000,
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'location_province_city',
                    'value' => 'city',
                    'compare' => '='
                )
            )

        );
        $query = new WP_Query($args);
        ?>
        <div id="tab-content2">


            <div class="one-fifth tab-title-sub">
                <h4 class="">A-E</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first = substr(get_the_title(), 0, 1);
                        $first_value = ord($first);
                        if (($first_value >= 65 && $first_value <= 69) || ($first_value >= 97 && $first_value <= 101)) {
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub">
                <h4 class="">F-J</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first = substr(get_the_title(), 0, 1);
                        $first_value = ord($first);
                        if (($first_value >= 70 && $first_value <= 74) || ($first_value >= 102 && $first_value <= 106)) {
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub">
                <h4 class="">K-O</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first = substr(get_the_title(), 0, 1);
                        $first_value = ord($first);
                        if (($first_value >= 75 && $first_value <= 79) || ($first_value >= 107 && $first_value <= 111)) {
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub">
                <h4 class="">P-T</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first = substr(get_the_title(), 0, 1);
                        $first_value = ord($first);
                        if (($first_value >= 80 && $first_value <= 84) || ($first_value >= 112 && $first_value <= 116)) {
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub">
                <h4 class="">U-Z</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first = substr(get_the_title(), 0, 1);
                        $first_value = ord($first);
                        if (($first_value >= 85 && $first_value <= 90) || ($first_value >= 117 && $first_value <= 122)) {
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>

        </div>
        <?php wp_reset_postdata(); ?>

        <?php
        $args = array(
            'post_type' => 'location',
            'posts_per_page'=>1000,
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'location_province_city',
                    'value' => 'province',
                    'compare' => '='
                )
            )
        );
        $query = new WP_Query($args);
        ?>
        <div id="tab-content1">
            <div class="one-fifth tab-title-sub">
                <h4 class="">A-E</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first = substr(get_the_title(), 0, 1);
                        $first_value = ord($first);
                        $province_city = get_post_meta(get_the_ID(), 'location_province_city', true);
                        if (($first_value >= 65 && $first_value <= 69) || ($first_value >= 97 && $first_value <= 101)) {
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub">
                <h4 class="">F-J</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first = substr(get_the_title(), 0, 1);
                        $first_value = ord($first);
                        $province_city = get_post_meta(get_the_ID(), 'location_province_city', true);
                        if (($first_value >= 70 && $first_value <= 74) || ($first_value >= 102 && $first_value <= 106)) {
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub">
                <h4 class="">K-O</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first = substr(get_the_title(), 0, 1);
                        $first_value = ord($first);
                        $province_city = get_post_meta(get_the_ID(), 'location_province_city', true);
                        if (($first_value >= 75 && $first_value <= 79) || ($first_value >= 107 && $first_value <= 111)) {
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub">
                <h4 class="">P-T</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first = substr(get_the_title(), 0, 1);
                        $first_value = ord($first);
                        $province_city = get_post_meta(get_the_ID(), 'location_province_city', true);
                        if (($first_value >= 80 && $first_value <= 84) || ($first_value >= 112 && $first_value <= 116)) {
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub">
                <h4 class="">U-Z</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first = substr(get_the_title(), 0, 1);
                        $first_value = ord($first);
                        $province_city = get_post_meta(get_the_ID(), 'location_province_city', true);
                        if (($first_value >= 85 && $first_value <= 90) || ($first_value >= 117 && $first_value <= 122)) {
                            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>

        </div>
        <?php wp_reset_postdata(); ?>
        <h2 class="text-center main-title">Top Recommended China Tours</h2>

        <p>These are our best sellers. Over 10,000 customers in the last year have helped select these as the most
            popular China Highlights tours. Of course each of them can be tailor-made to your requirements at the
            booking stage. Take a look and contact us. Our consultancy is free.</p>

        <?php
        $args = array(
            'post_type' => 'tour',
            'posts_per_page' => 6,
            'meta_query' => array(
                array(
                    'key' => 'tour_is_featured',
                    'value' => '1',
                    'compare' => '=',
                )
            )

        );
        $query = new WP_Query($args);

        while ($query->have_posts()):
            $query->the_post();

            //search thumbnail
            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
            if ($thumbnail[0] == null || $thumbnail[0] == '') {
                $thumbnail[0] = home_url() . '/skin/img.jpg';
            }
            $locations_id = get_post_meta(get_the_id(), 'locations', true);
            $tour_schedule = $bookyourtravel_tour_helper->list_tour_schedules(null, 1, 'Id', 'ASC', 0, 0, 0, get_the_ID());

            ?>
            <article class="tour_item one-third">
                <div>
                    <figure>
                        <img class="lazy" data-original="<?php echo $thumbnail[0] ?>"
                             alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>"
                             style="width:100%; height:250px">
                    </figure>
                    <div class="details" style="height: 235px;">
                        <h4 class="over-hidden"><a href="<?php echo get_the_permalink(); ?>"
                                                   title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
                        </h4>
                    <span class="address over-hidden">
                    <?php
                    foreach ($locations_id as $location_id) {
                        echo get_the_title($location_id) . ' ';
                    }
                    ?>
                    </span>
                        <span class="days"><?php echo $tour_schedule['results'][0]->duration_days; ?>days</span>

                        <div class="price clearfix">
                            Price per person from <em>
                                <span class="curr">$</span>
                                <span class="amount"><?php echo $tour_schedule['results'][0]->price; ?></span>
                            </em>
                        </div>

                        <div class="description clearfix"><?php echo substr(get_the_excerpt(), 0, 160) . '...'; ?> <a
                                href="<?php echo get_the_permalink(); ?>">More
                                info</a></div>

                    </div>
                </div>
            </article>
        <?php endwhile;
        wp_reset_postdata(); ?>


    </div>
<?php
get_footer();
?>