<?php get_header(); ?>
<section class="header">
  <h1>制作事例</h1>
  <div class="layer overRay"></div>
  <div style="background-image: url(<?php echo esc_url( get_template_directory_uri().'/image/main.jpg' ) ?>" class="layer background"></div>
</section>

<section class="section">
  <?php
    $arr = array('web-site', 'graphic-design');
    foreach ($arr as $portfolio_slug):
    $portfolio = get_term_by( 'slug', $portfolio_slug, 'portfoliocat' );
    $paged = (int) get_query_var('paged');
    $args = array(
      'orderby' => 'post_date',
      'order' => 'ASC',
      'post_type' => 'portfolio',
      'post_status' => 'publish',
      'tax_query' => array(
        array(
          'taxonomy' => 'portfoliocat',
          'field' => 'slug',
          'terms' => $portfolio_slug
        )
      )
    );
    $the_query = new WP_Query($args);
    if ( $the_query->have_posts() ) :
  ?>
  <h2><?php echo $portfolio->name ?></h2>
  <div class="portfolioWrapper innerWrapper">
    <?php
        while ( $the_query->have_posts() ) : $the_query->the_post();
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_image_src($image_id, true);
        $url = get_post_meta( get_the_ID(), 'url', true );
    ?>
      <a href="<?php echo $url ?>" class="portfolio" target="_blank">
        <div class="img" style="background-image: url(<?php echo $image_url[0]; ?>)"></div>
        <div class="description">
          <p><?php the_title(); ?></p>
        </div>
      </a>
    <?php endwhile; endif; ?>
  </div>
<?php endforeach; ?>
</section>
<?php get_footer(); ?>
