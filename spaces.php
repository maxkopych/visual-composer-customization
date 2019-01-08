<?php 
/*
Element Description: Service Box
*/
 
// Element Class 
class vcSpaces extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_spaces_posts_mapping' ) );
        add_shortcode( 'vc_spaces_posts_block', array( $this, 'vc_spaces_posts_html' ) );
    }
     
    // Element Mapping
     public function vc_spaces_posts_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }


        // Map the block with vc_map()
        vc_map( 
      
            array(
                'name' => __('Spaces Posts', 'text-domain'),
                'base' => 'vc_spaces_posts_block',
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
                        "type"          => "checkbox",
                        "admin_label"   => false,
                        "weight"        => 0,
                        "heading"       => __( "Show featured posts", "js_composer" ),
                        "description"   => __("Do you want to show featured posts. If yes then please check the checkbox.", "js_composer"),
                        "value"         => array('Yes'   => 'yes' ),
                        "param_name"    => "show_featured",
                        'group' => 'General',
                    ),

                    array(
                        "type"          => "checkbox",
                        "admin_label"   => false,
                        "weight"        => 0,
                        "heading"       => __( "Show Category name on post", "js_composer" ),
                        "description"   => __("Do you want to show category name on post. If yes then please check the checkbox.", "js_composer"),
                        "value"         => array('Yes'   => 'yes' ),
                        "param_name"    => "show_cat",
                        'group' => 'General',
                    ),

                     array(
                        'type' => 'textfield',
                        'heading' => __( 'No. of posts', 'text-domain' ),
                        'param_name' => 'spacenum',
                        'value' => '',
                        'admin_label' => false,
                        'weight' => 0,
                        'std'         => -1,
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
    public function vc_spaces_posts_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'sorder'   => '',
                    'spacenum' => '',
                     'rspacenum'   => '',
                     'show_featured'   => '',
                     'show_cat'   => '',
                      'cats' => '',
                    
                   
                   
                ), 
                $atts
            )
        );
         
        // Fill $html var with data
        // url:%23showrooms|title:custom||
      $fet= '';
if(isset($cats) && !empty($cats) && $cats != 'all')
{
if($show_featured == 'yes')
{
   $fet= 'featuredpost';

    $args = array(
    'post_type' => 'spaces',
    'posts_per_page' => $spacenum,
    'order' => $sorder,
    'post_status'     => 'publish',
    
    'tax_query' => array(
        array(
            'taxonomy' => 'spaces_cat',
            'field'    => 'id',
            'terms'    => $cats,
        ),
    ),
    'meta_query' => array(
        array(
            'key'     => 'is_this_post_featured',
            'value'   => 'yes',
            'compare' => '=',
        ),
    ),

   
);
       
    }
else {
    $fet= 'nofeature';
    $args = array(
    'post_type' => 'spaces',
    'posts_per_page' => $spacenum,
    'order' => $sorder,
    'post_status'     => 'publish',
     
   'tax_query' => array(
        array(
            'taxonomy' => 'spaces_cat',
            'field'    => 'id',
            'terms'    => $cats,
        ),
    ),
   
   
);
       

}

}
else 
{
if($show_featured == 'yes')
{
    $fet= 'featuredpost';

    $args = array(
    'post_type' => 'spaces',
    'posts_per_page' => $spacenum,
    'order' => $sorder,
    'post_status'     => 'publish',
     
    'meta_query' => array(
        array(
            'key'     => 'is_this_post_featured',
            'value'   => 'yes',
            'compare' => '=',
        ),
    ),
   
);
       
    }
else {
    $fet= 'nofeature';
    $args = array(
    'post_type' => 'spaces',
    'posts_per_page' => $spacenum,
    'order' => $sorder,
    'post_status'     => 'publish',
      'meta_query' => array(
        array(
            'key'     => 'is_this_post_featured',
            'value'   => 'yes',
            'compare' => '!=',
        ),
    )
   
   
);
       

}
}

include_once(ABSPATH.'wp-content/themes/ideasorder/inc/Mobile_Detect.php');
$detect = new Mobile_Detect;
$the_query = new WP_Query( $args );
if($show_featured == 'yes' && $detect->isMobile() && !$detect->isTablet())
{
  $rspacenum = 3;
  $rnum = '4';
             $html = '
         <div class="inspiration '.$fet.'">
      <div class="container">
        <div class="row">';
}
else
{

 if($rspacenum == 2)
        {
            $rnum = '6';
            $html = '
        <div class="spaces '.$fet.'">
            <div class="container">
                <div class="row">';
        }
       
        else if($rspacenum == 4)
        {
            $rnum = '3';
             $html = '
         <div class="inspiration '.$fet.'">
      <div class="container">
        <div class="row">';
        }
        else {
            $rnum = '4';
             $html = '
         <div class="inspiration '.$fet.'">
      <div class="container">
        <div class="row">';
        }
 } 
 
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
               $cat = '';
        $category_detail=get_the_terms( get_the_ID(), 'spaces_cat' );//$post->ID
        if(isset($category_detail) && !empty($category_detail))
        {
foreach($category_detail as $cd){
  
 $trmlink = get_term_link($cd->term_id, 'spaces_cat');
 $cat .= '<a href="'.$trmlink.'">'.$cd->name.'</a>, ';
}
$cat = rtrim($cat,', ');
}
     $mobanner = get_field('mobile_banner_image');

     if(isset($mobanner) && !empty($mobanner) && $detect->isMobile() ){
     $src[0] = $mobanner;
}else{
    $src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'space-featured', false );
  
}




       if($rspacenum == 2)
        {
       $html .= '<div class="col-md-6 col-lg-'.$rnum.'">
                        <div class="space-box">
                            <figure>';
                            if($show_cat == 'yes' && $rspacenum == 2)
                            {
                                $html .= '<span class="category-text small-size">'.$cat.'</span>';
                            }
                            $html .='<a href="'.get_permalink().'" ><img src="'.$src[0].'" alt=""/></a></figure>
                            <div class="spaces-content">';
                            $html .= '<a href="'.get_permalink().'" >
                                <h3>'.get_the_title().'</h3>
                                <p>'.get_the_excerpt().'</p>
                                <h6><span class="yellow">Read Full Story</span></h6></a>
                            </div>
                        </div>
                    </div>';
                }
        else {

             $html .= ' <div class="col-md-6 col-lg-'.$rnum.'">
                        <div class="article-inspiration space-article">
                            <figure>';
                           
                            $html .='<a href="'.get_permalink().'" ><img src="'.$src[0].'" alt=""/></a></figure>
                            <div class="article-content">';
                             if($show_cat == 'yes' && $rspacenum > 2)
                            {
                                $html .= '<span class="small-size">'.$cat.'</span>';
                            }
                            $html .= '
                                <a href="'.get_permalink().'" ><h5>'.get_the_title().'</h5>
                                <p>'.get_the_excerpt().'</p></a>
                               <a href="'.get_permalink().'"><h6><span class="yellow">Read Full Story</span></h6></a>
                            </div>
                        </div>
                    </div>';
        }
    }
?>

        <?php //pagination_bar( $the_query ); ?>

<?php
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
}
      $html .= ' </div>
            </div>
        </div>
       
        ';      
         
       
        
        
                  
          return $html;    
         
    }
   

     
} // End Element Class
 
// Element Class Init
 function my_action() {
    $catid= $_REQUEST['catid'];
     $post_per_row= $_REQUEST['post_per_row'];
 echo do_shortcode('[vc_spaces_posts_block cats='.$catid.' rspacenum='.$post_per_row.']');
    wp_die(); // this is required to terminate immediately and return a proper response
}

    add_action( 'wp_ajax_my_action', 'my_action' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action' );


new vcSpaces();