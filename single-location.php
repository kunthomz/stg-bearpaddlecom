<?php 
	add_action( 'wp_head', 'canonical' );
   	add_action( 'wp_head', 'rel_next_previous' );

	get_header();

	//echo do_shortcode("[elementor-template id='33858']");
?>



<?php
get_footer();
?>