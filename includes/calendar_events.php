<?php



/* POST TYPES */
function atr_events_cpt() {
  register_post_type('event',
    array(
      'labels'      => array(
        'name'          => 'Events',
        'singular_name' => 'Event',
        'menu_name'     => 'Events',
        'add_new'       => 'Add New Event',
        'add_new_item'  => 'Add New Event',
      ),
      'public'      => true,
      'publicly_queryable'      => false,
      'has_archive' => false,
      'menu_icon'   => 'dashicons-calendar-alt',
      'supports'    => array( 'title' ),
    )
  );

}
add_action('init', 'atr_events_cpt');
