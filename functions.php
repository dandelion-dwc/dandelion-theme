<?php
add_theme_support( 'post-thumbnails' );

add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {
      $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
      $title = single_tag_title( '', false );
    }
    elseif ( is_year() ) {
      $title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
    }

    return $title;

});

function wc_get_page_by_slug( $slug = '' ) {
  $pages = get_posts(
      array(
        'post_type'      => 'page',
        'name'           => $slug,
        'posts_per_page' => 1
      )
  );
  return $pages ? $pages[0] : false;
}

add_theme_support('menus');

add_action( 'admin_print_footer_scripts', 'limit_category_select' );
function limit_category_select() {
  ?>
  <script type="text/javascript">
    jQuery(function($) {
      // 投稿画面のカテゴリー選択を制限
      var cat_checklist = $('.categorychecklist input[type=checkbox]');
      cat_checklist.click( function() {
          $(this).parents('.categorychecklist').find('input[type=checkbox]').attr('checked', false);
          $(this).attr('checked', true);
      });

      // クイック編集のカテゴリー選択を制限
      var quickedit_cat_checklist = $('.cat-checklist input[type=checkbox]');
      quickedit_cat_checklist.click( function() {
          $(this).parents('.cat-checklist').find('input[type=checkbox]').attr('checked', false);
          $(this).attr('checked', true);
      });

      $('.categorychecklist>li:first-child, .cat-checklist>li:first-child').before('<p style="padding-top:5px;">カテゴリーは1つしか選択できません。未設定の場合は、自動的に「お知らせ」が選択されます。</p>');
    });
  </script>
  <?php
}

function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
        $slug = $post_ID;
    }
    return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );

function my_tiny_mce_before_init( $ar ) {
	$ar['block_formats'] = '段落=p;大見出し=h2;小見出し=h3;';
	return $ar;
}
add_filter( 'tiny_mce_before_init', 'my_tiny_mce_before_init' );

function add_editor_style_cb() {
  add_editor_style();
}
add_action('admin_init', 'add_editor_style_cb');

function setup_theme() {
  add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'setup_theme' );

function custom_title_separator($sep) {
  $sep = '|';
  return $sep;
}
add_filter( 'document_title_separator', 'custom_title_separator' );

add_action( 'init', 'register_cpt_team' );

function register_cpt_team() {

    $labels = array(
        'name' => _x( 'メンバー', 'team' ),
        'singular_name' => _x( 'メンバー', 'team' ),
    );

    $args = array(
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'team', $args );
}

// サムネイル画像を利用
add_theme_support( 'post-thumbnails', array( 'team' ) );
set_post_thumbnail_size( 150, 150, true );

// アイコンを追加
function add_menu_icons_styles(){
     echo '<style>
          #adminmenu #menu-posts-team div.wp-menu-image:before {
               content: "\f307";
          }
     </style>';
}
add_action( 'admin_head', 'add_menu_icons_styles' );

function team_init(){
  $args = array(
    'label' => '役職',
    'rewrite' => array(
      'with_front' => false,
    ),
  );

  register_taxonomy('positioncat', 'team', $args);
}
add_action( 'init', 'team_init' );




add_action( 'init', 'register_portfolio' );

function register_portfolio() {

    $labels = array(
        'name' => _x( 'ポートフォリオ', 'portfolio' ),
        'singular_name' => _x( 'ポートフォリオ', 'portfolio' ),
    );

    $args = array(
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'portfolio', $args );
}

// サムネイル画像を利用
add_theme_support( 'post-thumbnails', array( 'portfolio' ) );
set_post_thumbnail_size( 150, 150, true );


function portfolio_init(){
  $args = array(
    'label' => '分類',
    'rewrite' => array(
      'with_front' => false,
    ),
  );

  register_taxonomy('portfoliocat', 'portfolio', $args);
}
add_action( 'init', 'portfolio_init' );
?>
