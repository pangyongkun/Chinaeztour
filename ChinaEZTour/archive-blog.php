<?php
/**
 * /* Template Name: Blog list
 *
 * The template for displaying the Blog list.
 *
 */
get_header();
//BookYourTravel_Theme_Utils::breadcrumbs();
get_sidebar('under-header');


global $bookyourtravel_theme_globals, $wpdb;

$page = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'paged' => $page,
    'category' => '',
    'orderby' => 'date',
    'order' => 'DESC',
    'post_type' => 'blog',
    'post_status' => 'publish'
);
if (isset($_POST['blog-key'])) {

    $prepared_statement = $wpdb->prepare('select ID from ez_posts where (post_title like %s and post_type=%s)', '%' . $_POST['blog-key'] . '%', 'blog');
    $blog_ids = $wpdb->get_col($prepared_statement);

    $args = array(
        'paged' => $page,
        'post_type' => 'blog',
        'post__in' => $blog_ids,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish'
    );
}
$query = new WP_Query($args);

?>

    <div style="margin-top: -20px">
        <?php
        echo do_shortcode('[rev_slider alias="Blogindex"]');

        ?>
    </div>

    <!-- Page-->
    <link rel="stylesheet" href="/css/style.css">
    <div class="page text-center">
        <!-- Page Head-->

        <!-- Page Contents-->
        <main class="page-content">
            <!-- Modern Blog-->

            <section class="section-40 bg-catskill">
                <div class="shell-wide">
                    <div class="range range-xs-center">
                        <div class="cell-md-10 cell-lg-8 cell-xl-5">

                            <?php
                            while ($query->have_posts()):
                                $query->the_post();

                                //search thumbnail
                                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                                $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
                                if ($thumbnail[0] == null || $thumbnail[0] == '') {
                                    $thumbnail[0] = home_url() . '/skin/img.jpg';
                                }
                                ?>
                                <!-- Blog Modern-->
                                <div class="post-modern-timeline-date text-sm-left">
                                    <div class="reveal-inline-block text-center">
                                        <time datetime="2016-01-01"
                                              class="text-regular text-darker"><?php echo get_the_time('Y-m-d') ?> <br
                                                class="veil reveal-md-inline-block">
                                            at <?php echo get_the_time('G:i:s') ?></time>
                                    </div>
                                </div>
                                <!-- Post Modern Timeline-->
                                <article class="post post-modern post-modern-timeline post-modern-timeline-left">
                                    <!-- Post media-->
                                    <header class="post-media"><img width="570" height="400"
                                                                    data-original="<?php echo $thumbnail[0];?>" alt=""
                                                                    class="img-responsive img-cover lazy">
                                    </header>
                                    <!-- Post content-->
                                    <section class="post-content text-left">
                                        <div class="post-modern-classic-meta"><a href="#"><span
                                                    class="icon text-middle icon icon-xxs icon-extra-small mdi fa-camera text-orange-peel"></span><span
                                                    class="text-middle text-darker text-bold">Photos</span></a></div>
                                        <!-- Post Title-->
                                        <div class="post-title offset-top-8">
                                            <h4 class="text-bold"><a
                                                    href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                            </h4>
                                        </div>
                                        <ul class="list list-inline text-darker offset-top-10">
                                            <li><a href="<?php echo get_the_permalink(); ?>">
                                                    <?php echo count(get_comments('post_id=' . get_the_ID()));
                                                    ?> Comments</a></li>
                                        </ul>
                                        <!-- Post Body-->
                                        <div class="post-body offset-top-20">
                                            <div class="offset-top-20">
                                                <p><?php echo substr(get_the_excerpt(), 0, 100) ?></p>
                                            </div>
                                        </div>
                                        <div class="post-author hidden-xs">
                                            <div class="post-author-img ">
                                                <div class="img-circle">
                                                    <?php echo get_avatar(get_the_author_meta('ID')); ?>
                                                </div>
                                            </div>
                                            <div class="post-author-name text-middle"><?php echo get_the_author(); ?>
                                            </div>
                                        </div>
                                    </section>
                                </article>
                                <!-- Post Modern Timeline-->
                            <?php endwhile;
                            wp_reset_postdata(); ?>

                            <nav class="page-navigation bottom-nav">
                                <a href="#" class="scroll-to-top"
                                   title="<?php esc_attr_e('Back up', 'bookyourtravel'); ?>"><?php esc_html_e('Back up', 'bookyourtravel'); ?></a>

                                <div class="pager">
                                    <?php
                                    BookYourTravel_Theme_Utils::display_pager($query->max_num_pages);
                                    ?>
                                </div>
                            </nav>

                            <!--//bottom navigation-->
                        </div>
                        <div class="cell-sm-10 cell-md-8 cell-lg-3 offset-top-66 offset-md-top-90 offset-lg-top-0">
                            <div class="blog-grid-sidebar inset-xl-left-80">
                                <!-- Aside-->
                                <aside class="text-left">
                                    <!-- Search in Blog-->
                                    <div>
                                        <h4 class="text-bold">Search in Blog</h4>
                                    </div>
                                    <div class="offset-top-10">
                                        <div class="hr bg-gray"></div>
                                    </div>
                                    <div class="offset-top-13 offset-md-top-20 rd-search-blog">
                                        <form id="searchform" action="<?php bloginfo('home'); ?>/blog-search"
                                              method="post" class="form-search rd-search">
                                            <div class="form-group">
                                                <label for="blog-classic-form-search-widget"
                                                       class="form-label form-search-label rd-input-label"></label>
                                                <input type="text" id="blog-classic-form-search-widget" name="blog-key"
                                                       autocomplete="off" class="form-search-input form-control null">
                                            </div>
                                            <button type="submit" class="form-search-submit" id="searchsubmit"><span
                                                    class="fa fa-search"></span></button>
                                        </form>
                                    </div>

                                    <!-- Categories-->
                                    <div class="offset-top-30 offset-md-top-63">
                                        <h4 class="text-bold">Categories</h4>
                                    </div>
                                    <div class="offset-top-10">
                                        <div class="hr bg-gray"></div>
                                    </div>
                                    <div class="offset-top-13 offset-md-top-20">
                                        <div class="inset-xs-left-5">
                                            <!-- List Marked-->
                                            <ul class="list list-marked list-marked-icon text-dark">
                                                <?php
                                                $categories = get_categories(array('type' => 'blog', 'taxonomy' => 'blog_category'));

                                                foreach ($categories as $category) {

                                                    ?>
                                                    <li><a href="<?php echo get_category_link($category->cat_ID); ?>"
                                                           class="text-atlantis"><?php echo $category->name ?></a></li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Recent Posts-->
                                    <div class="offset-top-30 offset-md-top-63">
                                        <h4 class="text-bold">Recent Posts</h4>
                                    </div>
                                    <div class="offset-top-10">
                                        <div class="hr bg-gray"></div>
                                    </div>
                                    <div class="offset-top-13 offset-md-top-20">
                                        <div class="inset-xs-left-5">
                                            <!-- List Marked-->
                                            <ul class="list list-marked list-marked-icon text-dark">
                                                <?php
                                                $args = array(
                                                    'category' => '',
                                                    'orderby' => 'date',
                                                    'order' => 'DESC',
                                                    'post_type' => 'blog',
                                                    'post_status' => 'publish',
                                                    'posts_per_page' => 10
                                                );
                                                $query = new WP_Query($args);
                                                while ($query->have_posts()):
                                                    $query->the_post();

                                                    ?>

                                                    <li><a href="<?php echo get_the_permalink(); ?>"
                                                           class="text-atlantis"><?php echo get_the_title(); ?></a></li>
                                                <?php endwhile;
                                                wp_reset_postdata(); ?>

                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Tags-->
                                    <div class="offset-top-30 offset-md-top-63">
                                        <h4 class="text-bold">Tags</h4>
                                    </div>
                                    <div class="offset-top-10">
                                        <div class="hr bg-gray"></div>
                                    </div>
                                    <div class="offset-top-13 offset-md-top-20">
                                        <div class="group group-sm offset-top-23">
                                            <?php
                                            $blog_tags = get_categories(array('type' => 'blog', 'taxonomy' => 'blog_tag', 'hide_empty' => 0));


                                            foreach ($blog_tags as $category) {

                                                ?>
                                                <a href="<?php echo get_category_link($category->cat_ID); ?>"
                                                   class="btn-tag btn btn-orange-peel btn-orange-peel-transparent"><?php echo $category->name ?></a>
                                            <?php } ?>
                                        </div>

                                        <!-- Location-->
                                        <!--<div class="offset-top-30 offset-md-top-63">
                                            <h4 class="text-bold">Search blog by Locations</h4>
                                        </div>
                                        <div class="offset-top-10">
                                            <div class="hr bg-gray"></div>
                                        </div>
                                        <div class="offset-top-13 offset-md-top-20">
                                            <div class="group group-sm offset-top-23">
                                                <?php
                                        /*                                                $blog_tags=get_categories(array('type'=>'blog','taxonomy'=> 'blog_tag','hide_empty'=>0));



                                                                                        foreach ($blog_tags as $category) {

                                                                                            */ ?>
                                                    <a href="#" class="btn-tag btn btn-orange-peel btn-orange-peel-transparent"><?php /*echo $category->name */ ?></a>
                                                <?php /*} */ ?>
                                            </div>
                                    </div>-->
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>
        <!-- Page Footer-->
        <!-- Footer Default-->

    </div>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#slider-overlay').remove();
        });
    </script>

<?php
get_footer();