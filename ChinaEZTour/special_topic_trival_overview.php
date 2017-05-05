<?php
/**
 * Category Template:Overview
 */

get_header();
BookYourTravel_Theme_Utils::breadcrumbs();

global $wp_query;
$cat_ID = get_query_var('cat');
$category = get_category($cat_ID);

?>

    <script type="text/javascript">
        (function ($) {

            $(document).ready(function () {
                $('#tab-content1').show();
                $('#tab-content2').hide();

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
<?php echo $category->description; ?>


    <div class="row">
        <h2 class="text-center main-title">Top Destinations & Attractions Guide</h2>

        <p class="text-center">Vast, diverse, colorful, and limitless…yes, that’s China. Based on our first-hand local
            knowledge about China travel, we’ve selected out the most popular destinations which gather the most
            fascinating scenery, most fabulous cultural experience, tourist friendly from north to south, west to east,
            mountains to the prairies, cities to the villages, and rivers to the lakes. Wherever you’re headed, we’re
            already there taking care of you through every step! Get Inspired now!
        </p>

        <div style="max-width:800px; margin:0 auto">
            <div class="one-half  tab-title-act" id="tab-title-tag1">Destinations</div>
            <div class="one-half tab-title" id="tab-title-tag2">Attractions</div>
        </div>

        <div id="tab-content1">
            <?php
            query_posts(array(
                'posts_per_page' => 4,
                'post_type' => 'location',
                'meta_key'        => 'location_is_featured',
                'meta_value'      => '1',
            ));
            while (have_posts()):the_post();
            //search thumbnail
            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
            if ($thumbnail[0] == null || $thumbnail[0] == '') {
                $thumbnail[0] = home_url() . '/skin/img.jpg';
            }
            $locations_id=get_post_meta(get_the_id(),'locations',true);
            $tour_schedule=$bookyourtravel_tour_helper->list_tour_schedules(null,1,'Id','ASC',0,0,0,get_the_ID() );
            ?>
            <article class="one-fourth">
                <div>
                    <figure>
                        <a href="<?php echo get_the_permalink(); ?>">
                            <img class="lazy" data-original="<?php echo $thumbnail[0] ?>"
                                 alt="<?php echo get_the_title(); ?>" style="width:100%; height:180px">
                        </a>
                    </figure>
                    <div class="details" style="height: 50px;">
                        <h4>
                            <a href="<?php echo get_the_permalink(); ?>">
                            <?php echo get_the_title(); ?>
                            </a>
                        </h4>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_query(); ?>
        </div>
        <div id="tab-content2">
            <?php
            query_posts(array(
                'posts_per_page' => 4,
                'post_type' => 'tour',
                'meta_key'        => 'tour_is_featured',
                'meta_value'      => '1',
            ));
            while (have_posts()):the_post();
            //search thumbnail
            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
            if ($thumbnail[0] == null || $thumbnail[0] == '') {
                $thumbnail[0] = home_url() . '/skin/img.jpg';
            }
            $locations_id=get_post_meta(get_the_id(),'locations',true);
            $tour_schedule=$bookyourtravel_tour_helper->list_tour_schedules(null,1,'Id','ASC',0,0,0,get_the_ID() );
            ?>
                <article class="one-fourth">
                    <div>
                        <figure>
                            <a href="<?php echo get_the_permalink(); ?>">
                                <img class="lazy" data-original="<?php echo $thumbnail[0] ?>"
                                     alt="<?php echo get_the_title(); ?>" style="width:100%; height:180px">
                            </a>
                        </figure>
                        <div class="details" style="height: 50px;">
                            <h4>
                                <a href="<?php echo get_the_permalink(); ?>">
                                    <?php echo get_the_title(); ?>
                                </a>
                            </h4>
                        </div>
                    </div>
                </article>
            <?php endwhile; wp_reset_query(); ?>
        </div>
        <h2 class="text-center main-title">Shh...the Best Advice You Could Ever Get(China Overview)</h2>

        <p class="text-center">Our “best of China” articles will help you making a choice among the highlights of China,
            from food to sights to souvenirs. Our “Tour Planning” articles offer expert advice on how to visit
            destinations with the utmost efficiency and enjoyment.
        </p>

        <?php
        $chinaOverViewChildren = get_categories(array('child_of' => 23, 'hide_empty' => 0,'hierarchical'=>0));
        foreach ($chinaOverViewChildren as $chinaOverViewChild) {
            if (function_exists('get_tax_image_urls'))
                $img_urls = get_tax_image_urls($chinaOverViewChild->cat_ID,'full');
            if($img_urls[0]==null||$img_urls[0]==''){
                $img_urls[0]=home_url() . '/skin/img.jpg';
            }

            ?>
            <article class="one-fourth">
                <div>
                    <figure class="f-item">
                        <a href="<?php echo get_category_link($chinaOverViewChild->cat_ID); ?>" title="<?php echo $chinaOverViewChild->name; ?>">
                            <img class="lazy" data-original="<?php echo $img_urls[0]; ?>" alt="<?php echo $chinaOverViewChild->name; ?>" style="width:100%; height:200px">

                            <div class="title-img"><?php echo $chinaOverViewChild->name; ?></div>
                        </a>
                    </figure>
                </div>
            </article>
        <?php } ?>


              <h2 class="text-center main-title">Top Recommended China Tours</h2>

        <p>These are our best sellers. Over 10,000 customers in the last year have helped select these as the most
            popular China Highlights tours. Of course each of them can be tailor-made to your requirements at the
            booking stage. Take a look and contact us. Our consultancy is free.</p>
        <?php
        $args = array(
            'post_type' => 'tour',
            'posts_per_page' => 6,
            'meta_query'=>array(
                array(
                    'key'        => 'tour_is_featured',
                    'value'      => '1',
                    'compare'=>'='
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
            $locations_id=get_post_meta(get_the_id(),'locations',true);
            $tour_schedule=$bookyourtravel_tour_helper->list_tour_schedules(null,1,'Id','ASC',0,0,0,get_the_ID() );

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
                                                   title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h4>
                    <span class="address over-hidden">
                    <?php
                    foreach ($locations_id as $location_id) {
                        echo get_the_title($location_id).' ';
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

                        <div class="description clearfix"><?php echo substr(get_the_excerpt(),0,160).'...'; ?> <a
                                href="<?php echo get_the_permalink(); ?>">More
                                info</a></div>

                    </div>
                </div>
            </article>
        <?php endwhile; wp_reset_postdata();  ?>
    </div>
<?php
get_footer();
?>