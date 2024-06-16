<?php 
	add_action( 'wp_head', 'canonical' );
   	add_action( 'wp_head', 'rel_next_previous' );

	get_header();

	//echo do_shortcode("[elementor-template id='33858']");
?>

<section class='blog-section'>
	<div class="blog-container">
		<h1 class="raven-heading raven-heading-h1"><span class="raven-heading-title">Swimming Blog</span></h1>
	<p>Welcome to the <b>Bear Paddle Swim School Blog</b>. Our results-focused story-based approach to teaching lessons builds confident and skilled swimmers, so parents can rest assured that their child is having fun while learning to swim.</p>

<?php
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$query = new WP_Query( array(
		'posts_per_page' => $default_posts_per_page = get_option( 'posts_per_page' ),
		'post_type'     => 'post',
		'orderby'       => 'date',
		'order'         => 'DESC' ,
		'paged' => $paged
	) );

	while($query->have_posts()) {
		$query->the_post();
		?>
		<div class="blog-inner-container">
			<div class="blog-meta">				
	<?php
				echo "<img src='". get_the_post_thumbnail_url($post->id, "rta_thumb_center_center_354x222" ) . "'></img>";
				echo "<h3><a href='". get_the_permalink() . "'>".get_the_title(). "</a></h3>";
				echo "<div class='date'><a href='". date("./Y/m/",strtotime(get_the_date())) ."'>".get_the_date()."</a></div>";
				echo "<p>" . wp_trim_words( get_the_excerpt(), 30, '...' ) . "</p>"; 
				echo "<a href='". get_the_permalink() . "'>Read More</a>";
	?>
			</div>
		</div>

<?php
	}
?>
	</div>


<?php
	do_shortcode('[do_blog_pagination]');
?>
	</section>
<?php
get_footer();