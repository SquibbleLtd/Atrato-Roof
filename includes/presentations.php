<?php

/* POST TYPES */
function atr_presentations_cpt() {
  register_post_type('presentations',
    array(
      'labels'      => array(
        'name'          => 'Presentations',
        'singular_name' => 'Presentation',
        'menu_name'     => 'Presentations',
        'add_new'       => 'Add New Presentation',
        'add_new_item'  => 'Add New Presentation',
      ),
      'public'      => true,
      'publicly_queryable'      => false,
      'has_archive' => false,
      'menu_icon'   => 'dashicons-media-document',
      'supports'    => array( 'title' ),
    )
  );
}
add_action('init', 'atr_presentations_cpt');
