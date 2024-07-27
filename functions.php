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

add_shortcode('sitemap_code', 'wpc_elementor_shortcode');

add_action('wp_enqueue_scripts', 'add_theme_script_and_styles');
function add_theme_script_and_styles() {
    global $post; // Declare $post globally

    wp_enqueue_style('owlcarousel-styles', get_template_directory_uri() . '/lib/assets/dist/css/owl.carousel.min.css', array(), '1', 'screen');
    wp_register_script('owlcarousel-script', get_template_directory_uri() . '/lib/assets/dist/js/owl.carousel.min.js', '', '', true); // Load in footer

    wp_enqueue_script('owlcarousel-script');

    if ( isset($post) && $post->post_parent === 895 ) { // Check if $post is set
        wp_enqueue_style('single-location-styles', get_template_directory_uri() . '/lib/css/single-location.css', array(), '1', 'screen');
   		wp_enqueue_script('single-location-js', get_template_directory_uri() . '/lib/js/single-location.js', array(), '1', true);
		   wp_enqueue_script('single-location-js');
    	wp_enqueue_script('animejs', 'https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js', array(), '2.2.0', true);
    }
}


function acf_double_group_shortcode() {
    ob_start(); // Start output buffering

    // Define the ACF group field names
    $group_1 = 'group_1';
    $group_2 = 'group_2';
    $group_3 = 'group_3';
    $group_4 = 'group_4';
    $group_5 = 'group_5';

    $image_urls = array(
        $group_1 => array(),
        $group_2 => array(),
        $group_3 => array(),
        $group_4 => array(),
        $group_5 => array()
    );

    // Display Group 1
    if (have_rows($group_1)): ?>
        <div class="acf-group group-1 swim__lesson-section">
            <?php while (have_rows($group_1)): the_row();
                $image = get_sub_field('image');
                if ($image) {
                    $image_urls[$group_1][] = $image['url'];
                }
            ?>
                <div class="acf-item">
                    <div class="acf-image">
                        <?php if ($image): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="acf-text">
                        <h2><?php the_sub_field('title'); ?></h2>
                        <div><?php the_sub_field('content'); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;

    // Display Group 2
    if (have_rows($group_2)): ?>
        <div class="acf-group swim__lesson-section">
            <?php while (have_rows($group_2)): the_row();
                $image = get_sub_field('image');
                if ($image) {
                    $image_urls[$group_2][] = $image['url'];
                }
            ?>
                <div class="acf-item" style="display: flex; flex-direction: row-reverse;">
                    <div class="acf-image" style="flex: 1;">
                        <?php if ($image): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="acf-text" style="flex: 2;">
                        <h2><?php the_sub_field('title'); ?></h2>
                        <div><?php the_sub_field('content'); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;

    // Display Group 3
    if (have_rows($group_3)): ?>
        <div class="acf-group swim__lesson-section">
            <?php while (have_rows($group_3)): the_row();
                $image = get_sub_field('image');
                if ($image) {
                    $image_urls[$group_3][] = $image['url'];
                }
            ?>
                <div class="acf-item" style="display: flex;">
                    <div class="acf-image" style="flex: 1;">
                        <?php if ($image): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="acf-text" style="flex: 2;">
                        <h2><?php the_sub_field('title'); ?></h2>
                        <div><?php the_sub_field('content'); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;

    // Display Group 4
    if (have_rows($group_4)): ?>
        <div class="acf-group swim__lesson-section">
            <?php while (have_rows($group_4)): the_row();
                $image = get_sub_field('image');
                if ($image) {
                    $image_urls[$group_4][] = $image['url'];
                }
            ?>
                <div class="acf-item" style="display: flex; flex-direction: row-reverse;">
                    <div class="acf-image" style="flex: 2;">
                        <?php if ($image): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="acf-text" style="flex: 3;">
                        <h2><?php the_sub_field('title'); ?></h2>
                        <div><?php the_sub_field('content'); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;

    // Display Group 5
    if (have_rows($group_5)): ?>
        <div class="acf-group swim__lesson-section">
            <?php while (have_rows($group_5)): the_row();
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $content = get_sub_field('content');
                if ($image || $title || $content) {
                    $image_urls[$group_5][] = $image['url'];
                }
            ?>
                <div class="acf-item" style="display: flex;">
                    <div class="acf-image" style="flex: 1;">
                        <?php if ($image): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="acf-text" style="flex: 2;">
                        <h2><?php the_sub_field('title'); ?></h2>
                        <div><?php the_sub_field('content'); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;

    // Pass image URLs to JavaScript
    ?>
    <script>
        var acfImageUrls = <?php echo json_encode($image_urls); ?>;
        document.addEventListener('DOMContentLoaded', function() {
    console.log('ACF Image URLs:', acfImageUrls); // Debugging: Check image URLs

    if (window.innerWidth <= 992) {
        var groups = document.querySelectorAll('.acf-group');

        groups.forEach(function(group) {
            var groupClass = group.classList[1]; // Assuming the class is group_1, group_2, etc.
            console.log('Group Class:', groupClass);
            var images = acfImageUrls[groupClass] || [];

            var items = group.querySelectorAll('.acf-item');

            items.forEach(function(item, index) {
                var imageElement = item.querySelector('.acf-image');
                if (images[index]) {
                    console.log('Setting background for item index:', index, 'Image URL:', images[index]);
                    imageElement.style.backgroundImage = 'url("' + images[index] + '")';
                    imageElement.style.backgroundSize = 'cover';
                    imageElement.style.backgroundPosition = 'center';
                    imageElement.innerHTML = ''; // Clear the <img> tag if it exists
                }
            });
        });
    }
});

    </script>
    <?php

    return ob_get_clean(); // Return the buffered content
}
add_shortcode('acf_double_group', 'acf_double_group_shortcode');

?>