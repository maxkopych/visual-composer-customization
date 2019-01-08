<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcServiceBox extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_home_banner_mapping' ) );
        add_shortcode( 'vc_home_banner_block', array( $this, 'vc_home_banner_html' ) );
    }
     
    // Element Mapping
     public function vc_home_banner_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('Banner Slider', 'text-domain'),
                'base' => 'vc_home_banner_block',
                'description' => __('Upload image, add a title,content and button with link. Change the text color, background color of button, button color and button text color', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                    
                      array(
                      'type'        => 'dropdown',
                      'heading' => __( 'Order', 'text-domain' ),
                      'param_name'  => 'border',
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
                        'heading' => __( 'No. of slides', 'text-domain' ),
                        'param_name' => 'slidenum',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'std'         => -1,
                        'edit_field_class' => '',
                        'group' => 'General',
                    ),
                         
                )
            )
        );                                
            
    }
     
     
    // Element HTML
    public function vc_home_banner_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'border'   => '',
                    'slidenum' => '',
                   
                ), 
                $atts
            )
        );
         
        // Fill $html var with data
   
         
        $html = '<div class="home-slider">
        <div class="owl-carousel landing-slider owl-theme">';
         $args = array(
    'post_type' => 'banner_slider',
    'posts_per_page' => $slidenum,
    'order' => $border,
   /* 'tax_query' => array(
        array(
            'taxonomy' => 'people',
            'field'    => 'slug',
            'terms'    => 'bob',
        ),
    ),*/
);

//Hero banner text
include_once(ABSPATH.'wp-content/themes/ideasorder/inc/Mobile_Detect.php');
$detect = new Mobile_Detect;

$isMobile1 = $isTab = false;

if ( $detect->isMobile() ) {
    $isMobile1 = true;
}

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false );
        $mobanner = get_field('mobile_banner_image');
 $banner_image_url = get_field('banner_image_url');
        if(isset($mobanner) && !empty($mobanner) && $detect->isMobile() ){
    $mobile_banner = $mobanner;
   
     $isMobile1 = true;
}else{
    $isMobile1 = false;
  
}
 if($detect->isTablet() ){
 $isMobile1 = false;
    }
 if($isMobile1 == true) { 

         $html .= '<div class="item"><a href="'.$banner_image_url.'"><img src="'.$mobanner.'"></a></div>';
}else{ 
       $html .= '<div class="item"><a href="'.$banner_image_url.'"><img src="'.$src[0].'"></a></div>';
    }
}
    
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
}
          
            
        $html .= '</div></div>
       
        ';      
         
        return $html;
         
    }
     
} // End Element Class
 
// Element Class Init
new vcServiceBox();