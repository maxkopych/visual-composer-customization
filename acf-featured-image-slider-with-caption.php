<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcAcfSlider extends WPBakeryShortCode {
     
    function __construct() {
        add_action( 'init', array( $this, 'vc_acf_featured_image_slider_caption_mapping' ) );
        add_shortcode( 'vc_acf_featured_image_slider_caption_block', array( $this, 'vc_acf_featured_image_slider_caption_html' ) );
    }
     
    // Element Mapping
     public function vc_acf_featured_image_slider_caption_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('ACF Features Slider with caption', 'text-domain'),
                'base' => 'vc_acf_featured_image_slider_caption_block',
                'description' => __('This is a Image Slider with caption widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                    
                      
                      
                      
                     array(
                        'type' => 'heading',
                        'heading' => __( 'Customize your image gallery from the ACF section in bottom of the page.', 'text-domain' ),
                        'param_name' => 'customgallerycap',
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
    public function vc_acf_featured_image_slider_caption_html( $atts ) {
         

        extract(
            shortcode_atts(
                array(
                    'customgallerycap'   => '',
                   
                    
                   
                   
                ), 
                $atts
            )
        );
           $html = '<div class="feature-slider-outer">
            <div class="owl-carousel feature-slider owl-theme">';

        if( have_rows('image_gallery_with_captions') ):

    // loop through the rows of data
    while ( have_rows('image_gallery_with_captions') ) : the_row();
$imgsrc= get_sub_field('image');
$imgs = $imgsrc['url'];
$imgcap = get_sub_field('image_caption'); 

   $html .= '<div class="item">
					<img src="'.$imgs.'" />
					<div class="bq-caption bq-caption1">
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
new vcAcfSlider();