<?php
require_once ('functions/products.php');

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

/**
 * Remove WordPress Toolbar for users not allowed to publish posts
 *
 * @param bool $show_admin_bar Whether the admin bar should be shown
 */

/*Disable wp admin bar for this user, using code.*/

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if ($user_id=2) {
  show_admin_bar(false);
}
}




/*function custom_conference_in_home_loop( $query ) { if ( is_home() && $query->is_main_query() ) $query->set( 'post_type', array( 'post', 'products') ); return $query; } add_filter( 'pre_get_posts', 'custom_conference_in_home_loop' );*/

/*Add a custom address bar color for mobile browsers.*/

function address_mobile_address_bar() {
	$color = "#008509";
	//this is for Chrome, Firefox OS, Opera and Vivaldi
	echo '<meta name="theme-color" content="'.$color.'">';
	//Windows Phone **
	echo '<meta name="msapplication-navbutton-color" content="'.$color.'">';
	// iOS Safari
	echo '<meta name="apple-mobile-web-app-capable" content="yes">';
	echo '<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">';
	
}
add_action( 'wp_head', 'address_mobile_address_bar' );


/*Display these Products on the homepage */

add_filter( 'pre_get_posts', 'my_get_posts' );

function my_get_posts( $query ) {

	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'products' ) );

	return $query;
}
/*s
function sc_liste($atts, $content = null) {
        extract(shortcode_atts(array(
                "num" => '5',
                "cat" => ''
        ), $atts));
        global $post;
        $myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date&category='.$cat);
        $retour='<ul>';
        foreach($myposts as $post) :
                setup_postdata($post);
             $retour.='<li><a href="'.get_permalink().'">'.the_title("","",false).'</a></li>';
        endforeach;
        $retour.='</ul> ';
        return $retour;
}
add_shortcode("list", "sc_liste");*/