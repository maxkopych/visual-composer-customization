<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcCustomGallery extends WPBakeryShortCode {
     
    function __construct() {
        add_action( 'init', array( $this, 'vc_custom_image_gallery_mapping' ) );
        add_shortcode( 'vc_custom_image_gallery_block', array( $this, 'vc_custom_image_gallery_html' ) );
    }
     
    // Element Mapping
     public function vc_custom_image_gallery_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('Custom Image Gallery', 'text-domain'),
                'base' => 'vc_custom_image_gallery_block',
                'description' => __('This is a Image gallery widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                    
                      
                      
                      
                     array(
                        'type' => 'attach_images',
                        'heading' => __( 'Upload gallery Images', 'text-domain' ),
                        'param_name' => 'customgallery',
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
    public function vc_custom_image_gallery_html( $atts ) {
         

        extract(
            shortcode_atts(
                array(
                    'customgallery'   => '',
                   
                    
                   
                   
                ), 
                $atts
            )
        );
         
        // Fill $html var with data
        // url:%23showrooms|title:custom||
       $custgal=  explode(',', $customgallery);
   $html = '<div class="custmglry"><div class="row">';

        foreach ($custgal as $value) {
          $srcfull = wp_get_attachment_image_src($value, 'full', false );
         $src = wp_get_attachment_image_src($value, 'ins-gallery', false );
         $html .= '<div class="col-lg-6 padd10"><div class="custmglry-gallery"><a href="'.$srcfull[0].'" class="fancybox1" data-fancybox-group="gallery" title="aaaa" ><img src= "'.$src[0].'"><span class="expand"></span></a></div></div>';
        }
      $html .= '</div></div>'; 
      return $html;
                
                  
    }
   
     
} // End Element Class
 
// Element Class Init
new vcCustomGallery();