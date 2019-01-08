<?php 
/*
Element Description: Video Gallery
*/
 
// Element Class 
class vcVideoGallery extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_home_video_gallery_mapping' ) );
        add_shortcode( 'vc_home_video_gallery_block', array( $this, 'vc_home_video_gallery_html' ) );
    }
     
    // Element Mapping
     public function vc_home_video_gallery_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('Video Gallery', 'text-domain'),
                'base' => 'vc_home_video_gallery_block',
                'description' => __('Upload image, add a title,content and button with link. Change the text color, background color of button, button color and button text color', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                    
                     
                )
            )
        );                                
            
    }
     
     
    // Element HTML
    public function vc_home_video_gallery_html( $atts ) {
		
		$imagepath = get_template_directory_uri();
		$html= '';

        $html.='<div class="video-gallery">
			<div class="container">
				<div class="row">
					<div class="video-title col-lg-12">
						<div class="title-top">
							<span>Video</span>
						</div>
					</div>
				
				
					<div class="col-sm-12 col-md-8 col-lg-8">					
						<div class="slider slider-for">
							<div class="big-video">
								<iframe width="100%" height="449" src="https://www.youtube.com/embed/OZUAa0Z9RFA" frameborder="0" allowfullscreen></iframe>
							</div>
							
							<div class="big-video">
							
								<iframe width="100%" height="449" src="https://www.youtube.com/embed/a58-DskJC8U" frameborder="0" allowfullscreen></iframe>
							</div>
							
							<div class="big-video">
							
								<iframe width="100%" height="449" src="https://www.youtube.com/embed/d01MKv4pN-c" frameborder="0" allowfullscreen></iframe>
							</div>
							
							<div class="big-video">
							
								<iframe width="100%" height="449" src="https://www.youtube.com/embed/3rQG4yGu2os" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
					</div>
					
 					<div class="col-sm-4 col-lg-4">
					
						
						<div class="video-thumbnails">
							<h3>More Videos</h3>
							<div class="slider slider-nav">
								<div class="videos">
									<div class="thumb-video">
										<img src="'.$imagepath.'/images/thumb-video01.jpg" alt="" />
										<span class="play-icon"></span>
									</div>
									
									<div class="video-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
										<span class="video-cat">Category</span>
									</div>
								</div>
								
								<div class="videos">
									<div class="thumb-video">
										<img src="'.$imagepath.'/images/thumb-video01.jpg" alt="" />
										<span class="play-icon"></span>
									</div>
									
									<div class="video-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
										<span class="video-cat">Category</span>
									</div>
								</div>
								
								<div class="videos">
									<div class="thumb-video">
										<img src="'.$imagepath.'/images/thumb-video01.jpg" alt="" />
										<span class="play-icon"></span>
									</div>
									
									<div class="video-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
										<span class="video-cat">Category</span>
									</div>
								</div>
								
								<div class="videos">
									<div class="thumb-video">
										<img src="'.$imagepath.'/images/thumb-video01.jpg" alt="" />
										<span class="play-icon"></span>
									</div>
									
									<div class="video-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
										<span class="video-cat">Category</span>
									</div>
									
									
								</div>
							
							
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>';
		
		return $html;
         
    }
     
} // End Element Class
 
// Element Class Init
new vcVideoGallery();