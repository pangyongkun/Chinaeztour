<?php
/**
 * /* Template Name: FAQ list
 *
 * The template for displaying the FAQ list.
 *
 */
get_header();
//BookYourTravel_Theme_Utils::breadcrumbs();
get_sidebar('under-header');

$args=array(
    'type'=>'post',
    'hide_empty'=> 1,
    'taxonomy'=> 'faq_category',
);

$categories = get_categories( $args );
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
                            <?php
                            foreach($categories as $category){

                            ?>
                            <!-- Classic Accordion-->
                            <div class="text-left" style="margin-top:40px"><h4  id="<?php echo $category->slug ?>"><?php echo $category->name ?> </h4></div>
                            <div data-type="accordion" class="responsive-tabs responsive-tabs-classic">
                                <?php
                                $args = array(
                                    'post_type' => 'faq',
                                    'posts_per_page'=>100,
                                    'tax_query'=>array(
                                        array(
                                            'taxonomy' => 'faq_category',
                                            'field' => 'slug',
                                            'terms' => $category->slug
                                        )
                                    )
                                );
                                $query = new WP_Query($args);
                                ?>
                                <ul data-group="accordion-modern" class="resp-tabs-list accordion-modern">
                                    <?php
                                    while ($query->have_posts()):
                                        $query->the_post();
                                        echo '<li>'.get_the_title().'</li>';
                                        endwhile
                                    ?>

                                </ul>
                                <div data-group="accordion-modern" class="resp-tabs-container accordion-modern">
                                    <?php
                                    while ($query->have_posts()):
                                        $query->the_post();
                                        echo '<div><p>'.get_the_content().'</p></div>';
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>

                                </div>
                            </div>
                            <?php } ?>
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
                                            foreach ($categories as $category) {
                                            ?>
                                                <li><a href="#<?php echo $category->slug ?>" class="text-atlantis"><?php echo $category->name ?></a></li>
                                            <?php } ?>

                                            </ul>
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
    <script src="/js/core.min.js"></script>
    <script src="/js/script.js"></script>
    
<?php
get_footer();