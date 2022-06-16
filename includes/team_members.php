<?php
/*
function get_team_member_options() {
  $array = [];

  $args = [
    'posts_per_page' => -1,
    'post_type' => 'team',
  ];
  $the_query = new WP_Query( $args );
  if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      $array[get_the_ID()] = get_the_title();
    }
  }
  wp_reset_postdata();


  return $array;
}
*/

add_image_size( 'team-member' , 400 , 400 , true );


/* POST TYPES */
function atr_team_cpt() {
  register_post_type('team',
    array(
      'labels'      => array(
        'name'          => 'Team Members',
        'singular_name' => 'Team Member',
        'menu_name'     => 'Team Members',
        'add_new'       => 'Add New Team Member',
        'add_new_item'  => 'Add New Team Member',
      ),
      'public'      => true,
      'publicly_queryable'      => false,
      'has_archive' => false,
      'menu_icon'   => 'dashicons-businessperson',
      'supports'    => array( 'title' ),
    )
  );

}
add_action('init', 'atr_team_cpt');
