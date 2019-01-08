<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcFooterCallToAction extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_footer_call_to_action_mapping' ) );
        add_shortcode( 'vc_footer_call_to_action_block', array( $this, 'vc_footer_call_to_action_html' ) );
    }
     
    // Element Mapping
     public function vc_footer_call_to_action_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('Footer call to action', 'text-domain'),
                'base' => 'vc_footer_call_to_action_block',
                'description' => __('This is a call to action widget with two buttons.', 'text-domain'), 
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
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => '',
                        'heading' => __( 'Upload logo image', 'text-domain' ),
                        'param_name' => 'logoimage',
                        'description' => __( 'Upload logo Image', 'text-domain' ),
                        'group' => 'General',
                    ),        
                      
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'Heading', 'text-domain' ),
                        'param_name' => 'cta_heading',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Button 1 Title', 'text-domain' ),
                        'param_name' => 'cta_btn1_title',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Button 1',
                    ),

                    array(
                        'type' => 'vc_link',
                        'holder' => '',
                        'heading' => __( 'Button 1 Link', 'text-domain' ),
                        'param_name' => 'cta_btn1_link',
                        
                        'description' => __( 'Add URL for Button 1', 'text-domain' ),
                        
                        'group' => 'Button 1',
                    ), 

                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Button 2 Title', 'text-domain' ),
                        'param_name' => 'cta_btn2_title',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Button 2',
                    ),

                    array(
                        'type' => 'vc_link',
                        'holder' => '',
                        'heading' => __( 'Button 2 Link', 'text-domain' ),
                        'param_name' => 'cta_btn2_link',
                        
                        'description' => __( 'Add URL for Button 2', 'text-domain' ),
                        
                        'group' => 'Button 2',
                    ),   
                    
               
                                    
                         
                )
            )
        );                                
            
    }
     
     
    // Element HTML
    public function vc_footer_call_to_action_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'backgroundimage'   => '',
                    'logoimage' => '',
                     'cta_heading'   => '',
                    'cta_btn1_title' => '',
                     'cta_btn1_link'   => '',
                    'cta_btn2_title' => '',
                     'cta_btn2_link'   => '',
                   
                   
                ), 
                $atts
            )
        );
         
        // Fill $html var with data
        // url:%23showrooms|title:custom||
        
        if( isset($cta_btn1_link) && !empty($cta_btn1_link) ){
            
            $acta_btn1_link = explode('|', $cta_btn1_link);
            
            if( isset($acta_btn1_link[0]) && !empty($acta_btn1_link[0]) ){

                $aButtonURL = explode(':', $acta_btn1_link[0]);
            }
            if( isset($acta_btn1_link[1]) && !empty($acta_btn1_link[1]) ){

                $aButtonTitle = explode(':', $acta_btn1_link[1]);
            }
        }

           if( isset($cta_btn2_link) && !empty($cta_btn2_link) ){
            
            $acta_btn2_link = explode('|', $cta_btn2_link);
            
            if( isset($acta_btn2_link[0]) && !empty($acta_btn2_link[0]) ){

                $aButtonURL2 = explode(':', $acta_btn2_link[0]);
            }
            if( isset($acta_btn2_link[1]) && !empty($acta_btn2_link[1]) ){

                $aButtonTitle2 = explode(':', $acta_btn2_link[1]);
            }
        }
    
        $logoimage1 = wp_get_attachment_image_src($logoimage,'full', true);
        $backgroundimage = wp_get_attachment_image_src($backgroundimage,'full', true);
        
        $html = '<div class="request-issue">
        <div class="latest-issue" style="background: url('.$backgroundimage[0].') no-repeat center; background-size:cover;">
            <div class="latest-wrapper">                
                <div class="issue-content">
                    <span class="logo-cc"><img src="'.$logoimage1[0].'" alt="California Closets" /></span>
                    <p>'.$cta_heading.'</p>
                    <div class="button-wrapper">
                        <a href="'.(isset($aButtonURL[1])?urldecode($aButtonURL[1]):'').'" class="btn btn-primary">'.$cta_btn1_title.'</a>
                        <a href="'.(isset($aButtonURL2[1])?urldecode($aButtonURL2[1]):'').'" class="btn btn-primary">'.$cta_btn2_title.'</a>
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
new vcFooterCallToAction();