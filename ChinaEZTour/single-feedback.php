<?php
/**
 * /* Template Name: Blog Content
 *
 *
 */
get_header();
//BookYourTravel_Theme_Utils::breadcrumbs();
get_sidebar('under-header');

?>

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
                        <!--blog content-->
                        <?php if ( have_posts() ) while ( have_posts() ) : the_post();
                            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                            $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
                            if ($thumbnail[0] == null || $thumbnail[0] == '') {
                                $thumbnail[0] = home_url() . '/skin/img.jpg';
                            }
                        ?>
                        <div class="cell-sm-10 cell-md-8" style="text-align: left;">

                            <div><span style="font-size: 20px;" class="icon text-middle icon icon-xxs mdi mdi-file-image text-orange-peel"></span>
            <span class="text-middle text-bold text-darker">Photos</span></div>
        <div class="offset-top-13">
            <h3 class="text-bold text-atlantis"><?php echo get_the_title(); ?></h3>
        </div>
        <ul class="group-lg list list-inline text-darker offset-top-23">
            <li><?php echo get_the_time('M d, Y').' at '.get_the_time(  'H:i:s'); ?></li>
            <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="text-orange-peel"><?php echo get_the_author(); ?></a></li>
            <li><a ><?php echo count(get_comments('post_id='.get_the_ID()));?> Comments</a></li>
            <li><a><?php echo get_post_meta(get_the_ID(),'email',true); ?></a></li>
            <li><a><?php echo get_post_meta(get_the_ID(),'country',true); ?></a></li>
        </ul>
        <div>
            <img class="lazy" data-original="<?php echo $thumbnail[0]; ?>" alt="">

            <?php the_content(); ?>
        </div>
        <div class="offset-top-35  clearfix" >
            <div class="pull-sm-left">
                <div class="group group-sm">
                    <?php $term_list = wp_get_post_terms(get_the_ID(), 'blog_tag', array("fields" => "all"));
                    foreach($term_list as $term){
                        echo '<a href="#" class="btn-tag btn btn-orange-peel btn-orange-peel-transparent">'.$term->name.'</a>';
                    }

                    ?>

                </div>
            </div>
            <div class="pull-sm-right">
                <div class="reveal-inline-block ">
                    <p class="text-dark">Share:</p>
                </div>
                <ul class="list-inline list-inline-2 reveal-inline-block offset-top-18 offset-sm-top-0 inset-left-12">
                    <li><a href="#"
                           class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa fa-facebook"></a>
                    </li>
                    <li><a href="#"
                           class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa fa-twitter"></a>
                    </li>
                    <li><a href="#"
                           class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa fa-google-plus"></a>
                    </li>
                    <li><a href="#"
                           class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa fa-instagram"></a>
                    </li>
                    <li><a href="#"
                           class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa fa-rss"></a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="offset-top-63">
                <h4 class="text-bold">Posted by</h4>
            </div>
            <div class="offset-top-10">
                <div class="hr bg-gray"></div>
            </div>
            <div class="offset-top-30">
                <div class="unit unit-xs unit-xs-horizontal">
                    <div class="unit-left">
                        <?php echo get_avatar(get_the_author_meta('ID')); ?>
                    </div>
                    <div class="unit-body text-xs-left">
                        <div>
                            <h6 class="text-atlantis"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_the_author(); ?></a></h6>
                        </div>
                        <div class="offset-top-4 offset-sm-top-8">
                            <h5 class="font-default text-italic"><span class="small"><span class="big text-gray">Blogger, Traveller</span></span>
                            </h5>
                        </div>
                        <div class="offset-top-10 text-left">
                            <?php echo get_the_author_meta('description'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php comments_template( '', true ); ?>


        </div>
    </div>
                        <?php endwhile; ?>
                        <!--/blog content-->
                        </div>
                        <div class="cell-sm-10 cell-md-8 cell-lg-3 offset-top-66 offset-md-top-90 offset-lg-top-0">
                            <div class="blog-grid-sidebar inset-xl-left-80">
                                <!-- Aside-->
                                <aside class="text-left">

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

                                            $categories = get_categories(array('type' => 'feedback', 'taxonomy' => 'feedback_category'));
                                            foreach ($categories as $category) {

                                                ?>
                                                <li><a href="<?php echo get_category_link( $category->cat_ID ); ?>" class="text-atlantis"><?php echo $category->name ?></a></li>
                                            <?php } ?>

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
                                        $blog_tags = get_categories(array('type' => 'feedback', 'taxonomy' => 'feedback_tag', 'hide_empty' => 0));
                                        foreach ($blog_tags as $category) {

                                            ?>
                                            <a href="#" class="btn-tag btn btn-orange-peel btn-orange-peel-transparent"><?php echo $category->name ?></a>
                                        <?php } ?>
                                        </div>
                                    </div>
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
    <!--<script src="/js/core.min.js"></script>-->
    <script src="/js/script.js"></script>

<?php
get_footer();