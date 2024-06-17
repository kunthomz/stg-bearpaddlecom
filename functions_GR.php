<?php
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('wpseo_json_ld_output', 'disable_yoast_schema_data', 10, 1);

add_shortcode('do_bcrumbs', 'yoast_breadcrumbs');
add_shortcode('do_post_meta', 'post_meta');
add_shortcode('do_blog_pagination', 'blog_pagination');
add_shortcode("do_blog_home", "BlogHome");
add_shortcode("do_custom_archive_title", "archive_titles");

function yoast_breadcrumbs(){
	if ( function_exists('yoast_breadcrumb') ) {
	  yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
	}
}
function canonical(){
    echo "<link rel='canonical' href='" . get_permalink( get_option( 'page_for_posts' ) ) . "'/>";
}

function rel_next_previous() {
    global $paged;
    if ( get_previous_posts_link() ) {
  ?>
    <link rel="prev" href="<?php echo get_pagenum_link( $paged - 1 ); ?>">
  <?php
    } 
    if ( get_next_posts_link() ) {
  ?>
    <link rel="next" href="<?php echo get_pagenum_link( $paged + 1 ); ?>">
  <?php
    }
  }

function BlogHome(){
		global $post;
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => '4',
			'orderby' =>'date',
			'order' => "DESC"
		);
		$query1 = new WP_Query( $args );
		echo "<div class='blog-container home'>";
	
		while ($query1->have_posts()) {
			$query1->the_post();
			echo "	<div class='blog-inner-container four-column'>
						<div class='blog-meta''>	
							<img src='". get_the_post_thumbnail_url($post->id, "rta_thumb_center_center_354x222" ) . "' alt='".get_the_title()."'>
								<h3 class='blog-title'><a href='" . get_the_permalink() ."'>" . get_the_title() . "</a></h3>
								<div class='date'>". get_the_date() ."</div>
								<p class='excerpt'>".  wp_trim_words( get_the_excerpt(), 25, '...' ) ."</p>
								<div class='readmore' ><a href='" . get_the_permalink() ."'  rel='nofollow'>Read More</a></div>
							</div>
					</div>";

					}
		echo "</div>";

		wp_reset_postdata();
}

function blog_pagination($atts){
	extract( shortcode_atts( array(
		'expand' => '...',
	), $atts) );
    
    global $paged;
    $posts_per_page = $default_posts_per_page = get_option( 'posts_per_page' );
    $settings = array(
        'showposts' => $posts_per_page, 
        'post_type' => 'post', 
        'post_status' => 'published',
        'orderby' => 'date', 
        'order' => 'ASC', 
        'paged' => $paged,
    );
	
    $post_query = new WP_Query( $settings );	
    
    $total_found_posts = $post_query->found_posts;
    $total_page = ceil($total_found_posts / $posts_per_page);
		
    wp_reset_postdata();
    
    if(function_exists('wp_pagenavi')) {
        $list .='<div class="page-navigation">'.wp_pagenavi(array('query' => $post_query, 'echo' => true)).'</div>';
    } else {
        $list.='
        <span class="prev-posts-links">'.get_previous_posts_link('Previous page').'</span>
		 <span class="next-posts-links">'.get_next_posts_link('Next page', $total_page).'</span>
        ';
       
    }
	return $list;
}

function post_meta(){
	$args = array(
    'post_type' => 'post',
);
	$post_query = new WP_Query( $args );	
$post_query->have_posts();
	
	$output = "<h1>" .get_the_title(). "</h1> <div class='post-meta-date'>Posted on ". get_the_date() ."</div> ";
	
	return $output;
}

function archive_titles(){
	if(is_date()){
		$output = "<h1 class='archive-head'>" . get_the_archive_title() . " Swimming Blog</h1>";
	}else{
		$output = "<h1 class='archive-head'>" . get_the_archive_title() . "</h1>";
	}
	
	return $output;
}

function disable_yoast_schema_data($data){
	$data = array();
	return $data;
}