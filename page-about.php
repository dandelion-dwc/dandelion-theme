

<?php get_header(); ?>
<section class="header">
  <h1>会社概要</h1>
  <div class="layer overRay"></div>
  <div class="layer background" style="background-image: url(<?php echo esc_url( get_template_directory_uri().'/image/main.jpg' ) ?>);"></div>
</section>

<section class="section">
  <div class="innerWrapper">
    <h2>VISION</h2>
    <h3>社会に、学生の力を</h3>
    <p>
      DANDELIONは、
      関西を中心に結成したデザイン系学生団体です。 <br>
      産学連携の社会づくりを目的としています。 <br>
      学生たちがそれぞれの得意を掛け合わせ、
      社会で活躍する中で成長していくことを促進する団体です。
    </p>
  </div>
</section>

<section class="greek section">
  <div class="leftContent">
    <img src="<?php echo esc_url( get_template_directory_uri().'/image/yuki_big.png' ) ?>" alt="代表の写真">
  </div>
  <div class="rightContent">
    <h2>MESSAGE</h2>
    <p>
      学生が個性溢れる力を存分に発揮し、 <br>
      まるでタンポポの綿毛のように春風を受けて飛び立ち、 <br>
      社会の中で美しく開花していく手助けが出来ればと思い、 <br>
      このDANDELIONと言う団体を立ち上げました。 <br>
      咲く場所を探すタンポポの種のような私たちの <br>
      今後の活躍を暖かく見守っていただければ幸いです。 <br><br>

      同志社女子大学学芸学部 <br>

      DANDELION代表 <br>
      太田有紀
    </p>
  </div>
</section>

<section class="section">
  <div class="innerWrapper">
    <h2>MEMBER</h2>
    <?php
      $arr = array('executive', 'engineer', 'salse');
      foreach ($arr as $position_slug):
      $position = get_term_by( 'slug', $position_slug, 'positioncat' );
      $paged = (int) get_query_var('paged');
      $args = array(
        'orderby' => 'post_date',
        'order' => 'ASC',
        'post_type' => 'team',
        'post_status' => 'publish',
        'tax_query' => array(
          array(
            'taxonomy' => 'positioncat',
            'field' => 'slug',
            'terms' => $position_slug
          )
        )
      );
      $the_query = new WP_Query($args);
      if ( $the_query->have_posts() ) :
    ?>
    <h3><?php echo $position->name ?></h3>
    <ul class="introMember">
      <?php
          while ( $the_query->have_posts() ) : $the_query->the_post();
      ?>
      <li>
        <?php
          $image_id = get_post_thumbnail_id();
          $image_url = wp_get_attachment_image_src($image_id, true);
        ?>
        <div class="img" style="background-image: url(<?php echo $image_url[0]; ?>)"></div>
        <div class="content">
          <h4><?php the_title(); ?></h4>
          <?php the_content(); ?>
        </div>
      </li>
    <?php endwhile; ?>
    </ul>
    <?php endif; endforeach; ?>
  </div>
</section>
<?php get_footer(); ?>
