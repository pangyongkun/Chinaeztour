<?php
/**
 * Category Template:Culture
 */

get_header();
BookYourTravel_Theme_Utils::breadcrumbs();

global $wp_query;
$cat_ID = get_query_var('cat');

$category=get_category($cat_ID);
echo $category->name;

if (function_exists('get_tax_image_urls'))
    $img_urls = get_tax_image_urls($cat_ID ,'full');
foreach($img_urls as $img_url){
    echo $img_url;
}

get_footer();