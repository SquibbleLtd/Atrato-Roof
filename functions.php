<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(get_stylesheet_directory() . '/includes/includes.php');

function atr_register_elementor_widgets( $widgets_manager ) {

  require_once( __DIR__ . '/elementor-blocks/team.php' );
  $widgets_manager->register( new \Elementor_The_Team() );

}
add_action( 'elementor/widgets/register', 'atr_register_elementor_widgets' );



function atr_enqueue_scripts() {
  wp_enqueue_style( 'atrato-scss' , get_stylesheet_directory_uri() . '/css/atrato.min.css' );
  wp_enqueue_script( 'atrato' , get_stylesheet_directory_uri() . '/js/theme.js' );
  wp_localize_script( 'atrato', 'atr_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'atr_enqueue_scripts' );
