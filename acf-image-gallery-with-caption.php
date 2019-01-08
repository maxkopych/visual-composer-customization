<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcAcfGallery extends WPBakeryShortCode {
     
    function __construct() {
        add_action( 'init', array( $this, 'vc_acf_image_gallery_caption_mapping' ) );
        add_shortcode( 'vc_acf_image_gallery_caption_block', array( $this, 'vc_acf_image_gallery_caption_html' ) );
    }
     
    // Element Mapping
     public function vc_acf_image_gallery_caption_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('ACF Image Gallery with caption', 'text-domain'),
                'base' => 'vc_acf_image_gallery_caption_block',
                'description' => __('This is a Image gallery with caption widget.', 'text-domain'), 
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
    public function vc_acf_image_gallery_caption_html( $atts ) {
         

        extract(
            shortcode_atts(
                array(
                    'customgallerycap'   => '',
                   
                    
                   
                   
                ), 
                $atts
            )
        );
   $html = '<div class="photo-gallery-article"><ul>';
        // check if the repeater field has rows of data
if( have_rows('image_gallery_with_captions') ):

    // loop through the rows of data
    $k = 0;
    while ( have_rows('image_gallery_with_captions') ) : the_row();
$imgsrc= get_sub_field('image');
$imgs = $imgsrc['sizes']['photo-gallery-with-caption'];
$imgcap = get_sub_field('image_caption'); 
 $html .= '<li><a id="'.$k.'" class="gallery-post-popup" href="#inline1"><img src= "'.$imgs.'"></a><!--<p>'.$imgcap.'</p>--></li>';
        // display a sub field value
$k++;
    endwhile;

else :

    // no rows found

endif;
$html .= '</ul>
<script>
jQuery(".gallery-post-popup").click(function(){
    var imgid = $(this).attr("id");
        
    jQuery(".photo-gallery-big").trigger("to.owl.carousel", imgid)
  });
</script>
	  
	  	<div id="inline1" class="gallery-slider-popup" style="max-width:1280px; display: none;">
		<div class="owl-carousel photo-gallery-big owl-theme">';
        if( have_rows('image_gallery_with_captions') ):
$my_fields = get_field_object('image_gallery_with_captions');
   $count = (count($my_fields['value']));
    // loop through the rows of data
   $i = 00;
    while ( have_rows('image_gallery_with_captions') ) : the_row();
    $i++;
$imgsrc= get_sub_field('image');
$imgs = $imgsrc['url'];
$imgcap = get_sub_field('image_caption'); 
$image_title = get_sub_field('image_title'); 
$photo_credit = get_sub_field('photo_credit'); 
			$html .= '<div class="item"><div class="row">
			
				<div class="col-sm-12 col-md-12 col-lg-9 gallery-big-image">
					<img src="'.$imgs.'" alt="">
				</div>
			
				<div class="col-sm-12 col-md-12 col-lg-3 slider-content-right">
				<div class="photo-gallery-content">
				
				<span class="slidr-number">'.$i.'/'. $count .'</span>
				
				<h3>'.$image_title.'</h3>
				<div id="counter"></div> 
				<p>
					'.$imgcap.'
				</p>
				
				<p class="photo-credit">Photo Credit: '.$photo_credit.' </p>
                <div class="popup-social">';
                
                $aaa = requireToVar(ABSPATH.'wp-content/themes/ideasorder/social-share.php');
                $html .= $aaa.'</div>
				</div></div>
			</div></div>';
			
   endwhile;

else :

    // no rows found

endif;
	$html .= '</div>
	
	  </div>'; 
      return $html;
                
                  
    }
     
} // End Element Class
 function requireToVar($file){
    ob_start();
    require($file);
    return ob_get_clean();
}
// Element Class Init
new vcAcfGallery();