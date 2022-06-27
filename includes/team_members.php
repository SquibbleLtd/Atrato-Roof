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



add_action( 'wp_ajax_atr_get_team_popup', 'atr_get_team_popup' );
add_action( 'wp_ajax_nopriv_atr_get_team_popup', 'atr_get_team_popup' );
function atr_get_team_popup() {
  if (!isset($_REQUEST['team-member-id'])) {
    wp_die();
  }

  $args = [
    'p' => $_REQUEST['team-member-id'],
    'post_type' => 'team',
  ];
  $the_query = new WP_Query( $args );
  if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      ?>
      <div class="att-popup-inner">
        <div class="close-att-popup close-att-popup-btn"></div>
        <div class="attp-top">
          <div class="att-image">
            <?php echo wp_get_attachment_image( get_field('image') , 'team-member' ); ?>
          </div>
          <div class="att-top-right">
            <div class="att-name">
              <?php the_title(); ?>
            </div>
            <div class="att-title">
              <?php the_field( 'title' ); ?>
            </div>
            <?php
            $liurl = get_field( 'linkedin_url' );
            if ($liurl != "") {
              ?>
              <div class="att-linked-in">
                <i class="fab fa-linkedin-square" aria-hidden="true"></i>
                <a href="<?php echo $liurl; ?>" target="_blank">
                  Connect with me
                </a>
              </div>
              <?php
            }
            ?>
            </div>
          </div>
          <div class="attp-bottom">
            <?php the_field( 'full_bio' ); ?>
          </div>
        </div>
      </div>
      <?php
    }
  } else {
    echo 'Cannot find team member...';
  }
  wp_reset_postdata();

  wp_die();
}
