<?php

/**

 * Template Name:ChinaTours

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

                    <figure class="f-item">

                        <img src="<?php echo $thumbnail[0] ?>"

                             alt="<?php echo get_the_title(); ?>"

                             style="width:100%; height:150px">

                        <div class="title-img"><a  style=" color:#FFFFFF" href="<?php echo get_the_permalink() . '/tour_' . get_the_ID(); ?>"

                                                   title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>

                        </div>

                    </figure>



                        



                </div>

            </article>

        <?php endwhile;

        wp_reset_query(); ?>



        <div style="max-width:800px; margin:0 auto" class="clearfix">

            <div class="one-half tab-title-act" id="tab-title-tag1">Top China Tours</div>

            <div class="one-half tab-title" id="tab-title-tag2">Classic China Tours</div>

        </div>



        <div id="tab-content1" style="display: block;">

            <?php

            $args = array(

                'post_type' => 'tour',

                'posts_per_page' => 4,

                'tax_query' => array(

                    array(

                        'taxonomy' => 'tour_category',

                        'field' => 'id',

                        'terms' => '60'

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



                ?>

                <article class="tour_item one-fourth">

                    <div>

                        <figure>

                            <img class="lazy" data-original="<?php echo $thumbnail[0] ?>"

                                 alt="<?php the_title(); ?>" title="<?php the_title(); ?>"

                                 style="width:100%; height:200px">

                        </figure>

                        <div class="details">

                            <h4 class="over-hidden"><a href="<?php the_permalink() ?>"

                                                       title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>



                            <div class="description clearfix" style="height: 130px">

                                <?php echo substr(get_the_excerpt(),0,140).'...'; ?>

                                </div><a href="<?php the_permalink() ?>">More

                                info</a>



                        </div>

                    </div>

                </article>

            <?php endwhile; wp_reset_postdata();?>

        </div>

        <div id="tab-content2" style="display: none;">

            <?php

            $args = array(

                'post_type' => 'tour',

                'posts_per_page' => 4,

                'tax_query' => array(

                    array(

                        'taxonomy' => 'tour_category',

                        'field' => 'id',

                        'terms' => '61'

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



                ?>

                <article class="tour_item one-fourth">

                    <div>

                        <figure>

                            <img class="lazy" data-original="<?php echo $thumbnail[0] ?>"

                                 alt="<?php the_title(); ?>" title="<?php the_title(); ?>"

                                 style="width:100%;height: 200px">

                        </figure>

                        <div class="details">

                            <h4 class="over-hidden"><a href="<?php the_permalink() ?>"

                                                       title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>



                            <div class="description clearfix" style="height: 120px">

                                <?php echo substr(get_the_excerpt(),0,160).'...'; ?>

                                </div><a href="<?php the_permalink() ?>">More

                                info</a>



                        </div>

                    </div>

                </article>

            <?php endwhile; wp_reset_postdata();?>

        </div>

        <h2 class="text-center main-title">China Travel by Theme</h2>



        <p>Want to find some featured and in-depth experiences in China? Here we have many! If you&rsquo;ve got an idea

            of which style of trip you prefer, just browse our following<strong>different travel themes</strong>. If you

            are desired to explore some special highlights of China, there&rsquo;s always something to suit you. Whether

            you&rsquo;re an adventure lover, history fan, or fascinated by wonderful nature, China has a <strong>themed

                trip</strong> that's perfect for you.</p>



        <p>Besides, we are here ready to help you design your own theme travel experience in China which suits your

            likes and specific needs. You could tailor make your own high speed train travel, Tibet discovery, ancient

            Silk Road tour, China photography tour, hiking &amp; trekking, and China heritage &amp; national parks

            tour! <strong>Let's explore China in different way now!</strong></p>

        <?php

        $chinaOverViewChildren = get_categories(array('child_of' => 62, 'hide_empty' => 0,'hierarchical'=>0,'taxonomy'=> 'tour_category',));

        foreach ($chinaOverViewChildren as $chinaOverViewChild) {

        if (function_exists('get_tax_image_urls'))

            $img_urls = get_tax_image_urls($chinaOverViewChild->cat_ID,'large');

        if($img_urls[0]==null||$img_urls[0]==''){

            $img_urls[0]=home_url() . '/skin/img.jpg';

        }

        ?>

        <article class="one-fifth">

            <div>

                <figure class="f-item">

                    <a href="<?php echo get_category_link($chinaOverViewChild->cat_ID); ?>" title="<?php echo $chinaOverViewChild->name; ?>">

                        <img class="lazy" data-original="<?php echo $img_urls[0] ?>"

                             alt="<?php echo $chinaOverViewChild->name; ?>" style="width:100%; height:160px">



                        <div class="title-img"><?php echo $chinaOverViewChild->name; ?></div>

                    </a>

                </figure>

            </div>

        </article>

        <?php } ?>





        <h2 class="text-center main-title">China Tours from Gateway Cities</h2>



        <p>You may travel to China from America, Europe, Southeastern Asia or Middle Asia, firstly, you will arrive at

            one of gateway cities in China. During past years, most of our guests have chosen Beijing, Hong Kong,

            Shanghai and Chengdu as their arrival cities in China not only because they provide frequent and flexible

            international flights, but also they are popular classic tourist destination that one couldn't miss in

            China. From Beijing, Shanghai, Hong Kong or Chengdu, you can easily extend your itinerary to other hot

            destinations in China, such as Xian, Tibet, Guilin, Huangshan, Zhangjiajie, Jiuzhaigou, Hangzhou, etc. We

            can also customize the trip according to your personal needs.</p>



        <article class="one-half">

            <img data-original="/skin/china-tours-from-sh.jpg"

                 class="one-third lazy hidden-xs">



            <div class="two-third">

                <h3>China Tours from shanghai</h3>



                <p>the most featured and popular destination in China with many world heritage sites;</p>

                <ul>

                    <?php

                    query_posts(array(

                        'post_type' => 'tour',

                        'posts_per_page' => 6,

                        'meta_query' => array(

                            array(

                                'key' => 'locations',

                                'value' => serialize(strval(1229)),

                                'compare' => 'LIKE'

                            )

                        )



                    ));

                    while (have_posts()):the_post();

                        echo '<li class="over-hidden"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';

                    endwhile; wp_reset_query();;

                    ?>

                </ul>

            </div>

        </article>



        <article class="one-half">

            <img data-original="/skin/china-tours-from-bj.jpg"

                 class="one-third lazy hidden-xs">



            <div class="two-third">

                <h3>China Tours from Beijing</h3>



                <p>the most featured and popular destination in China with many world heritage sites;</p>

                <ul>

                    <?php

                    query_posts(array(

                        'post_type' => 'tour',

                        'posts_per_page' => 6,

                        'meta_query' => array(

                            array(

                                'key' => 'locations',

                                'value' => serialize(strval(37)),

                                'compare' => 'LIKE'

                            )

                        )



                    ));

                    while (have_posts()):the_post();

                        echo '<li class="over-hidden"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';

                    endwhile; wp_reset_query();;

                    ?>

                </ul>

            </div>

        </article>



        <article class="one-half">

            <img data-original="/skin/china-tours-from-cd.jpg"

                 class="one-third lazy hidden-xs">



            <div class="two-third">

                <h3>China Tours from chengdu</h3>



                <p>the most featured and popular destination in China with many world heritage sites;</p>

                <ul>

                    <?php

                    query_posts(array(

                        'post_type' => 'tour',

                        'posts_per_page' => 6,

                        'meta_query' => array(

                            array(

                                'key' => 'locations',

                                'value' => serialize(strval(73)),

                                'compare' => 'LIKE'

                            )

                        )



                    ));

                    while (have_posts()):the_post();

                        echo '<li class="over-hidden"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';

                    endwhile; wp_reset_query();;

                    ?>

                </ul>

            </div>

        </article>



        <article class="one-half">

            <img data-original="/skin/china-tours-from-xa.jpg"

                 class="one-third lazy hidden-xs">



            <div class="two-third">

                <h3>China Tours from xian</h3>



                <p>the most featured and popular destination in China with many world heritage sites;</p>

                <ul>

                    <?php

                    query_posts(array(

                        'post_type' => 'tour',

                        'posts_per_page' => 6,

                        'meta_query' => array(

                            array(

                                'key' => 'locations',

                                'value' => serialize(strval(129)),

                                'compare' => 'LIKE'

                            )

                        )



                    ));

                    while (have_posts()):the_post();

                        echo '<li class="over-hidden"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';

                    endwhile; wp_reset_query();;

                    ?>

                </ul>

            </div>

        </article>



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

                    <div class="details">

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



                        <div class="description clearfix"><?php echo substr(get_the_excerpt(), 0, 160) . '...'; ?> </div><a

                            href="<?php echo get_the_permalink(); ?>">More

                            info</a>



                    </div>

                </div>

            </article>

        <?php endwhile;

        wp_reset_postdata(); ?>

    </div>

<?php

get_footer();

?>