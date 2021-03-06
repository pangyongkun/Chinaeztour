<?php
/*	Template Name: Byt Home page
* The Front Page template file.
*
* This is the template of the page that can be selected to be shown as the front page.
*
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @package WordPress
* @subpackage BookYourTravel
* @since Book Your Travel 1.0
*/
global $bookyourtravel_theme_globals, $post, $item_class;

$page_id = $post->ID;
$page_custom_fields = get_post_custom($page_id);

$page_sidebar_positioning = null;
if (isset($page_custom_fields['page_sidebar_positioning'])) {
    $page_sidebar_positioning = $page_custom_fields['page_sidebar_positioning'][0];
    $page_sidebar_positioning = empty($page_sidebar_positioning) ? '' : $page_sidebar_positioning;
}

$section_class = 'full-width';
$item_class = 'one-fourth';
if ($page_sidebar_positioning == 'both') {
    $section_class = 'one-half';
    $item_class = 'one-half';
} else if ($page_sidebar_positioning == 'left' || $page_sidebar_positioning == 'right') {
    $section_class = 'three-fourth';
    $item_class = 'one-third';
    }

    get_header();
    get_sidebar('under-header');

    $allowed_tags = array();
    $allowed_tags['span'] = array('class' => array());
    ?>

<link href="/js/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="/js/select2/dist/js/select2.min.js"></script>

<style>
    .select2-results__option{
        text-align: left;
    }
</style>

    <div class="wrap" style="position:relative;margin: 0 auto;">
        <section class="home-content-sidebar hidden-xs"
                 style="width:1170px;position: absolute;top: -300px;z-index: 100;left: 0px; text-align:left">
            <script>

                window.searchWidgetPricePerPersonLabel = "Price per person";
                window.searchWidgetPricePerNightLabel = "Price per night";
                window.searchWidgetPricePerDayLabel = "Price per day";

            </script>
            <article class="refine-search-results byt_search_widget BookYourTravel_Search_Widget">
                <form class="widget-search" method="get" action="/search-results">
                    <div class="bootstrap">

                        <div class="row">
                                <div style="margin-top: 10px;">
                                <div class="one-sixth left" style="margin-left: 30px">
                                    <p>Tour type:</p>
                                    <input type="hidden" id="what" name="what" value="3" />
                                    <?php
                                    $args = array(
                                        'taxonomy' => 'tour_type',
                                        'hide_empty' => '0'
                                    );
                                    $tour_types = get_categories($args);
                                    foreach($tour_types as $tour_type){
                                    ?>

                                    <div class="checkbox remove-disabled">
                                        <label>
                                            <input type="checkbox"  name="tour_types[]" value="<?php echo $tour_type->term_id ?>" disabled="false">
                                        </label>
                                        <?php echo $tour_type->name ?>
                                    </div>
                                    <?php  } ?>

                                    </div>
                                <div class="one-fourth">
                                    <p>Travel Via:</p>
                                    <label for="id_label_go_thought_cities">
                                        <select name="l[]" class="go-through-city js-states form-control" id="id_label_go_thought_cities" multiple="multiple" style="width: 260px;">

                                        </select>
                                    </label>
                                </div>
                                    <div class="one-fourth">
                                        <p>By:</p>
                                        <label for="id_label_tour_budget">
                                            <select class="tour-budget js-states form-control" id="id_label_tour_budget" name="price[]" style="width:200px">
                                                <option value="0">Tour Budget</option>
                                                <option value="1">0 - 409 $</option>
                                                <option value="2">500 - 999 $</option>
                                                <option value="3">1000 - 1499 $</option>
                                                <option value="4">1500 - 1999 $</option>
                                                <option value="5">2000 - 2499 $</option>
                                                <option value="6">2500 - 2999 $</option>
                                                <option value="7">3000 $ +</option>
                                            </select>
                                        </label>
                                        <label for="id_label_start_city">
                                            <select class="start-city js-states form-control" id="id_label_start_city" style="width:200px" name="start_city[]" >
                                            </select>
                                        </label>
                                    </div>
                                <div class="one-fourth">
                                    <p>Start Date:</p>
                                    <input name="from" type="text" id="datepicker" style="width:200px" placeholder="Start Date">
                                    <input type="submit" value="Search Tours" id="search-submit" style="margin: 5px 0px 0px 80px;">

                                </div>

                            </div>

                        </div>

                    </div>
                </form>
            </article>

        </section>
        <div class="home-about-content"><h2>About ChinaEZTOUR</h2>

            <p>Welcome to "EZ Tour" Shanghai Ez International Travel Service Co.,LTD (L-SH-01704) is approved
                by the Shanghai Tourism Bureau and registered with the Industrial and Commercial Bureau of Pudong New
                District, we have met and continue to meet the quality and guarantee specifications as a tourism
                enterprise and as such are fully certified.China EZ Tour is a Shanghai based tour operator offering
                exclusive China city tours and specially designed tours covering travel all around China. We provide
                comprehensive travel solutions for our travellers to meet all wants/needs, we offer you trips to match
                your specifications, any length of time,requirements or objectives to ensure that all your travel
                pursuits are satisfied. This is why we never flaunt thecheapest price, as we want to ensure your every
                comfort is taken care of to guarantee the best possible experience. EZ Tour will make your experience in
                China DIFFERENT.&quot; <a href="/about"><b>Read More..</b></a></p>
        </div>
    </div>
    <div class="home-search-bg"></div>
    <div>
        <div class="wrap">
            <!--main content-->
            <div class="row">
                <?php
                if ($page_sidebar_positioning == 'both' || $page_sidebar_positioning == 'left')
                    get_sidebar('left');
                ?>
                <section class="<?php echo esc_attr($section_class); ?>">
                    <?php
                    if (have_posts()) { ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <article <?php post_class(); ?> id="page-<?php the_ID(); ?>">
                                <?php the_content(wp_kses(__('Continue reading <span class="meta-nav">&rarr;</span>', 'bookyourtravel'), $allowed_tags)); ?>
                                <?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
                            </article>
                        <?php endwhile;
                    }
                    get_sidebar('home-content');
                    get_sidebar('home-footer');
                    ?>
                </section>
                <?php
                if ($page_sidebar_positioning == 'both' || $page_sidebar_positioning == 'right')
                    get_sidebar('right');
                ?>
            </div>
        </div>
    </div>
    <div class="clearfix home-why">
        <div class="wrap">
            <h2>Why Travel with US?</h2>

            <p>The Best Services For Your Holiday</p>
            <section class="one-fourth fd-column">
                <div class="featured-dest">
                            <span class="fd-image">
                                <img class="img-circle lazy"  data-original="/wp-content/themes/ChinaEZTour/images/featured-image-3.jpg"
                                     alt="Featured Destination">
                            </span>

                    <h3>Easy Trip Planning</h3>

                    <p>Lots of useful, well-informed tips and guidance, hassles taken out</p>
                    <span><a class="gradient-button clearfix" href="#" title="View Details">View Details</a></span>
                </div>
            </section>
            <section class="one-fourth fd-column">
                <div class="featured-dest">
                            <span class="fd-image">
                                <img class="img-circle lazy"
                                     data-original="/wp-content/themes/ChinaEZTour/images/featured-image-4.jpg"
                                     alt="Featured Destination">
                            </span>

                    <h3>Expert Customizing</h3>

                    <p>17 years’ experience tailoring to individual needs, always flexible</p>
                    <span><a class="gradient-button clearfix" href="#" title="View Details">View Details</a></span>
                </div>
            </section>
            <section class="one-fourth fd-column">
                <div class="featured-dest">
                            <span class="fd-image lazy">
                                <img class="img-circle lazy" data-original="http://holidayamalfi.com/img/featured-image-1.jpg"
                                     alt="Featured Destination">
                            </span>

                    <h3>Guaranteed Standards</h3>

                    <p>Big brand western-level service, great reviews</p>
                    <span><a class="gradient-button clearfix" href="#" title="View Details">View Details</a></span>
                </div>
            </section>
            <section class="one-fourth fd-column">
                <div class="featured-dest">
                            <span class="fd-image">
                                <img class="img-circle lazy"
                                     data-original="/wp-content/themes/ChinaEZTour/images/featured-image-2.jpg"
                                     alt="Featured Destination">
                            </span>

                    <h3>Make friends</h3>

                    <p>Our itineraries are allow you to become as involved as possible</p>
                    <span><a class="gradient-button clearfix" href="#" title="View Details">View Details</a></span>
                </div>
            </section>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="clearfix home-blog">
        <div class="wrap">
            <h2 class="text-center">EZ Blog</h2>

            <p class="text-center" style="padding-bottom: 20px">Plan and blog your travel,Subscribe for more
                inspiring stories, advice and insight from the internet's best travel bloggers</p>
            <?php

            /*blog list*/
            $args = array(
                'post_type' => 'blog',
                'meta_query' => array(
                    array(
                        'key' => 'blog_is_featured',
                        'value' => 1,
                        'compare' => '='
                    ),
                )
            );
            $query = new WP_Query($args);

            while ($query->have_posts()):
                $i = 1;
                $query->the_post();
                $comments = get_comments('post_id=' . get_the_ID());
                $comments_count = count($comments);

                //search thumbnail
                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
                if ($thumbnail[0] == null || $thumbnail[0] == '') {
                    $thumbnail[0] = home_url() . '/skin/img.jpg';
                }
                if ($i == 1) {
                    ?>
                    <div class="one-half">
                        <div>
                            <div>
                                <div style="position: relative; height: 500px;">

                                    <div style="box-sizing: border-box; position: absolute; left: 0px; top: 0px;"
                                         class="">

                                        <a href="<?php echo get_the_permalink(); ?>"
                                           class="nicdark_marginleft10 nicdark_displaynone_responsive nicdark_btn nicdark_bg_white medium grey nicdark_absolute"><?php echo get_the_time('j'); ?><br>
                                            <small><?php echo get_the_time('F') ?></small>
                                        </a>

                                        <div class="nicdark_featured_image"><img alt=""  class="lazy" data-original="<?php echo $thumbnail[0]; ?>">
                                        </div>
                                        <div class="nicdark_textevidence nicdark_bg_greydark ">
                                            <h4 class="white over-hide"><?php echo substr(get_the_title(),0, 60).(strlen(get_the_title())<60?"":"..."); ?></h4>
                                        </div>
                                        <div class="nicdark_focus nicdark_bg_orangedark">
                                            <div
                                                class="nicdark_bg_orange nicdark_focus nicdark_padding1020  nicdark_width_percentage50">
                                                <p class="white"><i class="icon-user"></i> <?php the_author(); ?></p>
                                            </div>
                                            <div class="nicdark_focus nicdark_padding1020  nicdark_width_percentage50">
                                                <p class="white"><i
                                                        class="icon-chat"></i> <?php echo $comments_count == 0 ? 'No' : $comments_count; ?>
                                                    Comments</p>
                                            </div>
                                        </div>
                                        <div class="nicdark_focus nicdark_border_grey  nicdark_padding20">
                                            <p><?php echo substr(get_the_excerpt(), 0, 200) . '...' ?></p>

                                            <div class="nicdark_space20"></div>
                                            <a class="nicdark_btn nicdark_press nicdark_bg_orange white medium"
                                               href="<?php echo get_the_permalink(); ?>">READ
                                                MORE</a>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php };
                break; endwhile; ?>



            <div class="one-half hidden-xs">
                <div>
                    <div>
                        <div style="position: relative; height: 472px;">
                            <?php
                            $i = 1;
                            while ($query->have_posts()):
                                $query->the_post();
                                $comments = get_comments('post_id=' . get_the_ID());
                                $comments_count = count($comments);

                                //search thumbnail
                                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                                $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
                                if ($thumbnail[0] == null || $thumbnail[0] == '') {
                                    $thumbnail[0] = home_url() . '/skin/img.jpg';
                                }
                                ?>

                                <?php if ($i == 2) { ?>

                                <div style="position: absolute; left: 0px; top: 0px;">

                                    <div
                                        style="background:url(<?php echo $thumbnail[0]; ?>);"
                                        class="nicdark_focus nicdark_contain">

                                        <a href="<?php echo get_the_permalink(); ?>"
                                           class="nicdark_marginleft10 nicdark_displaynone_responsive nicdark_btn nicdark_bg_white medium grey nicdark_absolute"><?php echo get_the_time('j'); ?><br>
                                            <small><?php echo get_the_time('F'); ?></small>
                                        </a>

                                        <div
                                            class="nicdark_displaynone_responsive nicdark_width_percentage40 nicdark_focus">
                                            <div class="nicdark_space1"></div>
                                        </div>

                                        <div
                                            class="nicdark_width100_responsive nicdark_width_percentage60 nicdark_float_right nicdark_bg_white nicdark_border_grey ">
                                            <div
                                                class="nicdark_textevidence nicdark_bg_grey nicdark_borderbottom_grey">
                                                <h4 class="grey nicdark_margin20 "><?php echo substr(get_the_title(),0, 20).(strlen(get_the_title())<20?"":"..."); ?></h4>
                                            </div>
                                            <div class="nicdark_margin20">
                                                <p><?php echo substr(get_the_excerpt(), 0, 100); ?></p>

                                                <div class="nicdark_space20"></div>
                                                <a class="nicdark_btn nicdark_press nicdark_bg_green white small"
                                                   href="<?php echo get_the_permalink(); ?>">READ MORE</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>

                                <?php if ($i == 3) { ?>
                                <div style="position: absolute; left: 0px; top: 236px;">

                                    <div
                                        style="background:url(<?php echo $thumbnail[0]; ?>);"
                                        class="nicdark_focus nicdark_contain">

                                        <a href="<?php echo get_the_permalink(); ?>"
                                           class="nicdark_marginleft10 nicdark_displaynone_responsive nicdark_btn nicdark_bg_white medium grey nicdark_absolute">15<br>
                                            <small><?php echo get_the_time('F') ?></small>
                                        </a>

                                        <div
                                            class="nicdark_displaynone_responsive nicdark_width_percentage40 nicdark_focus">
                                            <div class="nicdark_space1"></div>
                                        </div>

                                        <div
                                            class="nicdark_width100_responsive nicdark_width_percentage60 nicdark_float_right nicdark_bg_white nicdark_border_grey ">
                                            <div class="nicdark_textevidence nicdark_bg_grey nicdark_borderbottom_grey">
                                                <h4 class="grey nicdark_margin20 "><?php echo substr(get_the_title(),0, 20).(strlen(get_the_title())<20?"":"..."); ?></h4>
                                            </div>
                                            <div class="nicdark_margin20">
                                                <p><?php echo substr(get_the_excerpt(), 0, 100) ?></p>

                                                <div class="nicdark_space20"></div>
                                                <a class="nicdark_btn nicdark_press nicdark_bg_green white small  "
                                                   href="<?php echo get_the_permalink(); ?>">READ
                                                    MORE</a>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            <?php } ?>

                                <?php $i++; endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>

    <div id="show-cities" class="row" style="width:60%;position:absolute;top:600px;left:20%; right:20%;text-align: left; z-index: 999; background-color: #f5f8ff;display: none">

        <ul class="row" style="margin: 10px" id="list-cities">
        </ul>
        <input id="hide-cities" type="button" value="OK" >
    </div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $(".start-city").select2({
                placeholder: 'Start City',
                ajax: {
                    url: "/wp-json/myplugin/v1/location",
                    method:'post',
                    ataType:'json',
                    data: function (params) {
                        var query = {
                            keyword: params.term
                        }
                        return query;
                    },
                    processResults: function (data) {
                        var locations=[];
                        $.each(data,function(index,content){
                            locations.push(
                                {
                                    id:content.ID,
                                    text:content.post_title
                                }
                            )
                        })
                        return {
                            results: locations
                        };
                    }
                }
            });
        $(".go-through-city").select2({
                placeholder: 'Choose Cities',
                ajax: {
                    url: "/wp-json/myplugin/v1/location",
                    method:'post',
                    dataType:'json',
                    data: function (params) {
                        var query = {
                            keyword: params.term
                        }
                        return query;
                    },
                    processResults: function (data) {
                        var locations=[];
                        $.each(data,function(index,content){
                            locations.push(
                                {
                                    id:content.ID,
                                    text:content.post_title
                                }
                            )
                        })
                        return {
                            results: locations
                        };
                    }
                }
            })
        $(".tour-budget").select2({
            placeholder: 'Tour Budget'
        });
        $("#datepicker").datepicker();

        $('.remove-disabled').mouseover(function () {
            $('input[type="checkbox"]').removeAttrs('disabled');
        })


    });

</script>



<?php
get_footer();