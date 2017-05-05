<?php
/*

Template Name: Post

*/

?>
<?php
get_header();

global  $wp_rewrite, $wp_query;
$show_map=false;
$category = get_query_var('category');
$location_id = $wp_query->query_vars['location'];

$nav=array();
$title=$category;
$link=home_url(add_query_arg(array(),$wp->request));
array_push($nav,array(
    'title'=>$title,
    'link'=>$link
));

$title=get_the_title($location_id);
$link=get_permalink($location_id);
array_push($nav,array(
    'title'=>$title,
    'link'=>$link
));

$parent_ID=wp_get_post_parent_id($location_id);
while($parent_ID){
    $title=get_the_title($parent_ID);
    $link=get_permalink($parent_ID);
    array_push($nav,array(
        'title'=>$title,
        'link'=>$link
    ));
    $parent_ID=wp_get_post_parent_id($parent_ID);
}

?>
<!--nav-->
    <nav role="navigation" class="breadcrumbs">
        <ul>
            <li><a href="<?php echo home_url(); ?>" title="Home">Home</a></li>
            <?php
            for($i=count($nav)-1;$i>=0;$i--){
                echo "<li>";
                echo "<a href='".$nav[$i]['link']."'>";
                echo $nav[$i]['title'];
                echo "</a>";
                echo "</li>";
            }

            ?>
        </ul>
    </nav>
<!--/nav-->

<?php
/*查询文章列表*/
    $args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => 40,
        'meta_query' => array(
            'meta_key' => '_post_location',
            'meta_value' => $location_id,
            'compare' => '='
        )
    );
    $query = new WP_Query($args);
?>
    <script>
        window.itemClass = "one-third";
    </script>
    <section class="three-fourth">
        <?php echo get_post_meta($location_id,'location_'.$category,true);?>
        <div class="sort-by">
            <h3>List Style</h3>
            <ul class="view-type">
                <script>
                    window.defaultResultsView = 0;
                </script>
                <li class="grid-view"><a href="#" title="grid view">grid view</a></li>
                <li class="list-view active"><a href="#" title="list view">list view</a></li>
            </ul>
        </div>
            <div class="deals">
            <!--deal-->
            <div class="row">
                <!--tour item-->

                <?php while ($query->have_posts()):
                    $query->the_post(); ?>
                <article class="tour_item full-width">
                    <div>
                        <figure>
                            <?php the_post_thumbnail('featured', array('title' => '')); ?>
                        </figure>
                        <div class="details">
                            <h3><?php the_title(); ?></h3>
                            <div class="price"><a href="<?php echo esc_url(get_the_permalink()) ?>" class="gradient-button clearfix">More info</a>
                            </div>
                            <div class="description clearfix"><?php echo substr(get_the_excerpt(),0,200).'..'; ?></div></div>
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
    </section>

<?php
wp_reset_postdata();

echo '<div id="slider-guide">';
include('right_siderbar.php');
get_sidebar('right');
echo '</div>';

get_footer();

