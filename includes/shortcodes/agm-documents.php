<?php

function agm_shortcode($atts){
   
    $a = shortcode_atts( array( 'year' => date('Y') ), $atts );
   
    // $year = $atts['year'];
    $args = array(
                    'post_type'      => 'agm-documents',
                    'posts_per_page' => '-1',
                    'publish_status' => 'published',
                    'year' => $a['year'],
                   
                                );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) : 
   $result = "<div class='agm-docs'>";
        while($query->have_posts()) :
  
            $query->the_post() ;
        $researchLink = get_field('research_link');
        $researchUrl = get_field('research_url');
        $result .= '<div class="atr-agm"><div class="document-block">';
        $result .= '<div class="doc-icon"> <img src="' . get_field('research_icon')  . '"></div>';
        $result .= '<p>' . get_the_date('M, Y')  . '</p>';
       
        $result .= '<h5>' . get_field('research_title') . '</h5>';
        if($researchLink){
            $result .= '<div class="btn"><a href="' .  $researchLink . '" target="_blank">DOWNLOAD <span><img src="/wp-content/uploads/2023/02/Icon-feather-arrow-up-right.svg"></span></a></div>
            ';

        }
        if($researchUrl){
            $result .= '<div class="btn"><a href="' . $researchUrl . '" target="_blank">VIEW <span><img src="/wp-content/uploads/2023/02/Icon-feather-arrow-up-right.svg"></span></a></div>
            ';

        }
       
       $result .= ' </div></div>';

   
  
        endwhile;
        $result .= ' </div>';
        wp_reset_postdata();
   
    endif;    
   
    return $result;    

         
}
  
add_shortcode( 'agm-documents', 'agm_shortcode' ); 