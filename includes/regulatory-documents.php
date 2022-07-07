<?php

/* POST TYPES */
function atr_rd_cpt() {
  register_post_type('regulatory_documents',
    array(
      'labels'      => array(
        'name'          => 'Regulatory Documents',
        'singular_name' => 'Regulatory Document',
        'menu_name'     => 'Regulatory Documents',
        'add_new'       => 'Add New Regulatory Document',
        'add_new_item'  => 'Add New Regulatory Document',
      ),
      'public'      => true,
      'publicly_queryable'      => false,
      'has_archive' => false,
      'menu_icon'   => 'dashicons-media-document',
      'supports'    => array( 'title' ),
    )
  );
}
add_action('init', 'atr_rd_cpt');
