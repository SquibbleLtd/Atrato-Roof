<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once(get_stylesheet_directory() . '/includes/includes.php');

function atr_register_elementor_widgets( $widgets_manager ) {

  require_once( __DIR__ . '/elementor-blocks/team.php' );
  $widgets_manager->register( new \Elementor_The_Team() );

  require_once( __DIR__ . '/elementor-blocks/event-table.php' );
  $widgets_manager->register( new \Elementor_Event_Table() );

  require_once( __DIR__ . '/elementor-blocks/presentations.php' );
  $widgets_manager->register( new \Elementor_Presentations() );

  require_once( __DIR__ . '/elementor-blocks/regulatory-documents.php' );
  $widgets_manager->register( new \Elementor_Regulatory_Documents() );

  require_once( __DIR__ . '/elementor-blocks/key-documents.php' );
  $widgets_manager->register( new \Elementor_Key_Documents() );

  require_once( __DIR__ . '/elementor-blocks/chart-contracted-revenue.php' );
  $widgets_manager->register( new \Elementor_Chart_Contracted_Revenue() );

  require_once( __DIR__ . '/elementor-blocks/chart-revenue-escalation.php' );
  $widgets_manager->register( new \Elementor_Chart_Revenue_Escalation() );

  require_once( __DIR__ . '/elementor-blocks/chart-offtaker-industry.php' );
  $widgets_manager->register( new \Elementor_Chart_Offtaker_Industry() );

  require_once( __DIR__ . '/elementor-blocks/chart-credit-quality.php' );
  $widgets_manager->register( new \Elementor_Chart_Credit_Quality() );

}
add_action( 'elementor/widgets/register', 'atr_register_elementor_widgets' );



function atr_enqueue_scripts() {
  wp_enqueue_style( 'atrato-scss' , get_stylesheet_directory_uri() . '/css/atrato.min.css' );
  wp_enqueue_script( 'atrato' , get_stylesheet_directory_uri() . '/js/theme.js' );
  wp_localize_script( 'atrato', 'atr_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'atr_enqueue_scripts' );

//JS Chart scripts
function js_chart_scripts(){
   
  wp_enqueue_script( 'chart', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js', array( 'jquery' ) );
      
  }
//Register hook to load scripts
add_action('wp_enqueue_scripts', 'js_chart_scripts');

$uri = $_SERVER['REQUEST_URI'];
$cookie = '';
if(isset($_COOKIE["authenticated"])){
  $cookie = $_COOKIE["authenticated"];
}

if(str_contains($uri, "investor") && $cookie !== "true"){
  header("Location: /jurisdiction/", true, 307);
  exit();
}
