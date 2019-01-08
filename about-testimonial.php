<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcAboutTestimonial extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_about_testimonial_mapping' ) );
        add_shortcode( 'vc_about_testimonial_block', array( $this, 'vc_about_testimonial_html' ) );
    }
     
    // Element Mapping
     public function vc_about_testimonial_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('About us Testimonial section', 'text-domain'),
                'base' => 'vc_about_testimonial_block',
                'description' => __('This is a About us Testimonial widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   

                      array(
                        'type' => 'textfield',
                        'heading' => __( 'Testimonial Title', 'text-domain' ),
                        'param_name' => 't_heading',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),

                        array(
                        'type' => 'textfield',
                        'heading' => __( 'Position', 'text-domain' ),
                        'param_name' => 't_position',
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
                        'heading' => __( 'Upload Author Image', 'text-domain' ),
                        'param_name' => 'authorimage',
                        'description' => __( 'Upload Author Image', 'text-domain' ),
                        'group' => 'General',
                    ), 


	 array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => '',
                        'heading' => __( 'Upload Book Image', 'text-domain' ),
                        'param_name' => 'bookimage',
                        'description' => __( 'Upload Book Image', 'text-domain' ),
                        'group' => 'General',
                    ),  					

                    array(
                        'type' => 'textarea',
                        'heading' => __( 'Testimonial content', 'text-domain' ),
                        'param_name' => 't_content',
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
    public function vc_about_testimonial_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'backgroundimage'   => '',
                    't_heading' => '',
                     't_position'   => '',
                    't_content' => '',
					'authorimage' => '',
					'bookimage' => '',
                   
                   
                ), 
                $atts
            )
        );
         
     
        
    
        $backgroundimage = wp_get_attachment_image_src($backgroundimage,'full', true);
		 $authorimage = wp_get_attachment_image_src($authorimage,'full', true);
		 $bookimage = wp_get_attachment_image_src($bookimage,'full', true);
       
        
        $html = ' <div class="quote-wrapper">
    <div class="container">
      <div class="quote-block" style="background: url('.$backgroundimage[0].') no-repeat center;">
        <div class="col-md-12 col-lg-8 offset-md-0 offset-lg-2 idea-quote">
          <blockquote class="quote-top">
            <div class="testimonial-block">
              <p><sup><i class="fa fa-quote-left" aria-hidden="true"></i></sup> '.$t_content.' <sup><i class="fa fa-quote-right" aria-hidden="true"></i></sup></p>
            </div>
            <div class="author">
             <figure>
				<img src="'.$authorimage[0].'" alt="" width="54" height="54" class="alignnone size-full wp-image-223703"></figure>
              <p><span class="a-name">'.$t_heading.'</span><span class="by-name">'.$t_position.'</span>
              </p>
            </div>
          </blockquote>
		  
		 
		  
        </div>
		 <div class="magazineflat-mm"><img src="'.$bookimage[0].'" alt="" width=""></div>
       
      </div>
    </div>
  </div>
  

       
        ';      
         
        return $html;
         
    }
     
} // End Element Class
 
// Element Class Init
new vcAboutTestimonial();