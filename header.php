<?php
/**
 * This file's content is located in /lib/templates/structure/header.php and should
 * only be overwritten via your child theme.
 *
 * We strongly recommend to read the Jupiter documentation to find out more about
 * how to customize Jupiter theme.
 *
 * @author JupiterX
 * @link   https://artbees.net
 * @package JupiterX\Framework
 */
require_once('functions_SDM.php');
jupiterx_load_default_template( __FILE__ );
if(is_front_page() || is_singular( 'post' ) || is_archive()){
	
}else{
	echo do_shortcode("[elementor-template id='33821']");
}

