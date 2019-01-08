<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcAcfSlider3 extends WPBakeryShortCode {
     
    function __construct() {
        add_action( 'init', array( $this, 'vc_acf_featured_image_slider_caption3_mapping' ) );
        add_shortcode( 'vc_acf_featured_image_slider_caption3_block', array( $this, 'vc_acf_featured_image_slider_caption3_html' ) );
    }
     
    // Element Mapping
     public function vc_acf_featured_image_slider_caption3_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('ACF Features slider with caption 3', 'text-domain'),
                'base' => 'vc_acf_featured_image_slider_caption3_block',
                'description' => __('This is a Image Slider with caption widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                    
                      
                      
                      
                     array(
                        'type' => 'heading',
                        'heading' => __( 'Customize your image gallery from the ACF Gallery section 2 in bottom of the page.', 'text-domain' ),
                        'param_name' => 'customgallerycap3',
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
    public function vc_acf_featured_image_slider_caption3_html( $atts ) {
         

        extract(
            shortcode_atts(
                array(
                    'customgallerycap3'   => '',
                   
                    
                   
                   
                ), 
                $atts
            )
        );
           $html = '<div class="feature-slider-outer">
            <div class="owl-carousel feature-slider owl-theme">';

        if( have_rows('image_gallery_with_captions3') ):

    // loop through the rows of data
    while ( have_rows('image_gallery_with_captions3') ) : the_row();
$imgsrc= get_sub_field('image3');
$imgs = $imgsrc['url'];
$imgcap = get_sub_field('image_caption3'); 

   $html .= '<div class="item">
					<img src="'.$imgs.'" />
					<div class="bq-caption bq-caption3">
					'.$imgcap.'
					</div>
				</div>';
				
    endwhile;

else :

    // no rows found

endif;
			$html .= '</div>	
   </div>'; 
      return $html;
                
                  
    }
     
} // End Element Class
 
// Element Class Init
new vcAcfSlider3();