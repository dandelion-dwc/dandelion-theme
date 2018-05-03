<?php get_header(); ?>
<section class="header">
  <h1>NEWS</h1>
  <div class="layer overRay"></div>
  <div class="layer background" style="background-image: url(<?php echo esc_url( get_template_directory_uri().'/image/main.jpg' ) ?>);"></div>
</section>

<section class="single">
  <div class="innerWrapper">
    <div class="singleLeft">
      <ul class="newsWrapper">
        <?php
          $paged = (int) get_query_var('paged');
          $args = array(
          	'posts_per_page' => 10,
          	'paged' => $paged,
          	'orderby' => 'post_date',
          	'order' => 'DESC',
          	'post_type' => 'post',
          	'post_status' => 'publish'
          );
          $the_query = new WP_Query($args);
          if ( $the_query->have_posts() ) :
          	while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <?php
        $cat = get_the_category();
        $catname = $cat[0]->cat_name; //カテゴリー名
        $date = get_the_date();
        ?>
        <li class="newsRow">
          <a href="<?php the_permalink(); ?>" class="cf">
            <ul>
              <li class="tag"><span><?php echo $catname ?></span></li>
              <li class="date"><?php echo $date ?></li>
              <li class="content"><?php the_title(); ?></li>
            </ul>
          </a>
        </li>
        <?php endwhile; endif; ?>
      </ul>
    </div>
    <div class="singleRight">
      <?php get_template_part( 'sidebar', get_post_format() ); ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
