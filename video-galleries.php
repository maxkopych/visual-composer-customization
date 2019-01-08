<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcVideoGallery extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_home_video_gallery_mapping' ) );
        add_shortcode( 'vc_home_video_gallery_block', array( $this, 'vc_home_video_gallery_html' ) );
    }
     
    // Element Mapping
     public function vc_home_video_gallery_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }


        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('Video Gallery', 'text-domain'),
                'base' => 'vc_home_video_gallery_block',
                'description' => __('This is a Video Gallery widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                    
                      
                     array(
                      'type'        => 'dropdown',
                      'heading' => __( 'Order', 'text-domain' ),
                      'param_name'  => 'sorder',
                      'admin_label' => false,
                      'value'       => array(
                        'Select' => '',
                        'Asc'   => 'ASC',
                        'Desc'  => 'DESC',
                      ),
                      'std'         => 'DESC', // Your default value
                      'edit_field_class' => '',
                      'group' => 'General',
                    ),      
                  

                   

                     array(
                        'type' => 'textfield',
                        'heading' => __( 'No. of posts', 'text-domain' ),
                        'param_name' => 'spacenum',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'std'         => -1,
                        'edit_field_class' => '',
                        'group' => 'General',
                    ),
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'More video title', 'text-domain' ),
                        'param_name' => 'more_video',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'std'         => '',
                        'edit_field_class' => '',
                        'group' => 'General',
                    ),
                   
        
                )
            )
        );                                
            
    }
     
     
    // Element HTML
    public function vc_home_video_gallery_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'sorder'   => '',
                    'spacenum' => '',
                    'more_video' => '',
                    
                ), 
                $atts
            )
        );
         

    
    $args = array(
    'post_type' => 'video_galleries',
    'posts_per_page' => $spacenum,
    'order' => $sorder,
  
   
);
       

$the_query = new WP_Query( $args );
 
 $html= '';

        $html.='<div class="video-gallery">
            <div class="container">
                <div class="row">
                    <div class="video-title col-lg-12">
                        <div class="title-top">
                            <span>Video</span>
                        </div>
                    </div><div class="video-left-section">                   
                        <div class="slider slider-for">';

if ( $the_query->have_posts() ) {
     $ijk=0;
    while ( $the_query->have_posts() ) {
         $ijk++;
        $the_query->the_post();
    $videoframe = get_field('video_iframe');
    if(isset($videoframe) && !empty($videoframe))
    {
       $html .= '<div class="big-video vid'.$ijk.'"><iframe width="100%" height="449" src="https://www.youtube.com/embed/'.$videoframe.'" frameborder="0" allowfullscreen></iframe>
                            </div>';
    }
               
    }
    
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
}
      $html .= '</div>
                    </div>
                    
                    <div class="video-right-section">
                    
                        
                        <div class="video-thumbnails">
                            <h3>'.$more_video.'</h3>
                           
        ';   

/*if ( $the_query->have_posts() ) {
    $ij=0;
    while ( $the_query->have_posts() ) {
        $ij++;
        $the_query->the_post();
          $cat = '';
        $category_detail=get_the_terms( get_the_ID(), 'video_gallery_cat' );//$post->ID
        if(isset($category_detail) && !empty($category_detail))
        {
foreach($category_detail as $cd){
 $cat .= $cd->name.', ';
}
$cat = rtrim($cat,', ');
}
    $videoframe = get_field('video_iframe');
    if(isset($videoframe) && !empty($videoframe))
    {
     $src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail', false );
       $html .= '<div class="videos" id="vid'.$ij.'">
                                    <div class="thumb-video">
                                        <img src="'.$src[0].'" alt="" />
                                        <span class="play-icon"></span>
                                    </div>
                                    
                                    <div class="video-content">
                                        <p>'.get_the_title().'</p>
                                        <span class="video-cat">'.$cat.'</span>
                                    </div>
                                </div>';

    }
               
    }
    
  
    wp_reset_postdata();
} else {
    // no posts found
}*/
 $html .= '
                        </div>
                    </div>
                </div>
            </div>

       
        '; 
         
        return $html;
        
        
                    
             
         
    }
   

     
} // End Element Class
 



new vcVideoGallery();