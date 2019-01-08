<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcFooterRequestConsultation extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_request_consultation_mapping' ) );
        add_shortcode( 'vc_request_consultation_block', array( $this, 'vc_request_consultation_html' ) );
    }
     
    // Element Mapping
     public function vc_request_consultation_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('Footer Request Consultation', 'text-domain'),
                'base' => 'vc_request_consultation_block',
                'description' => __('This is a Request consultation widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                    
                    
                      
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'Heading', 'text-domain' ),
                        'param_name' => 'rc_heading',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Submit Button Title', 'text-domain' ),
                        'param_name' => 'rc_btn_title',
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
    public function vc_request_consultation_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'rc_heading'   => '',
                    'rc_btn_title' => '',
         
                ), 
                $atts
            )
        );
         
        // Fill $html var with data
        // url:%23showrooms|title:custom||
        
        
        $html = '
            <div class="rfc-footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="rfc-footer-content">
                            <span class="rfc-label">'.$rc_heading.'</span>
                            
							
                            <div class="rfc-newsletter-form">
                               <form action="" method="post" name="rcform" id="rfcform2" class="signup-form">
                                   
                            <div class="form-group">
<div class="row">
                         <div class="col">
                          <input type="text" name="first_name" class="form-control" placeholder="First Name">
                        </div>
                        
                        <div class="col">
                          <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                        </div>
                   
                        <div class="col"> 
						<input type="text" class="form-control input-sm" id="signupEmail" name="email" placeholder="Email Address"></div>
                                       
					 <div class="col">
                          <input type="text" name="phone" id="rphone" onblur="formatPhone(this);" onkeyup="formatPhone(this);" class="form-control" placeholder="Phone Number">
                        </div>

                        <div class="col">
                          <input type="text" name="city_state_zip2" id="city_state_zip3" class="form-control" placeholder="Zip/Postal Code">
                        </div>
						</div>
                        <div class="modal-privacy">                 
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" id="ragree" name="ragree" class="custom-control-input" >
                            <span class="custom-control-indicator" ></span>
                            <span class="custom-control-description"> I agree with the <a href="'.home_url().'/terms-conditions/">terms of use</a> and <a class="ppc" href="'.home_url().'/privacy-policy/">privacy policy</a>
                        </label>
                        </div>
                         <div>
                         <img src="'.home_url().'/wp-content/themes/ideasorder/images/ajax-loader.gif" id="ajaxloaderimg">
                                       <button id="btnrfcsubmit" name="btnrfcsubmit" type="submit" class="btn btn-primary">'.$rc_btn_title.'</button>
                                       </div>
                                    </div>
                                </form>
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
new vcFooterRequestConsultation();