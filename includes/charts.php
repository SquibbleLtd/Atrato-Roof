<?php
//this just creates a menu item
function charts_admin_menu() {
    add_menu_page(
        'Charts',
        'Charts',
        'read',
        'atr-charts',
        '', // Callback, leave empty
        'dashicons-chart-pie',
        8 // Position
    );
}

add_action( 'admin_menu', 'charts_admin_menu' );

/* POST TYPES */
// Revenue Escalation
function chart_revenu_escalation() {
    register_post_type('revenue_escalation',
      array(
        'labels'      => array(
          'name'          => 'Revenue Escalation',
          'singular_name' => 'Revenue Escalation',
          'menu_name'     => 'Revenue Escalation',
          'add_new'       => 'Add New Chart',
          'add_new_item'  => 'Add New Chart',
        ),
        'public'      => true,
        'publicly_queryable'      => false,
        'has_archive' => false,
        'show_in_menu' => 'atr-charts',
        'menu_icon'   => 'dashicons-chart-pie',
        'supports'    => array( 'title' ),
      )
    );
  }
  add_action('init', 'chart_revenu_escalation');

//   Contracted Revenue
  function chart_contracted_revenue() {
    register_post_type('contracted_revenue',
      array(
        'labels'      => array(
          'name'          => 'Contracted Revenue',
          'singular_name' => 'Contracted Revenue',
          'menu_name'     => 'Contracted Revenue',
          'add_new'       => 'Add New Chart',
          'add_new_item'  => 'Add New Chart',
        ),
        'public'      => true,
        'publicly_queryable'      => false,
        'has_archive' => false,
        'show_in_menu' => 'atr-charts',
        'menu_icon'   => 'dashicons-chart-pie',
        'supports'    => array( 'title' ),
      )
    );
  }
  add_action('init', 'chart_contracted_revenue');

   //   Offtaker Industry
  function chart_offtaker_industry() {
    register_post_type('offtaker_industry',
      array(
        'labels'      => array(
          'name'          => 'Offtaker Industry',
          'singular_name' => 'Offtaker Industry',
          'menu_name'     => 'Offtaker Industry',
          'add_new'       => 'Add New Chart',
          'add_new_item'  => 'Add New Chart',
        ),
        'public'      => true,
        'publicly_queryable'      => false,
        'has_archive' => false,
        'show_in_menu' => 'atr-charts',
        'menu_icon'   => 'dashicons-chart-pie',
        'supports'    => array( 'title' ),
      )
    );
  }
  add_action('init', 'chart_offtaker_industry');
   //   Credit Quality
  function chart_credit_quality() {
    register_post_type('credit_quality',
      array(
        'labels'      => array(
          'name'          => 'Credit Quality',
          'singular_name' => 'Credit Quality',
          'menu_name'     => 'Credit Quality',
          'add_new'       => 'Add New Chart',
          'add_new_item'  => 'Add New Chart',
        ),
        'public'      => true,
        'publicly_queryable'      => false,
        'has_archive' => false,
        'show_in_menu' => 'atr-charts',
        'menu_icon'   => 'dashicons-chart-pie',
        'supports'    => array( 'title' ),
      )
    );
  }
  add_action('init', 'chart_credit_quality');