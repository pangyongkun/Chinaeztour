<?php
/**
 * Created by PhpStorm.
 * User: kun
 * Date: 2016/8/18
 * Time: 9:12
 */


global $matches;
//为不带http的地址添加 http
function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

/********添加query变量************/
function pyk_query_vars($public_query_vars) {
    $public_query_vars[] = 'my_custom_page_type';
    $public_query_vars[] = 'category';
    $public_query_vars[] = 'location';
    $public_query_vars[] = 'paged';
    return $public_query_vars;
}

/************重写规则*************/
function pyk_rewrite_rules( $wp_rewrite ){
    $new_rules = array(
        '(.{0,})/([0-9a-zA-Z]+)/([0-9a-zA-Z]+)_([0-9]+)' => 'index.php?my_custom_page_type=list_page&category=$matches[3]&location=$matches[4]',
        'blog-search'=>'index.php?my_custom_page_type=search-blog',
        'tour-search'=>'index.php?my_custom_page_type=search-tour'
    );
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

/************模板载入规则****************/
function pyk_template_redirect(){
    global $wp,$wp_query,$wp_rewrite;
    if( !isset($wp_query->query_vars['my_custom_page_type']) )
        return;
    $reditect_page =  $wp_query->query_vars['my_custom_page_type'];
    $category=$wp_query->query_vars['category'];

    if($reditect_page=='search-blog'){
        include(get_template_directory().'/archive-blog.php');
        die();
        return;
    }

    if($reditect_page=='search-tour'){
        include(get_template_directory().'/search-tour.php');
        die();
        return;
    }

    if ($reditect_page == "list_page"){
        if($category=='tour'){
            include(get_template_directory().'/custom/list_page_tours.php');
            die();
            return;
        }else{
            include(get_template_directory().'/custom/list_page_post.php');
            die();
        }

    }
    /*if($reditect_page == "create_your_trip"){
        include(get_template_directory().'/special_topic_create_your_trip.php');
        die();
    }*/
}

/*********更新重写规则***************/
function pyk_flush_rewrite_rules() {
    global $pagenow, $wp_rewrite;

    if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
        $wp_rewrite->flush_rules();
}

add_action( 'load-themes.php', 'pyk_flush_rewrite_rules' ); //启用主题的时候
add_action('generate_rewrite_rules', 'pyk_rewrite_rules' ); //添加重写规则
add_action('query_vars', 'pyk_query_vars');
add_action("template_redirect", 'pyk_template_redirect');

