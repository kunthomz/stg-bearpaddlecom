<?php
add_action('wp_head', 'Webpage_schema');
add_action('wp_head', 'LocalBusiness_schema');

if(is_front_page()){
	add_action('wp_head', 'Website_schema');
	add_action('wp_head', 'Organization_schema');
	add_action('wp_head', 'Sitenavigation_schema');
}else{
  if ( is_singular('post') ) {
    add_action('wp_head', 'Article_schema');
  }
	add_action('wp_head', 'Breadcrumbs_schema');
}

function Website_schema(){
	?>
<script type='application/ld+json'>
{
  "@context":"https://schema.org",
  "@type":"WebSite",
  "url":"<?php echo home_url(); ?>",
  "name":"Bear Paddle",
  "potentialAction":{
    "@type":"SearchAction",
    "target":"{search_term_string}",
    "query-input":"required name=search_term_string"
  }
}
</script>
<?php
}
function Webpage_schema(){
  if(is_front_page()){
    $BCrumbs = "Home";
    $URL = home_url();
  }else{
    $BCrumbs = "Home";

    if(is_404()){
      $BCrumbs .= " | 404";
      $URL = home_url(). "/404/";
    }else{
      global $post;
      $parents = array(get_post_ancestors($post->ID));

      foreach ($parents as $vals) {
        $vals = array_reverse($vals);
        for($i = 0; $i<count($vals); $i++){
          $BCrumbs .= " | " . get_the_title($vals[$i]);
        }
      }

      if(is_singular( 'post' ) || is_home() || is_archive()){
        $BCrumbs .= " | " . get_the_title( get_option('page_for_posts', true));
        $URL = get_permalink( get_option( 'page_for_posts' ) );
      }

      if(is_archive()){
        if(!is_date()){
          $queried_object = get_queried_object();
          $term_id = $queried_object->term_id;
        }
        $BCrumbs .= " | " . strip_tags(get_the_archive_title());
        $URL = is_date() ? get_permalink( get_option( 'page_for_posts' ) ).date("Y/m/",strtotime(get_the_date())) : get_term_link($term_id);
      }

      if(is_singular('page') || is_singular('post')){
        $BCrumbs .= " | " . get_the_title();
        $URL = get_the_permalink();
      }
    }
  }
?>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebPage",
  "breadcrumb": "<?php echo html_entity_decode($BCrumbs) ?>",
  "mainEntity":{
    "@type": "Service",
    "url":"<?php echo $URL ?>"
  }
}
</script>

<?php
}
function Organization_schema(){
	?>
<script type='application/ld+json'>
{
  "@context":"https://schema.org",
  "@type":"Organization",
  "url":"<?php echo home_url(); ?>",
  "name":"Bear Paddle",
  "image":"<?php echo home_url(); ?>/wp-content/uploads/2022/01/BP-weblogo-01.png"
}
</script>

<?php
}
function Sitenavigation_schema(){
	?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": 
    [
      {
          "@context": "https://schema.org",
          "@type":"SiteNavigationElement",
          "@id":"https://schema.org/SiteNavigationElement",
          "name": "Swim Programs",
          "url": "<?php echo home_url(); ?>/swim-programs/"
      },
      {
          "@context": "https://schema.org",
          "@type":"SiteNavigationElement",
          "@id":"https://schema.org/SiteNavigationElement",
          "name": "Locations",
          "url": "<?php echo home_url(); ?>/locations/"
      },
      {
          "@context": "https://schema.org",
          "@type":"SiteNavigationElement",
          "@id":"https://schema.org/SiteNavigationElement",
          "name": "Register",
          "url": "<?php echo home_url(); ?>/register/"
      },
      {
          "@context": "https://schema.org",
          "@type":"SiteNavigationElement",
          "@id":"https://schema.org/SiteNavigationElement",
          "name": "Contact",
          "url": "<?php echo home_url(); ?>m/contact/"
      },
      {

          "@context": "https://schema.org",
          "@type":"SiteNavigationElement",
          "@id":"https://schema.org/SiteNavigationElement",
          "name": "Swim Blog",
          "url": "<?php echo home_url(); ?>/swimming-blog/"
       
      },
{
}
    ]
}
</script>

<?php
	
}
function Article_schema(){
	global $post;
?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Article",
  "headline": "<?php echo get_the_title() ?>",
  "url": "<?php echo get_the_permalink(); ?>",
  "description": "<?php echo get_post_meta($post->ID, '_yoast_wpseo_metadesc', true) ? html_entity_decode(get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)) : html_entity_decode(wp_trim_words( get_the_excerpt(), 25, '...' )) ?>",
  "image": "<?php echo get_the_post_thumbnail_url(); ?>",
  "datePublished": "<?php echo get_the_date('c') ?>",
  "dateModified": "<?php echo date("Y-m-d",strtotime(get_the_modified_date()))." ".get_the_time( 'G:i:s' ); ?>; ?>",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php echo get_the_permalink(); ?>"
  },
  "author": {
    "@type":"Person",
    "name":"<?php echo get_the_author() ?>"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Bear Paddle",
    "logo": {
      "@type": "ImageObject",
      "url":"<?php echo home_url(); ?>/wp-content/uploads/2022/01/BP-weblogo-01.png"
    }
  }
}
</script>

<?php	
}

function Breadcrumbs_schema(){
    $position_counter = 1;
?>
    <script type="application/ld+json">
    {
      "@context" : "http://schema.org",
      "@type" : "BreadcrumbList",
      "itemListElement" :
      [
        {
          "@type" : "ListItem",
          "position" : 1,
          "item" : {
              "name" : "Home",
              "@id" : "<?php echo home_url() ?>"
              }
        }

<?php if(is_404()){  ?>

        ,{
          "@type" : "ListItem",
          "position" : <?php echo $position_counter += 1 ?>,
          "item" : {
            "name" : "404",
            "@id" : "<?php echo home_url()."/404/" ?>"
          }
        }

<?php }else{

        global $post;
        $parents = array(get_post_ancestors($post->ID));

        foreach ($parents as $vals) {
          $vals = array_reverse($vals);
          for($i = 0; $i<count($vals); $i++){
?>
            ,{
              "@type" : "ListItem",
              "position" : <?php echo $position_counter += 1 ?>,
              "item" : {
                "name" : "<?php echo html_entity_decode(get_the_title($vals[$i])); ?>",
                "@id" : "<?php echo the_permalink($vals[$i]); ?>"
              }
            }
<?php		  }
        }

        if(is_singular( 'post' ) || is_home() || is_archive()){
?>
          ,{
            "@type" : "ListItem",
            "position" : <?php echo $position_counter += 1 ?>,
            "item" : {
              "name" : "<?php echo html_entity_decode(get_the_title( get_option('page_for_posts', true) )); ?>",
              "@id" : "<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"
            }
          }

<?php   }
        if(is_archive()){
          if(!is_date()){
            $queried_object = get_queried_object();
            $term_id = $queried_object->term_id;
          }
?>
          ,{
            "@type" : "ListItem",
            "position" : <?php echo $position_counter += 1 ?>,
            "item" : {
                "name" : "<?php echo html_entity_decode(strip_tags(get_the_archive_title())); ?>",
                "@id" : "<?php  echo is_date() ? get_permalink( get_option( 'page_for_posts' ) ).date("Y/m/",strtotime(get_the_date())) : get_term_link($term_id); ?>"
              }
          }
<?php   }
        if(is_singular('page') || is_singular('post')){
?>
        ,{
          "@type" : "ListItem",
          "position" : <?php echo $position_counter += 1 ?>,
          "item" : {
               "name" : "<?php echo html_entity_decode(get_the_title()); ?>",
               "@id" : "<?php echo get_the_permalink(); ?>"
              }
          }

 <?php  }
      }
?>

    ]
  }
  </script>
<?php  }

function LocalBusiness_schema(){
  global $post;
	$schema = get_field('enable_schema', $post->ID);
	$schemaInfo = get_field('schema_info', $post->ID);

	if (get_field('enable_schema', $post->ID) == 1){

?>
<script type="application/ld+json">
{
"@context":"http://schema.org",
"@type":"LocalBusiness",
"name":"<?php echo the_field('schema_name', $post->ID)?>",
"image":"<?php echo the_field('schema_image', $post->ID) ?>",
"url":"<?php echo get_the_permalink($post->ID); ?>",
"additionalproperty": {
"@type":"propertyValue",
"name":"<?php echo the_field('schema_name', $post->ID) ?>"
},
"aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "<?php echo $schemaInfo['rating']['rating_value'] ?>",
    "reviewCount": "<?php echo $schemaInfo['rating']['review_count'] ?>"
  },

"priceRange":"<?php echo $schemaInfo['bill']['price_range'] ?>",
"telephone":"<?php echo $schemaInfo['address']['telephone_number'] ?>",
"currenciesAccepted":"<?php echo $schemaInfo['bill']['currency_code'] ?>",
"hasMap":"<?php echo $schemaInfo['address']['google_map'] ?>",
  "address":  {
    "@type": "PostalAddress",
    "addressCountry": "<?php echo $schemaInfo['additional_address']['country_code'] ?>",
    "addressLocality": "<?php echo $schemaInfo['additional_address']['state'] ?>",
    "addressRegion": "<?php echo $schemaInfo['additional_address']['region_code'] ?>"
  },
  "parentOrganization": "<?php echo home_url() ?>",
  "openingHoursSpecification": [
 
    <?php
    $days = ['Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $counter = -1;
    foreach ( $schemaInfo['schedule'] as $hours ) {
      $counter++;
    ?>
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "https://schema.org/<?php echo $days[$counter]?>",
      "opens": "<?php echo $schemaInfo['schedule'][$days[$counter]]['opening_time']?>",
      "closes":  "<?php echo $schemaInfo['schedule'][$days[$counter]]['closing_time']?>"

    }<?php   echo $counter + 1 == count($schemaInfo['schedule']) ? '' : ',';   
    }
?>
  ]
}
</script>
<?php
}else{

}
}