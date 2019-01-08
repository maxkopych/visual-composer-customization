<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcAboutVideo extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_about_video_mapping' ) );
        add_shortcode( 'vc_about_video_block', array( $this, 'vc_about_video_html' ) );
    }
     
    // Element Mapping
     public function vc_about_video_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('About us video section', 'text-domain'),
                'base' => 'vc_about_video_block',
                'description' => __('This is a About us Video section widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   

                      array(
                        'type' => 'textfield',
                        'heading' => __( 'Heading', 'text-domain' ),
                        'param_name' => 'v_heading',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),

                        array(
                        'type' => 'textfield',
                        'heading' => __( 'Sub Heading', 'text-domain' ),
                        'param_name' => 'v_sub_head',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                         array(
                        'type' => 'textarea_raw_html',
                        'heading' => __( 'Content', 'text-domain' ),
                        'param_name' => 'v_sub_contents',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => '',
                        'heading' => __( 'Upload Video image', 'text-domain' ),
                        'param_name' => 'vimage',
                        'description' => __( 'Upload Background Image', 'text-domain' ),
                        'group' => 'General',
                    ),  

                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Youtube video url', 'text-domain' ),
                        'param_name' => 'v_youtubeid',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),

                                    
                         
                )
            )
        );                                
            
    }
     
     
    // Element HTML
    public function vc_about_video_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'v_heading'   => '',
                    'v_sub_head' => '',
                     'v_sub_contents'   => '',
                    'vimage' => '',
                    'v_youtubeid' => '',
                   
                   
                ), 
                $atts
            )
        );
         
     
        
    
      
        $bannerimage = wp_get_attachment_image_src($vimage,'full', true);
        $html = ' <div class="mission-wrapper">
      <div class="container">
        <div class="mission-block">
          <div class="row">
            <div class="col-md-12 col-lg-5">
              <div class="mission-left-content">
                <span class="mission-title">'.$v_heading.'</span>
                <h2>'.$v_sub_head.'</h2>
'.(isset($v_sub_contents)? rawurldecode( base64_decode( strip_tags( $v_sub_contents ) ) ):"").'
              </div>
            </div>
            <div class="col-md-12 col-lg-7">
              <div class="mission-right-video">
                 
				 <a class="yt" href="'.$v_youtubeid.'"><img class="" src="'.$bannerimage[0].'" /></a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
 ';      
         
        return $html;
         
    }
     
} // End Element Class
 
// Element Class Init
new vcAboutVideo();