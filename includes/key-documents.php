<?php

/* POST TYPES */
function atr_kd_cpt() {
  register_post_type('key-documents',
    array(
      'labels'      => array(
        'name'          => 'Key Documents',
        'singular_name' => 'Key Document',
        'menu_name'     => 'Key Documents',
        'add_new'       => 'Add New Key Document',
        'add_new_item'  => 'Add New Key Document',
      ),
      'public'      => true,
      'publicly_queryable'      => false,
      'has_archive' => false,
      'menu_icon'   => 'dashicons-media-document',
      'supports'    => array( 'title' ),
    )
  );
}
add_action('init', 'atr_kd_cpt');
