<?php get_header(); ?>
<?php if(have_posts()): while(have_posts()):the_post(); ?>
<section class="header">
  <h1><?php the_title(); ?></h1>
  <div class="layer overRay"></div>
  <div class="layer background" style="background-image: url(<?php echo esc_url( get_template_directory_uri().'/image/main.jpg' ) ?>);"></div>
</section>

<section class="single">
  <div class="innerWrapper">
    <div class="singleLeft">
      <?php
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_image_src($image_id, true);
      ?>
        <img src="<?php echo $image_url[0]; ?>">
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
    </div>
    <div class="singleRight">
      <?php get_template_part( 'sidebar', get_post_format() ); ?>
    </div>

  </div>
</section>
<?php get_footer(); ?>
