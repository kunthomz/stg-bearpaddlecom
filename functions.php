<?php
/**
 * Jupiter X Framework.
 * This core file should only be overwritten via your child theme.
 *
 * We strongly recommend to read the Jupiter documentation to find out more about
 * how to customize the Jupiter theme.
 *
 * @author JupiterX
 * @link   https://artbees.net
 * @package JupiterX\Framework
 */

/**
 * Initialize Jupiter theme framework.
 *
 * @author JupiterX
 * @link   https://artbees.net
 */

require_once dirname( __FILE__ ) . '/lib/init.php';
require_once('functions_GR.php');

add_shortcode('featured_img', 'fi_in_content');

function fi_in_content($atts) {
    global $post;
    return get_the_post_thumbnail($post->ID);
}

function wpc_elementor_shortcode( $atts ) {
	
	$menuLocations = get_nav_menu_locations();
	$primaryNavItems = wp_get_nav_menu_items(37);
	
	$menuParentsID = array();
	$menuParentsName = array();
	foreach ($primaryNavItems as $menuItem) {
		if (
			$menuItem->post_parent == 0 &&
			$menuItem->menu_item_parent == 0
		) {
			if (
				$menuItem->object_id != 895 && 
				$menuItem->title != "Login" &&
				$menuItem->title != "Careers" &&
				$menuItem->object_id != 134
			) {
				array_push($menuParentsID, $menuItem->ID);
				array_push($menuParentsName, $menuItem->title);
			}
		}
	}
	
	$cntr = 0;
	foreach($menuParentsID as $parent) {
		
		if ($cntr == 1) {
			$loc = array(
				'post_type' => 'page',
				'post_status' => 'publish',
				'child_of' => 895
			); 
			$locations = get_pages($loc);

			if ($locations) {
				echo '<div class="sitemap-grp locations"><h3>Locations</h3><ul>';
				foreach ($locations as $location) {
					if ($location->post_parent == 895) {
						echo '<li><a href="'.get_the_permalink($location->ID).'">'.$location->post_title.'</a></li>';
					}
				}
				echo '</ul></div>';
			}
		}
		
		$class = str_replace(' ', '-', $menuParentsName[$cntr]);
		echo '<div class="sitemap-grp '.$class.'"><h3>'.$menuParentsName[$cntr].'</h3><ul>';
		foreach ($primaryNavItems as $menuItem) {
// 			echo '<pre>';
// 			print_r($menuItem);
// 			echo '</pre>';
			if ($menuItem->menu_item_parent == $parent) {
				echo '<li><a href="'.$menuItem->url.'">'.$menuItem->title.'</a></li>';
			}
		}
		echo '</ul></div>';
		$cntr++;
	}
	
	$othersarg = array(
		'meta_key' => 'add_to_sitemap_under_others',
		'meta_value' => true
	);
	$otherpages =  get_pages($othersarg);
	if ($otherpages) {
		echo '<div class="sitemap-grp others"><h3>Others</h3><ul>';
		$cnter = 0;
		foreach($otherpages as $page) {
			$title = $page->post_title == "Swim Lessons Registration" ? "Register" : $page->post_title;
			echo '<li><a href="'.get_the_permalink($page->ID).'">'.$title.'</a></li>';
			$cnter++;
		}
		echo '</ul></div>';
	}
	
// 	function getURL($defaulturl, $title) {
// 		switch ($title) {
// 			case 'Weekly Lessons' : 
// 				$url = 'https://register.bearpaddle.com/';
// 				return $url;
// 			break;
// 			case 'Swim Clinics' :
// 				$url = 'https://register.bearpaddle.com/register-for-swim-clinic/';
// 				return $url;
// 			break;
// 			default :
// 				$url = $defaulturl;
// 				return $url;
// 		}
// 	}
	
}
add_shortcode('sitemap_code', 'wpc_elementor_shortcode');

add_action('wp_enqueue_scripts', 'add_theme_script_and_styles');
function add_theme_script_and_styles() {
    wp_enqueue_style('owlcarousel-styles', get_template_directory_uri() . '/lib/assets/dist/css/owl.carousel.min.css', array(), '1', 'screen');
    wp_register_script('owlcarousel-script', get_template_directory_uri() . '/lib/assets/dist/js/owl.carousel.min.js', '', '', true); // Load in footer

    wp_enqueue_script('owlcarousel-script');

    if (is_singular('location')) {
        wp_enqueue_style('single-location-styles', get_template_directory_uri() . '/lib/css/single-location.css', array(), '1', 'screen');
    }
}
