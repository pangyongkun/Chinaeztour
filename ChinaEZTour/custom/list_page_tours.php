<?php /*Template Name: Post*/ ?><? phpget_header();
global $wp_rewrite, $wp_query, $bookyourtravel_tour_helper;
$show_map = false;
$category = get_query_var('category');
$location_id = $wp_query->query_vars['location'];
$nav = array();
$title = $category;
$link = home_url(add_query_arg(array(), $wp->request));
array_push($nav, array('title' => $title, 'link' => $link));
$title = get_the_title($location_id);
$link = get_permalink($location_id);
array_push($nav, array('title' => $title, 'link' => $link));
$parent_ID = wp_get_post_parent_id($location_id);
while ($parent_ID) {
    $title = get_the_title($parent_ID);
    $link = get_permalink($parent_ID);
    array_push($nav, array('title' => $title, 'link' => $link));
    $parent_ID = wp_get_post_parent_id($parent_ID);
} ?>
    <script type="text/javascript">    jQuery(document).ready(function ($) {
            $('#tab1-content').css('display', '');
            $('#tab2-content').css('display', 'none');
            $('#tab1').bind('click', function (event) {
                $(this).parent('li').addClass('active');
                $('#tab2').parent('li').removeClass('active');
                $('#tab1-content').css('display', '');
                $('#tab2-content').css('display', 'none');
                event.preventDefault();
            });
            $('#tab2').bind('click', function (event) {
                $(this).parent('li').addClass('active');
                $('#tab1').parent('li').removeClass('active');
                $('#tab2-content').css('display', '');
                $('#tab1-content').css('display', 'none');
                event.preventDefault();
            });
        });</script>    <!--nav-->
    <nav role="navigation" class="breadcrumbs">
        <ul>
            <li><a href="<?php echo home_url(); ?>" title="Home">Home</a>
            </li> <?php for ($i = count($nav) - 1; $i >= 0; $i--) {
                echo "<li>";
                echo "<a href='" . $nav[$i]['link'] . "'>";
                echo $nav[$i]['title'];
                echo "</a>";
                echo "</li>";
            } ?>        </ul>
    </nav>    <!--/nav-->
    <div class="clearfix"><h2 class="main-title-lefticon" style="width:400px"><?php echo get_the_title($location_id); ?>
            Tours</h2>
        <div class="tips">    <?php echo get_post_meta($location_id, 'location_tours_information', true); ?>    </div>
    </div>
<?php
/*查询文章列表*/
$args = array(
    'post_type' => $category,
    'posts_per_page' => 40,
    'meta_query' => array(
        array(
            'key' => 'locations',
            'value' => serialize(strval($location_id)),
            'compare' => 'LIKE'
        )));
$query = new WP_Query($args); ?>
    <script>        window.itemClass = "one-third";    </script>
    <section class="three-fourth">
        <div class="woocommerce-tabs">
            <ul class="tabs">
                <li class="active"><a href="#" id="tab1"><?php echo get_the_title($location_id); ?> Local Tours</a></li>
                <li><a href="#" id="tab2">China Tours including <?php echo get_the_title($location_id); ?></a></li>
            </ul>
            <div class="panel entry-content" id="tab1-content">
                <div class="deals">                    <!--deal-->
                    <div class="row">
                        <!--tour item--> <?php while ($query->have_posts()): $query->the_post();
                            $tour_location = get_post_meta(get_the_ID(), 'locations', true);
                            if (count($tour_location) == 1) {
                                $tour_schedule = $bookyourtravel_tour_helper->list_tour_schedules(null, 1, 'Id', 'ASC', 0, 0, 0, get_the_ID()); ?>
                                <article class="tour_item full-width">
                                    <div>
                                        <figure>                                        <?php the_post_thumbnail('featured', array('title' => '')); ?>                                    </figure>
                                        <div class="details"><h3><?php the_title(); ?></h3>
                                            <span
                                                class="address">                                    <?php $locations = get_post_meta(get_the_ID(), 'locations', true);
                                                foreach ($locations as $location) {
                                                    echo get_the_title($location) . ' ';
                                                } ?>                                </span> <span
                                                class="days"><?php echo $tour_schedule['results'][0]->duration_days ?>
                                                Days</span>
                                            <div class="price"><span
                                                    class="price-num">$<?php echo $tour_schedule['results'][0]->price ?></span>Price
                                                From<a href="<?php echo esc_url(get_the_permalink()) ?>"
                                                       class="gradient-button clearfix">Details</a></div>
                                            <div
                                                class="description clearfix"><?php echo substr(get_the_excerpt(), 0, 170) . '..'; ?></div>
                                        </div>
                                    </div>
                                </article>                        <?php } endwhile ?> <!--//tour item-->
                    </div>
                    <nav class="page-navigation bottom-nav">                        <!--back up button--> <a href="#"
                                                                                                             class="scroll-to-top"
                                                                                                             title="Back up">Back
                            up</a>                        <!--//back up button-->
                        <div class="pager"></div>
                    </nav>
                </div>
            </div>
            <div class="panel entry-content" id="tab2-content">
                <div class="deals">                    <!--deal-->
                    <div class="row">
                        <!--tour item--> <?php while ($query->have_posts()): $query->the_post();
                            $tour_location = get_post_meta(get_the_ID(), 'locations', true);
                            if (count($tour_location) > 1) {
                                $tour_schedule = $bookyourtravel_tour_helper->list_tour_schedules(null, 1, 'Id', 'ASC', 0, 0, 0, get_the_ID()); ?>
                                <article class="tour_item full-width">
                                    <div>
                                        <figure>                                        <?php the_post_thumbnail('featured', array('title' => '')); ?>                                    </figure>
                                        <div class="details"><h3><?php the_title(); ?></h3>
                                            <span
                                                class="address">                                    <?php $locations = get_post_meta(get_the_ID(), 'locations', true);
                                                foreach ($locations as $location) {
                                                    echo get_the_title($location) . ' ';
                                                } ?>                                </span> <span
                                                class="days"><?php echo $tour_schedule['results'][0]->duration_days ?>
                                                Days</span>
                                            <div class="price"><span
                                                    class="price-num">$<?php echo $tour_schedule['results'][0]->price ?></span>Price
                                                From<a href="<?php echo esc_url(get_the_permalink()) ?>"
                                                       class="gradient-button clearfix">Details</a></div>
                                            <div
                                                class="description clearfix"><?php echo substr(get_the_excerpt(), 0, 170) . '..'; ?></div>
                                        </div>
                                    </div>
                                </article>                        <?php } endwhile; ?> <!--//tour item-->
                    </div>
                    <nav class="page-navigation bottom-nav">                        <!--back up button--> <a href="#"
                                                                                                             class="scroll-to-top"
                                                                                                             title="Back up">Back
                            up</a>                        <!--//back up button-->
                        <div class="pager"></div>
                    </nav>
                </div>
            </div>
        </div>
    </section><? phpwp_reset_postdata(); ?><? phpecho '<div id="slider-guide">';include('right_siderbar.php');get_sidebar('right');echo '</div>';get_footer();