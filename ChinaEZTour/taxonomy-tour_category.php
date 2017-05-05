<?php
/*

Template Name: Post

*/

?>
<?php
get_header();
BookYourTravel_Theme_Utils::breadcrumbs();
global $wp_rewrite, $wp_query,$bookyourtravel_tour_helper;
$show_map = false;
$show_tour_category=true;

$current_category = single_cat_title("", false);
$cat=get_term_by('name',$current_category,'tour_category');
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;

?>

<div class="clearfix">
    <h2 class="main-title-lefticon" style="width:400px"><?php echo $cat->name ?></h2>
    <div class="tips">
    <?php
    echo $cat->description;
    ?>
    </div>
</div>

<?php
/*query tour by tour category*/
$args = array(
    'paged' => $page,
    'orderby' => 'date',
    'post_type' => 'tour',
    'tax_query'=>array(
        array(
            'taxonomy' => 'tour_category',
            'field' => 'slug',
            'terms' => $cat->slug
        )
    )

);
$query = new WP_Query($args);
?>
    <script>
        window.itemClass = "one-third";
    </script>
    <section class="three-fourth">
        <div class="woocommerce-tabs">
            <div class="deals">
                <!--deal-->
                <div class="row">
                    <!--tour item-->

                    <?php while ($query->have_posts()):
                        $query->the_post();
                        $tour_location=get_post_meta(get_the_ID(),'locations',true);
                        $tour_schedule=$bookyourtravel_tour_helper->list_tour_schedules(null,1,'Id','ASC',0,0,0,get_the_ID() );
                        ?>
                        <article class="tour_item full-width">
                            <div>
                                <figure>
                                    <?php the_post_thumbnail('featured', array('title' => '')); ?>
                                </figure>
                                <div class="details">
                                    <h3><?php the_title(); ?></h3>
                                    <span class="address">
                                        <?php
                                        $locations=get_post_meta(get_the_ID(),'locations',true);
                                        if($locations!=null){
                                            foreach($locations as $location){
                                                echo get_the_title($location).' ';
                                            }
                                        }

                                        ?>
                                    </span>
                                    <span class="days hidden-xs"><?php echo $tour_schedule['results'][0]->duration_days ?> Days</span>

                                    <div class="price hidden-xs"><span class="price-num">$<?php echo $tour_schedule['results'][0]->price ?></span>Price From<a
                                            href="<?php echo esc_url(get_the_permalink()) ?>"
                                            class="gradient-button clearfix">Details</a>
                                    </div>
                                    <div
                                        class="description clearfix"><?php echo substr(get_the_excerpt(), 0, 170) . '..'; ?></div>
                                </div>
                            </div>
                        </article>
                    <?php endwhile ?>
                    <!--//tour item-->
                </div>
                <nav class="page-navigation bottom-nav">
                    <!--back up button-->
                    <a href="#" class="scroll-to-top" title="Back up">Back up</a>
                    <!--//back up button-->
                    <div class="pager">
                    </div>
                </nav>
            </div>
        </div>

    </section>

<?php
wp_reset_postdata();
?>
<?php
echo '<div id="slider-guide">';
include('custom/right_siderbar.php');
get_sidebar('right');
echo '</div>';
get_footer();

