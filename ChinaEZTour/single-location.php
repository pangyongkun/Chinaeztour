<?php



get_header();

BookYourTravel_Theme_Utils::breadcrumbs();

get_sidebar('under-header');



global $post, $current_user, $bookyourtravel_theme_globals, $bookyourtravel_theme_of_custom, $bookyourtravel_accommodation_helper, $bookyourtravel_cruise_helper, $bookyourtravel_tour_helper, $bookyourtravel_car_rental_helper, $default_location_tabs;



$enable_accommodations = $bookyourtravel_theme_globals->enable_accommodations();

$enable_cruises = $bookyourtravel_theme_globals->enable_cruises();

$enable_car_rentals = $bookyourtravel_theme_globals->enable_car_rentals();

$enable_tours = $bookyourtravel_theme_globals->enable_tours();

$price_decimal_places = $bookyourtravel_theme_globals->get_price_decimal_places();

$location_extra_fields = $bookyourtravel_theme_globals->get_location_extra_fields();

$tab_array = $bookyourtravel_theme_globals->get_location_tabs();



$show_map=true;



if (have_posts()) {

    the_post();

    $location_id = $post->ID;

    $location_obj = new BookYourTravel_Location($post);



    $display_as_directory = $location_obj->get_custom_field('display_as_directory');

    ?>

    <div class="row">

        <?php

        if (!$display_as_directory) {

            ?>

            <!--three-fourth content-->

            <section class="three-fourth">

                <?php $location_obj->render_image_gallery(); ?>

                <p><?php echo $location_obj->get_description(); ?></p>


<h2><?php echo $location_obj->get_title(); ?> History</h2>
<p><?php echo $location_obj->get_custom_field('history'); ?></p>
<h2><?php echo $location_obj->get_title(); ?> Culture</h2>
<p><?php echo $location_obj->get_custom_field('culture'); ?></p>
                <div>

                    <h2>Top Attractions</h2>



                    <p><?php echo $location_obj->get_custom_field('attractions'); ?><a

                            href="<?php echo $location_obj->get_permalink() . '/attractions_' . $location_obj->get_id(); ?>">More <?php echo $location_obj->get_title(); ?>

                            Attractions&nbsp;&nbsp;>></a></p>



                    <!--列出景点-->

                    <div class="row">



                        <?php

                        //查询景点

                        $args = array(

                            'post_type' => 'post',

                            'category_name' => 'Attractions',

                            'posts_per_page' => 4,

                            'meta_query' => array(

                                array(

                                    'key' => '_post_location',

                                    'value' => $location_id,

                                    'compare' => '='

                                ),

                            ),

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

                            <!--attraction item-->

                            <article class="tour_item one-fourth">

                                <div>

                                    <figure>

                                        <img class="lazy" data-original="<?php echo $thumbnail[0] ?>"

                                             alt="<?php the_title(); ?>" title="<?php the_title(); ?>"

                                             style="width:100%; height:160px">

                                    </figure>

                                    <div class="details">

                                        <h4 class="over-hidden"><a href="<?php the_permalink() ?>"

                                               title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>



                                        <div class="description clearfix" style="height:190px ">

                                            <?php echo substr(get_the_excerpt(),0,160).'...'; ?>

                                            </div>

                                        <a href="<?php the_permalink() ?>">More

                                            info</a>



                                    </div>

                                </div>

                            </article>

                            <!--//attraction item-->

                        <?php

                        endwhile;

                        wp_reset_postdata();

                        ?>



                    </div>

                    <!--/列出景点-->



                    <?php

                    /*如果是市则列出交通*/

                    if($location_obj->get_custom_field('province_city')=='city'||$location_obj->get_custom_field('province_city')=='resorts'){ ;?>

                        <div class="clearfix">



                            <h2>Transportation</h2>

                            <?php

                            $img_key = $location_obj->get_custom_field('history_image');

                            $img = wp_get_attachment_image_src($img_key, full);

                            if ($img[0] != null) {

                                ?>



                                <img class="lazy" data-original="<?php echo $img[0] ?>" width="200px" style="margin:0px 10px 5px 0px; float:left; border:1px solid #CCCCCC ; padding:5px">

                            <?php

                            }

                            echo $location_obj->get_custom_field('transportation'); ?><a

                                href="<?php echo $location_obj->get_permalink() . '/Transportation_' . $location_obj->get_id(); ?>">More <?php echo $location_obj->get_title(); ?>

                                Transportation&nbsp;&nbsp;>></a>



                            <!--列出交通-->

                            <div class="text-wrap">

                                <ul class="full-width">

                                    <?php



                                    /*查询交通列表*/

                                    $args = array(

                                        'post_type' => 'post',

                                        'category_name' => 'Transportation',

                                        'meta_query' => array(

                                            array(

                                                'key' => '_post_location',

                                                'value' => $location_id,

                                                'compare' => '='

                                            ),

                                        )

                                    );

                                    $query = new WP_Query($args);

                                    while ($query->have_posts()):

                                        $query->the_post();

                                        ?>

                                        <li class="one-half"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

                                    <?php endwhile;

                                    wp_reset_postdata(); ?>

                                </ul>

                            </div>

                            <!--/列出交通-->

                        </div>

                    <?php }?>



                    <?php

                    /*如果是省,则列出下级旅游城市*/

                    if($location_obj->get_custom_field('province_city')=='province'){ ;?>

                        <div class="clearfix">

                            <h2>Tour City of <?php echo $location_obj->get_title(); ?></h2>



                            <!--列出当前省下面的旅游景点-->

                            <div class="row">



                                <?php



                                /*查询当前省的旅游地点*/

                                $args = array(

                                    'post_type' => 'location',

                                    'posts_per_page' => 4,

                                    'post_parent'=> $location_obj->get_id(),



                                );

                                $query = new WP_Query($args);

                                while ($query->have_posts()):$query->the_post();



                                    //search thumbnailid

                                    $thumbnail_id = get_post_thumbnail_id(get_the_ID());



                                    $thumbnail = wp_get_attachment_image_src($thumbnail_id,full);





                                    if ($thumbnail[0] == null || $thumbnail[0] == '') {

                                        $thumbnail[0] = home_url() . '/skin/img.jpg';

                                    }

                                    ?>

                                    <!--当前省旅游地点 item-->

                                    <article class="one-fourth">

                                        <div>

                                            <figure>

                                                <a href="<?php the_permalink(); ?>"

                                                   title="<?php the_title(); ?>">

                                                    <img class="lazy" data-original="<?php echo $thumbnail[0] ?>"

                                                        alt="<?php the_title(); ?>" style="width: 100%;height: 160px">

                                                </a>

                                            </figure>

                                            <div class="details" style="height: 50px;">

                                                <h4>

                                                    <?php the_title(); ?>

                                                </h4>



                                            </div>

                                        </div>

                                    </article>

                                    <!--/当前省旅游地点 item-->

                                <?php endwhile;

                                wp_reset_postdata(); ?>



                            </div>

                            <!--/列出热门旅游景点-->

                        </div>

                    <?php }?>

                    <div class="clearfix">

                        <h2>Useful Maps</h2>

                        <a href="<?php echo $location_obj->get_permalink() . '/Maps_' . $location_obj->get_id(); ?>">View

                            more <?php echo $location_obj->get_title(); ?>

                            maps >> </a>

                        <!--列出maps-->

                        <div class="row">



                            <?php

                            /*查询Maps(post)*/

                            $args = array(

                                'post_type' => 'post',

                                'category_name' => 'Maps',

                                'posts_per_page' => 4,

                                'meta_query' => array(

                                    array(

                                        'key' => '_post_location',

                                        'value' => $location_id,

                                        'compare' => '='

                                    )

                                )

                            );

                            $query = new WP_Query($args);

                            while ($query->have_posts()):$query->the_post();



                                //search thumbnailid

                                $thumbnail_id = get_post_thumbnail_id(get_the_ID());



                                $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);





                                if ($thumbnail[0] == null || $thumbnail[0] == '') {

                                    $thumbnail[0] = home_url() . '/skin/img.jpg';

                                }

                                ?>

                                <!--Maps item-->

                                <article class="one-fourth">

                                    <div>

                                        <figure>

                                            <a href="<?php the_permalink(); ?>"

                                               title="<?php the_title(); ?>">

                                                <img class="lazy"

                                                    data-original="<?php echo $thumbnail[0] ?>"

                                                    alt="<?php the_title(); ?>" style="width:100%; height:160px">

                                            </a>

                                        </figure>

                                        <div class="details" style="height: 50px;">

                                            <h4>

                                                <?php the_title(); ?>

                                            </h4>



                                        </div>

                                    </div>

                                </article>

                                <!--//Maps item-->

                            <?php endwhile;

                            wp_reset_postdata(); ?>



                        </div>

                        <!--/列出maps-->

                    </div>

                    <div class="clearfix">

                    <h2>Other Popular Destinations in China</h2>



                    <p>China is vast and diverse. You can choose your favorite destination among more than 70 tourist

                        destination and regions. Following are 4 popular destinations you may get interested in. Check

                        all <a

                            href="#">destinations in China</a></p>

                    <!--列出热门旅游景点-->

                    <div class="row">

                        <?php

                        /*查询热门旅游地点*/

                        $args = array(

                            'post_type' => 'location',

                            'posts_per_page' => 4,

                            'post__not_in' => array($location_id),

                            'meta_query' => array(

                                array(

                                    'key' => 'location_is_featured',

                                    'value' => 1,

                                    'compare' => '='

                                )

                            )

                        );

                        $query = new WP_Query($args);

                        while ($query->have_posts()):$query->the_post();



                            //search thumbnailid

                            $thumbnail_id = get_post_thumbnail_id(get_the_ID());

                            $thumbnail = wp_get_attachment_image_src($thumbnail_id,full);



                            if ($thumbnail[0] == null || $thumbnail[0] == '') {

                                $thumbnail[0] = home_url() . '/skin/img.jpg';

                            }

                            ?>

                            <!--热门旅游地点 item-->

                            <article class="one-fourth">

                                <div>

                                    <figure>

                                        <a href="<?php the_permalink(); ?>"

                                           title="<?php the_title(); ?>">

                                            <img class="lazy hotdest" data-original="<?php echo $thumbnail[0] ?>"

                                                alt="<?php the_title(); ?>">

                                        </a>

                                    </figure>

                                    <div class="details" style="height: 50px;">

                                        <h4>

                                            <?php the_title(); ?>

                                        </h4>



                                    </div>

                                </div>

                            </article>

                            <!--/热门旅游地点 item-->

                        <?php endwhile;

                        wp_reset_postdata(); ?>



                    </div>

                    <!--/列出热门旅游景点-->

                    </div>

                </div>

                <?php do_action('bookyourtravel_show_single_location_tab_content_before'); ?>





                <?php

                foreach ($tab_array as $tab) {

                    if (count(BookYourTravel_Theme_Utils::custom_array_search($default_location_tabs, 'id', $tab['id'])) == 0) {



                        $all_empty_fields = BookYourTravel_Theme_Utils::are_tab_fields_empty('location_extra_fields', $location_extra_fields, $tab['id'], $location_obj);



                        if (!$all_empty_fields) {



                            ?>

                            <section id="<?php echo esc_attr($tab['id']); ?>"

                                     class="tab-content <?php echo($first_display_tab == $tab['id'] ? 'initial' : ''); ?>">

                                <article>

                                    <?php do_action('bookyourtravel_show_single_location_' . $tab['id'] . '_before'); ?>

                                    <?php BookYourTravel_Theme_Utils::render_tab_extra_fields('location_extra_fields', $location_extra_fields, $tab['id'], $location_obj); ?>

                                    <?php do_action('bookyourtravel_show_single_location_' . $tab['id'] . '_after'); ?>

                                </article>

                            </section>

                        <?php



                        }

                    }

                }

                do_action('bookyourtravel_show_single_location_tab_content_after'); ?>



            </section>



            <?php

            echo '<div id="slider-guide">';

            include('custom/right_siderbar.php');

            get_sidebar('right');

            echo '</div>';





        } else {



            if (get_query_var('paged-byt')) {

                $paged = get_query_var('paged-byt');

            } else {

                $paged = 1;

            }



            $posts_per_page = $bookyourtravel_theme_globals->get_locations_archive_posts_per_page();



            $args = array(

                'posts_per_page' => $posts_per_page,

                'paged' => $paged,

                'category' => '',

                'orderby' => 'title',

                'order' => 'ASC',

                'post_type' => 'location',

                'post_status' => 'publish');



            $args['post_parent'] = $post->ID;



            ?>

            <section class="full-width">

                <h1><?php echo $location_obj->get_title(); ?></h1>

                <?php

                $query = new WP_Query($args);

                ?>

                <div class="destinations">

                    <?php if ($query->have_posts()) { ?>

                        <div class="row">

                            <?php

                            while ($query->have_posts()) {

                                global $post, $item_class;

                                $query->the_post();

                                $item_class = 'one-fourth';

                                get_template_part('includes/parts/location', 'item');

                            } // end while ($query->have_posts()) ?>

                        </div>

                        <nav class="page-navigation bottom-nav">

                            <!--back up button-->

                            <a href="#" class="scroll-to-top"

                               title="<?php esc_attr_e('Back up', 'bookyourtravel'); ?>"><?php esc_html_e('Back up', 'bookyourtravel'); ?></a>

                            <!--//back up button-->

                            <!--pager-->

                            <div class="pager">

                                <?php BookYourTravel_Theme_Utils::display_pager($query->max_num_pages, true); ?>

                            </div>

                        </nav>

                    <?php } // end if ( $query->have_posts() ) ?>

                </div>

                <!--//destinations clearfix-->

            </section>

            <?php

            wp_reset_postdata();

        }

        ?>

    </div>

<?php

} // end if



get_footer();