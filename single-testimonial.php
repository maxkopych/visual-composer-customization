<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcSingleTestimonial extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_single_testimonial_mapping' ) );
        add_shortcode( 'vc_single_testimonial_block', array( $this, 'vc_single_testimonial_html' ) );
    }
     
    // Element Mapping
     public function vc_single_testimonial_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('Single Testimonial', 'text-domain'),
                'base' => 'vc_single_testimonial_block',
                'description' => __('This is a Single Testimonial widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                    
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
                        'type' => 'textfield',
                        'heading' => __( 'Testimonial text', 'text-domain' ),
                        'param_name' => 'testimonial_heading',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Button Title', 'text-domain' ),
                        'param_name' => 'tst_btn_title',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),

                    array(
                        'type' => 'vc_link',
                        'holder' => '',
                        'heading' => __( 'Button Link', 'text-domain' ),
                        'param_name' => 'tst_btn_link',
                        
                        'description' => __( 'Add URL for Button', 'text-domain' ),
                        
                        'group' => 'General',
                    ), 

                   
                    
               
                                    
                         
                )
            )
        );                                
            
    }
     
     
    // Element HTML
    public function vc_single_testimonial_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'backgroundimage'   => '',
                    'testimonial_heading' => '',
                     'tst_btn_title'   => '',
                    'tst_btn_link' => '',
                   
                   
                ), 
                $atts
            )
        );
         
        // Fill $html var with data
        // url:%23showrooms|title:custom||
        
        if( isset($tst_btn_link) && !empty($tst_btn_link) ){
            
            $atst_btn_link = explode('|', $tst_btn_link);
            
            if( isset($atst_btn_link[0]) && !empty($atst_btn_link[0]) ){

                $aButtonURL = explode(':', $atst_btn_link[0]);
            }
            if( isset($atst_btn_link[1]) && !empty($atst_btn_link[1]) ){

                $aButtonTitle = explode(':', $atst_btn_link[1]);
            }
        }

        
    
        $backgroundimage = wp_get_attachment_image_src($backgroundimage,'full', true);
        
        $html = '
        <div class="pull-quote">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pull-quote-article" style="background: url('.$backgroundimage[0].') no-repeat center; background-size:cover;">
                        <div class="article-bg" style="background: url('.$backgroundimage[0].') no-repeat; background-size:cover;"></div>
                            <div class="quote-atricle">
                                <div class="quote">
                                    <p>'.$testimonial_heading.'”</p>
                                    <h6><a href="'.(isset($aButtonURL[1])?urldecode($aButtonURL[1]):'').'" class="yellow">'.$tst_btn_title.'</a></h6>
                                </div>
                                
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
new vcSingleTestimonial();