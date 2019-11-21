<?php
function liveprojectdev_setup_theme()
{
  load_theme_textdomain("liveprojectdev");
  add_theme_support("title-tag");
  add_theme_support("post-thumbnails");
}
add_action("after_setup_theme", "liveprojectdev_setup_theme");


function liveprojectdev_assets()
{


  if (is_page()) {
    $liveproject_launcher = basename(get_page_template());
    if ($liveproject_launcher == "launcher.php") {
      wp_enqueue_style("animate", get_theme_file_uri("/assets/css/animate.css"));
      wp_enqueue_style("icomoon", get_theme_file_uri("/assets/css/icomoon.css"));
      wp_enqueue_style("bootstrap", get_theme_file_uri("/assets/css/bootstrap.css"));
      wp_enqueue_style("style-css", get_theme_file_uri("/assets/css/style.css"));
      wp_enqueue_style("liveprojectdev", get_stylesheet_uri(), null, "0.1");


      wp_enqueue_script("easing-jquery-js", get_theme_file_uri("/assets/js/jquery.easing.1.3.js"), array("jquery"), null, true);
      wp_enqueue_script("bootstrap-jquery-js", get_theme_file_uri("/assets/js/bootstrap.min.js"), array("jquery"), null, true);
      wp_enqueue_script("waypoint-jquery-js", get_theme_file_uri("/assets/js/jquery.waypoints.min.js"), array("jquery"), null, true);
      wp_enqueue_script("countdown-jquery-js", get_theme_file_uri("/assets/js/simplyCountdown.js"), array("jquery"), null, true);
      wp_enqueue_script("main-jquery-js", get_theme_file_uri("/assets/js/main.js"), array("jquery"), "0.1", true);

      $liveprodev_year = get_post_meta(get_the_ID(), "year", true);
      $liveprodev_month = get_post_meta(get_the_ID(), "month", true);
      $liveprodev_day = get_post_meta(get_the_ID(), "day", true);

      wp_localize_script("main-jquery-js", "datedata", array(
        "year" => $liveprodev_year,
        "month" => $liveprodev_month,
        "day" => $liveprodev_day,
      ));
    } else { 


      // load another files what do you want ...........
    }
  }
}
add_action("wp_enqueue_scripts", "liveprojectdev_assets");

function liveprojectdev_widgets_inits()
{
  register_sidebar(
    array(
      'name'          => __('Footer left', 'launcher'),
      'id'            => 'footer-left',
      'description'   => __('Footer left', 'launcher'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name'          => __('Footer right', 'launcher'),
      'id'            => 'footer-right',
      'description'   => __('Footer right', 'launcher'),
      'before_widget' => '<section id="%1$s" class="text-right widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action('widgets_init', 'liveprojectdev_widgets_inits');



function liveprojectdev_styles()
{
  if (is_page()) {
    $thumbnail_url = get_the_post_thumbnail_url(null, "large");
    ?>
    <style>
      .home-image {
        background-image: url(<?php echo $thumbnail_url; ?>);
      }
    </style>
<?php
  }
}
add_action('wp_head', 'liveprojectdev_styles');
