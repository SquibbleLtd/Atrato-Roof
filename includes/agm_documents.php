<?php

/* POST TYPES */
function atr_agm_cpt() {
  register_post_type('agm-documents',
    array(
      'labels'      => array(
        'name'          => 'AGM Documents',
        'singular_name' => 'AGM Document',
        'menu_name'     => 'AGM Documents',
        'add_new'       => 'Add New AGM Document',
        'add_new_item'  => 'Add New AGM Document',
      ),
      'public'      => true,
      'publicly_queryable'      => false,
      'has_archive' => false,
      'menu_icon'   => 'dashicons-media-document',
      'supports'    => array( 'title' ),
    )
  );
}
add_action('init', 'atr_agm_cpt');
