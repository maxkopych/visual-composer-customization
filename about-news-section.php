<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcAboutNews extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_about_news_mapping' ) );
        add_shortcode( 'vc_about_news_block', array( $this, 'vc_about_news_html' ) );
    }
     
    // Element Mapping
     public function vc_about_news_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('About us News section', 'text-domain'),
                'base' => 'vc_about_news_block',
                'description' => __('This is a About us News section widget.', 'text-domain'), 
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
                        'type' => 'textarea',
                        'heading' => __( 'Content in desktop', 'text-domain' ),
                        'param_name' => 'v_sub_head',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                         array(
                        'type' => 'textarea',
                        'heading' => __( 'Content in mobile', 'text-domain' ),
                        'param_name' => 'v_sub_head_mob',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                         array(
                        'type' => 'textfield',
                        'heading' => __( 'Post 1 Title', 'text-domain' ),
                        'param_name' => 'p_title1',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'News',
                    ),
                         array(
                        'type' => 'textfield',
                        'heading' => __( 'Post 1 Content', 'text-domain' ),
                        'param_name' => 'p_content1',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'News',
                    ),
                         array(
                        'type' => 'vc_link',
                        'holder' => '',
                        'heading' => __( 'Post 1 link', 'text-domain' ),
                        'param_name' => 'p_link1',
                        
                        'description' => __( 'Add URL for Button', 'text-domain' ),
                        
                        'group' => 'News',
                    ), 
                          array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => '',
                        'heading' => __( 'Upload Post 1 image', 'text-domain' ),
                        'param_name' => 'pimage1',
                        'description' => __( 'Upload Post 1 Image', 'text-domain' ),
                        'group' => 'News',
                    ),  

                        array(
                        'type' => 'textfield',
                        'heading' => __( 'Post 2 Title', 'text-domain' ),
                        'param_name' => 'p_title2',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'News',
                    ),
                         array(
                        'type' => 'textfield',
                        'heading' => __( 'Post 2 Content', 'text-domain' ),
                        'param_name' => 'p_content2',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'News',
                    ),
                         array(
                        'type' => 'vc_link',
                        'holder' => '',
                        'heading' => __( 'Post 2 link', 'text-domain' ),
                        'param_name' => 'p_link2',
                        
                        'description' => __( 'Add URL for Button', 'text-domain' ),
                        
                        'group' => 'News',
                    ), 
                          array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => '',
                        'heading' => __( 'Upload Post 2 image', 'text-domain' ),
                        'param_name' => 'pimage2',
                        'description' => __( 'Upload Post 2 Image', 'text-domain' ),
                        'group' => 'News',
                    ),  
                   
                   array(
                        'type' => 'textfield',
                        'heading' => __( 'Post 3 Title', 'text-domain' ),
                        'param_name' => 'p_title3',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'News',
                    ),
                         array(
                        'type' => 'textfield',
                        'heading' => __( 'Post 3 Content', 'text-domain' ),
                        'param_name' => 'p_content3',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'News',
                    ),
                         array(
                        'type' => 'vc_link',
                        'holder' => '',
                        'heading' => __( 'Post 3 link', 'text-domain' ),
                        'param_name' => 'p_link3',
                        
                        'description' => __( 'Add URL for Button', 'text-domain' ),
                        
                        'group' => 'News',
                    ), 
                          array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => '',
                        'heading' => __( 'Upload Post 3 image', 'text-domain' ),
                        'param_name' => 'pimage3',
                        'description' => __( 'Upload Post 3 Image', 'text-domain' ),
                        'group' => 'News',
                    ),  

                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Right side title', 'text-domain' ),
                        'param_name' => 'r_title',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Right side section',
                    ),
                     array(
                        'type' => 'textarea_html',
                        'heading' => __( 'Right side content', 'text-domain' ),
                        'param_name' => 'r_content',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Right side section',
                    ),

                                    
                         
                )
            )
        );                                
            
    }
     
     
    // Element HTML
    public function vc_about_news_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'v_heading'   => '',
                    'v_sub_head' => '',
                     'v_sub_head_mob' => '',
                     'p_title1'   => '',
                    'p_content1' => '',
                    'p_link1' => '',
                     'pimage1'   => '',
                    'p_title2' => '',
                     'p_content2'   => '',
                    'p_link2' => '',
                    'pimage2' => '',
                     'p_title3' => '',
                     'p_content3'   => '',
                    'p_link3' => '',
                    'pimage3' => '',
                    'r_title' => '',
                    'r_content' => '',
                   
                   
                ), 
                $atts
            )
        );
         
     
         if( isset($p_link1) && !empty($p_link1) ){
            
            $ap_link1 = explode('|', $p_link1);
            
            if( isset($ap_link1[0]) && !empty($ap_link1[0]) ){

                $aButtonURL1 = explode(':', $ap_link1[0]);
            }
            if( isset($ap_link1[1]) && !empty($ap_link1[1]) ){

                $aButtonTitle1 = explode(':', $ap_link1[1]);
            }
        }
    
 if( isset($p_link2) && !empty($p_link2) ){
            
            $ap_link2 = explode('|', $p_link2);
            
            if( isset($ap_link2[0]) && !empty($ap_link2[0]) ){

                $aButtonURL2 = explode(':', $ap_link2[0]);
            }
            if( isset($ap_link2[1]) && !empty($ap_link2[1]) ){

                $aButtonTitle2 = explode(':', $ap_link2[1]);
            }
        }

         if( isset($p_link3) && !empty($p_link3) ){
            
            $ap_link3 = explode('|', $p_link3);
            
            if( isset($ap_link3[0]) && !empty($ap_link3[0]) ){

                $aButtonURL3 = explode(':', $ap_link3[0]);
            }
            if( isset($ap_link3[1]) && !empty($ap_link3[1]) ){

                $aButtonTitle3 = explode(':', $ap_link3[1]);
            }
        }

      
       $pimage1 = wp_get_attachment_image_src($pimage1,'full', true);
       $pimage2 = wp_get_attachment_image_src($pimage2,'full', true);
       $pimage3 = wp_get_attachment_image_src($pimage3,'full', true);
        
        $html = '<div class="press-pr">
    <div class="container">
      <div class="row">
	  
	  
	  
	   <div class="col-12 mobile-content">
	     <div class="press-title">
            <h2>'.$v_heading.'</h2>
            <h3>'.$v_sub_head_mob.'</h3>
          </div>
	  </div>
	  
	  
	   <div class="col-lg-4 col-md-5 col-12 mobile-content">
          <div class="pr-address-wrap">
            <h2>'.$r_title.'</h2>
            <address class="pr-address">
           '.$r_content.'
            </address>
          </div>
        </div>
	  
	  
        <div class="col-lg-8 col-md-7 col-12">
          <div class="press-title desktop-content">
            <h2>'.$v_heading.'</h2>
            <h3>'.$v_sub_head.'</h3>
          </div>
          
          <div class="press-items-box">';
          if(!empty($p_title1)){

             $html .= '<div class="press-item">
              <div class="row">
                <div class="press-item-image">
                  <div class="item-img">
                    <span>
                      <img src="'.$pimage1[0].'" alt="" />
                    </span>
                  </div>
                </div>
                
                <div class="col-lg-10 col-md-8 col-8">
                  <div class="press-item-content">
                    <h3 class="item-title">'.$p_title1.'</h3>
                    <p>'.$p_content1.'</p>
                    <p><a target="_blank" href="'.(isset($aButtonURL1[1])?urldecode($aButtonURL1[1]):'').'" class="small-size">READ MORE</a></p>
                  </div>
                </div>
              </div>
            </div>';
        }
        if(!empty($p_title2)){
            
            $html .= '<div class="press-item">
              <div class="row">
                <div class="press-item-image">
                  <div class="item-img">
                    <span>
                      <img src="'.$pimage2[0].'" alt="" />
                    </span>
                  </div>
                </div>
                
                <div class="col-lg-10 col-md-8 col-8">
                  <div class="press-item-content">
                    <h3 class="item-title">'.$p_title2.'</h3>
                    <p>'.$p_content2.'</p>
                    <p><a target="_blank" href="'.(isset($aButtonURL2[1])?urldecode($aButtonURL2[1]):'').'" class="small-size">READ MORE</a></p>
                  </div>
                </div>
              </div>
            </div>';
              }
        if(!empty($p_title3)){

              $html .= '<div class="press-item">
              <div class="row">
                <div class="press-item-image">
                  <div class="item-img">
                    <span>
                      <img src="'.$pimage3[0].'" alt="" />
                    </span>
                  </div>
                </div>
                
                <div class="col-lg-10 col-md-8 col-8">
                  <div class="press-item-content">
                    <h3 class="item-title">'.$p_title3.'</h3>
                    <p>'.$p_content3.'</p>
                    <p><a target="_blank" href="'.(isset($aButtonURL3[1])?urldecode($aButtonURL3[1]):'').'" class="small-size">READ MORE</a></p>
                  </div>
                </div>
              </div>
            </div>';
        } 
         $html .= '</div>
        </div>
        
        <div class="col-lg-4 col-md-5 col-12 desktop-content">
          <div class="pr-address-wrap">
            <h2>'.$r_title.'</h2>
            <address class="pr-address">
           '.$r_content.'
            </address>
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
new vcAboutNews();