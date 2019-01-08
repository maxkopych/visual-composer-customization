<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcpfilter extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_p_filter_mapping' ) );
        add_shortcode( 'vc_p_filter_block', array( $this, 'vc_p_filter_html' ) );
    }
     
    // Element Mapping
     public function vc_p_filter_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('Post Filter', 'text-domain'),
                'base' => 'vc_p_filter_block',
                'description' => __('This is a Post Filter widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                    
                      
                     array(
                      'type'        => 'dropdown',
                      'heading' => __( 'Select post type', 'text-domain' ),
                      'param_name'  => 'ptypes',
                      'admin_label' => false,
                      'value'       => array(
                        'Select' => '',
                        'Spaces'   => 'spaces_cat',
                        'Features'  => 'features_cat',
                        'Inspiration'  => 'inspiration_cat',
                      ),
                      'std'         => '', // Your default value
                      'edit_field_class' => '',
                      'group' => 'General',
                    ),      
                      

                     array(
                        'type' => 'textfield',
                        'heading' => __( 'Heading', 'text-domain' ),
                        'param_name' => 'shead',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'std'         => '',
                        'edit_field_class' => '',
                        'group' => 'General',
                    ),

                       array(
                      'type'        => 'dropdown',
                      'heading' => __( 'No. of posts per row', 'text-domain' ),
                      'param_name'  => 'rspacenum',
                      'admin_label' => false,
                      'value'       => array(
                        '2'   => 2,
                        '3'  => 3,
                        '4'  => 4,
                      ),
                      'std'         => 3, // Your default value
                      'edit_field_class' => '',
                      'group' => 'General',
                    ), 
                               
                         
                )
            )
        );                                
            
    }
     
     
    // Element HTML
    public function vc_p_filter_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'ptypes'   => '',
                    'shead' => '',
                    'rspacenum' => '',
                   
                ), 
                $atts
            )
        );
         
     

       $html = '
<div class="page-title">
      <div class="container">
        <div class="title-wrap">
          <div class="row">         
            <div class="col-6 col-md-5 col-lg-3">      
              <h1 class="section-title">'.$shead.'</h1>
            </div>    

            <div class="col-6 col-md-7 col-lg-9">    
				<div class="filter-dropdown">
					<div><span class="fa fa-angle-down" aria-hidden="true"></span> <span class="cattext">All</span></div>
				</div>
              <ul class="filtering">
              <li><a href="javascript:void(0);" id="all" class="active">All</a></li>';
              $terms = get_terms( array(
    'taxonomy' => $ptypes,
    'hide_empty' => true,
) ); 
              foreach ( $terms as $term ) {
 $trmlink = get_term_link($term->term_id, $ptypes);
                $html .= '<li><a href="'.$trmlink.'">'.$term->name.'</a></li>';

              }
              
               $html .= '</ul>
            </div>              
          </div>      
        </div>    
      </div>
    </div><input type="hidden" id="rpnum" value="'.$rspacenum.'">';

      
              
        return $html;
        
        
                    
             
         
    }
     
} // End Element Class
 
// Element Class Init
new vcpfilter();