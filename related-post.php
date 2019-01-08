<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcRelatedPost extends WPBakeryShortCode {
     
    function __construct() {
        add_action( 'init', array( $this, 'vc_related_posts_mapping' ) );
        add_shortcode( 'vc_related_posts_block', array( $this, 'vc_related_posts_html' ) );
    }
     
    // Element Mapping
     public function vc_related_posts_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }

        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('Related Posts', 'text-domain'),
                'base' => 'vc_related_posts_block',
                'description' => __('This is a Space posts widget.', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                    
                      
                     array(
                      'type'        => 'dropdown',
                      'heading' => __( 'Order', 'text-domain' ),
                      'param_name'  => 'sorder',
                      'admin_label' => false,
                      'value'       => array(
                        'Select' => '',
                        'Asc'   => 'ASC',
                        'Desc'  => 'DESC',
                      ),
                      'std'         => 'DESC', // Your default value
                      'edit_field_class' => '',
                      'group' => 'General',
                    ),
                   
                    
                      
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'No. of posts', 'text-domain' ),
                        'param_name' => 'spacenum',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'std'         => 3,
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
    public function vc_related_posts_html( $atts ) {
         

        extract(
            shortcode_atts(
                array(
                    'sorder'   => '',
                    'spacenum' => '',
                     'rspacenum'   => '',

                ), 
                $atts
            )
        );
         
        // Fill $html var with data
        // url:%23showrooms|title:custom||
      
$tags = get_tags();
$tagarray = '';
foreach ( $tags as $tag ) {
  $tagarray[] = $tag->term_id;
}

$posttype= get_post_type( get_the_ID() );



    $args = array(
      'post_type' => $posttype,
      'post__not_in' => array(get_the_ID()),
    'tag__in' => $tagarray,
    'posts_per_page' => $spacenum,
    'order' => $sorder,
    'post_status'     => 'publish'
   
);

    $the_query = new WP_Query( $args );
     $html = '';
if ( $the_query->have_posts() ) {
 $html .= '<div class="container">
        <div class="title-top">
          <span>Related</span>
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
      </div>';
}
if ( $the_query->have_posts() ) {
      $html .= '<div class="inspiration">
            <div class="container">
              
            
                <div class=""><div class="related-carousel related-post owl-theme row">';

    while ( $the_query->have_posts() ) {
        $the_query->the_post();
      if($posttype == 'inspiration')
      {
        $src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'ins-featured', false );
      }
      else
      {
    $src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'related-posts', false );

}
       
        if($rspacenum == 2)
        {
            $rnum = '6';
        }
       
        else if($rspacenum == 4)
        {
            $rnum = '3';
        }
        else {
            $rnum = '4';
        }
       $cat = '';
            if ( has_term('','spaces_cat') ) {
          
        $category_detail=get_the_terms( get_the_ID(), 'spaces_cat' );//$post->ID
         if(isset($category_detail) && !empty($category_detail))
        {
foreach($category_detail as $cd){
 $trmlink = get_term_link($cd->term_id, 'spaces_cat');
 $cat .= '<a href="'.$trmlink.'">'.$cd->name.'</a>, ';
}
$cat = rtrim($cat,', ');
}

}
else if(has_term('','inspiration_cat'))
{
        $category_detail=get_the_terms( get_the_ID(), 'inspiration_cat' );//$post->ID
         if(isset($category_detail) && !empty($category_detail))
        {
foreach($category_detail as $cd){
 $trmlink = get_term_link($cd->term_id, 'inspiration_cat');
 $cat .= '<a href="'.$trmlink.'">'.$cd->name.'</a>, ';
}
$cat = rtrim($cat,', ');
}
}
else if(has_term('','features_cat'))
{
        $category_detail=get_the_terms( get_the_ID(), 'features_cat' );//$post->ID
         if(isset($category_detail) && !empty($category_detail))
        {
foreach($category_detail as $cd){
 $trmlink = get_term_link($cd->term_id, 'features_cat');
 $cat .= '<a href="'.$trmlink.'">'.$cd->name.'</a>, ';
}
$cat = rtrim($cat,', ');
}
}
     
       
       $html .= '<div class="col-md-6 col-lg-'.$rnum.' col-12 item">
                        <div class="article-inspiration">
                        <figure><a href="'.get_permalink().'" ><img src="'.$src[0].'" alt=""/></a></figure>
                        <div class="article-content">
                            <span class="small-size">'.$cat.'</span>
                            <h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>
                            <p><a href="'.get_permalink().'" >'.get_the_excerpt().'</a></p>
                        </div>
                        </div>
                    </div>';
    }
    
    /* Restore original Post Data */
    wp_reset_postdata();

      $html .= ' </div>
            </div>
        </div></div>
       
        ';      
  } else {
    // no posts found
}  


         
        return $html;
        
        
                
                  
    }
     
} // End Element Class
 
// Element Class Init
new vcRelatedPost();