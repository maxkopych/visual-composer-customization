<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcAboutBanner extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_about_banner_mapping' ) );
        add_shortcode( 'vc_about_banner_block', array( $this, 'vc_about_banner_html' ) );
    }
     
    // Element Mapping
     public function vc_about_banner_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('About us Banner section', 'text-domain'),
                'base' => 'vc_about_banner_block',
                'description' => __('This is a About us Banner section widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   

                      array(
                        'type' => 'textfield',
                        'heading' => __( 'About us heading', 'text-domain' ),
                        'param_name' => 'about_heading1',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),

                       array(
                        'type' => 'textfield',
                        'heading' => __( 'About us sub heading', 'text-domain' ),
                        'param_name' => 'about_heading2',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),


                        array(
                        'type' => 'textarea',
                        'heading' => __( 'About us content', 'text-domain' ),
                        'param_name' => 'about_content',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),

                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => '',
                        'heading' => __( 'Upload Background image', 'text-domain' ),
                        'param_name' => 'backgroundimage',
                        'description' => __( 'Upload Background Image', 'text-domain' ),
                        'group' => 'General',
                    ),  

                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => '',
                        'heading' => __( 'Upload Banner image', 'text-domain' ),
                        'param_name' => 'bannerimage',
                        'description' => __( 'Upload Banner Image', 'text-domain' ),
                        'group' => 'General',
                    ),  
    

                                    
                         
                )
            )
        );                                
            
    }
     
     
    // Element HTML
    public function vc_about_banner_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'backgroundimage'   => '',
                    'bannerimage' => '',
                     'about_heading1'   => '',
                     'about_heading2'   => '',
                    'about_content' => '',
                   
                   
                ), 
                $atts
            )
        );
         
     
        
    
        $backgroundimage = wp_get_attachment_image_src($backgroundimage,'full', true);
        $bannerimage = wp_get_attachment_image_src($bannerimage,'full', true);
        
        $html = '   <div class="introducing-magazine" style="background: url('.$backgroundimage[0].') no-repeat center; background-size: cover;">  
      <div class="container">
        <div class="magazine-block">
          <div class="magazine-content">
          <h1>'.$about_heading1.'</h1>
          <h2>'.$about_heading2.'</h2>
          <p>'.$about_content.'</p>
          </div>
        </div>
        <div class="mazagine-book"><img class="" src="'.$bannerimage[0].'" /></div>
      </div>
    </div>


       
        ';      
         
        return $html;
         
    }
     
} // End Element Class
 
// Element Class Init
new vcAboutBanner();