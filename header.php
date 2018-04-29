<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php
        wp_enqueue_style(
          'base-style',
          esc_url( get_stylesheet_uri() ),
          array(),
          '1.0',
          'all'
        );
     ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <title>DANDELIOM</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
  <body>

    <header>
      <nav class="innerWrapper">
         <?php wp_nav_menu( array('menu' => 'ヘッダー', 'menu_id' => 'js_headerMenu' )); ?>
      </nav>
      <p class="only_sp" id="js_headerMenuOpen"><i class="fas fa-bars fa-2x"></i></p>
      <div class="layer modal" id="js_headerMenuClose"></div>
    </header>
