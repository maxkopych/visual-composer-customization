<?php
/*
Element Description: Service Box
*/

// Element Class 
class vcInspiration extends WPBakeryShortCode
{

  function __construct()
  {
    add_action('init', array($this, 'vc_inspiration_posts_mapping'));
    add_shortcode('vc_inspiration_posts_block', array($this, 'vc_inspiration_posts_html'));
  }

  // Element Mapping
  public function vc_inspiration_posts_mapping()
  {
    // Stop all if VC is not enabled
    if (!defined('WPB_VC_VERSION')) {
      return;
    }

    // Map the block with vc_map()
    vc_map(

      array(
        'name' => __('Inspiration Posts', 'text-domain'),
        'base' => 'vc_inspiration_posts_block',
        'description' => __('This is a Space posts widget.', 'text-domain'),
        'category' => __('My Custom Elements', 'text-domain'),
        'icon' => get_template_directory_uri() . '/assets/img/vc-icon.png',
        'params' => array(


          array(
            'type' => 'dropdown',
            'heading' => __('Order', 'text-domain'),
            'param_name' => 'sorder',
            'admin_label' => false,
            'value' => array(
              'Select' => '',
              'Asc' => 'ASC',
              'Desc' => 'DESC',
            ),
            'std' => 'DESC', // Your default value
            'edit_field_class' => '',
            'group' => 'General',
          ),
          array(
            "type" => "checkbox",
            "admin_label" => false,
            "weight" => 0,
            "heading" => __("Show only featured posts", "js_composer"),
            "description" => __("Do you want to show only featured posts. If yes then please check the checkbox.", "js_composer"),
            "value" => array('Yes' => 'yes'),
            "param_name" => "show_featured",
            'group' => 'General',
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('Select Design', 'text-domain'),
            'param_name' => 'idesign',
            'admin_label' => false,
            'value' => array(
              'Standard' => 'Standard',
              'Masonry' => 'Masonry',
            ),
            'std' => 'Standard', // Your default value
            'edit_field_class' => '',
            'group' => 'General',
          ),

          array(
            'type' => 'textfield',
            'heading' => __('No. of posts', 'text-domain'),
            'param_name' => 'spacenum',
            'value' => '',
            'admin_label' => false,
            'weight' => 0,
            'std' => -1,
            'edit_field_class' => '',
            'group' => 'General',
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('No. of posts per row', 'text-domain'),
            'param_name' => 'rspacenum',
            'admin_label' => false,
            'value' => array(
              '2' => 2,
              '3' => 3,
              '4' => 4,
            ),
            'std' => 3, // Your default value
            'edit_field_class' => '',
            'group' => 'General',
          ),

          array(
            'type' => 'textfield',
            'heading' => __('Gallery Title', 'text-domain'),
            'param_name' => 'gtitle',
            'value' => '',
            'admin_label' => false,
            'weight' => 0,
            'std' => '',
            'edit_field_class' => '',
            'group' => 'Masonry Gallery',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Gallery description', 'text-domain'),
            'param_name' => 'gdesc',
            'value' => '',
            'admin_label' => false,
            'weight' => 0,
            'std' => '',
            'edit_field_class' => '',
            'group' => 'Masonry Gallery',
          ),


        )
      )
    );

  }


  // Element HTML

  /**
   * @param $atts
   * @return string
   */
  public function vc_inspiration_posts_html($atts)
  {


    extract(
      shortcode_atts(
        array(
          'sorder' => '',
          'idesign' => '',
          'spacenum' => '',
          'rspacenum' => '',
          'show_featured' => '',
          'gtitle' => '',
          'gdesc' => '',


        ),
        $atts
      )
    );

    // Fill $html var with data
    // url:%23showrooms|title:custom||

    include_once(ABSPATH . 'wp-content/themes/ideasorder/inc/Mobile_Detect.php');
    $detect = new Mobile_Detect;
    if ($show_featured == 'yes') {


      $args = array(
        'post_type' => 'inspiration',
        'posts_per_page' => $spacenum,
        'order' => $sorder,
        'post_status' => 'publish',
        'meta_query' => array(
          array(
            'key' => 'is_this_post_featured',
            'value' => 'yes',
            'compare' => '=',
          ),
        ),

      );

      $the_query = new WP_Query($args);


      $html = '
       <div class="inspiration">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-top">
                            <span>Inspiration</span>
                        </div>
                    </div>
                </div>
            
                <div class="row">';
      if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
          $the_query->the_post();
          $mobanner = get_field('mobile_banner_image', get_the_ID());
          if (isset($mobanner) && !empty($mobanner) && $detect->isMobile()) {
            $src[0] = $mobanner;
          } else {
            $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'ins-featured', false);

          }


          if ($rspacenum == 2) {
            $rnum = '4';
          } else if ($rspacenum == 4) {
            $rnum = '3';
          } else {
            $rnum = '4';
          }
          $cat = '';
          $category_detail = get_the_terms(get_the_ID(), 'inspiration_cat');//$post->ID
          foreach ($category_detail as $cd) {
            $cat .= $cd->name . ', ';
          }
          $cat = rtrim($cat, ', ');
          $html .= '<div class="col-md-' . $rnum . '">
                        <div class="article-inspiration">
                        <figure><a href="' . get_permalink() . '" ><img src="' . $src[0] . '" alt=""/></a></figure>
                        <div class="article-content">
                            <span class="small-size">' . $cat . '</span>
                            <h5><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>
                            <p><a href="' . get_permalink() . '" >' . get_the_excerpt() . '</a></p>
                        </div>
                        </div>
                    </div>';
        }

        /* Restore original Post Data */
        wp_reset_postdata();
      } else {
        // no posts found
      }
      $html .= ' </div>
            </div>
        </div>
       
        ';
    } else {

      $args = array(
        'post_type' => 'inspiration',
        'posts_per_page' => $spacenum,
        'order' => $sorder,
        'post_status' => 'publish'

      );
      if ($idesign != 'Masonry') {
        $the_query = new WP_Query($args);


        $html = '
       <div class="inspiration">
            <div class="container">
               
            
                <div class="row">';
        if ($the_query->have_posts()) {
          while ($the_query->have_posts()) {
            $the_query->the_post();
            $mobanner = get_field('mobile_banner_image', get_the_ID());
            if (isset($mobanner) && !empty($mobanner) && $detect->isMobile()) {
              $src[0] = $mobanner;
            } else {
              $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'ins-featured', false);

            }
            if ($rspacenum == 2) {
              $rnum = '4';
            } else if ($rspacenum == 4) {
              $rnum = '3';
            } else {
              $rnum = '4';
            }
            $cat = '';
            $category_detail = get_the_terms(get_the_ID(), 'inspiration_cat');//$post->ID
            foreach ($category_detail as $cd) {
              $cat .= $cd->name . ', ';
            }
            $cat = rtrim($cat, ', ');
            $html .= '<div class="col-md-' . $rnum . '">
                        <div class="article-inspiration">
                        <figure><a href="' . get_permalink() . '" ><img src="' . $src[0] . '" alt=""/></a></figure>
                        <div class="article-content">
                            <span class="small-size">' . $cat . '</span>
                            <h5><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>
                            <p><a href="' . get_permalink() . '" >' . get_the_excerpt() . '</a></p>
                        </div>
                        </div>
                    </div>';
          }

          /* Restore original Post Data */
          wp_reset_postdata();
        } else {
          // no posts found
        }
        $html .= ' </div>
            </div>
        </div>
       
        ';
      } else if ($idesign == 'Masonry') {

        //################################################
        //################################################
        //################################################

        $html="";

        $years = get_terms('inspiration_year'); // Taxonomy name
        foreach ($years as $k => $year) {
          $args = array(
            'post_type' => 'inspiration',
            'posts_per_page' => $spacenum,
            'order' => $sorder,
            'post_status' => 'publish',
            'tax_query' => array(
              array(
                'taxonomy' => 'inspiration_year', // Taxonomy name
                'field' => 'slug',
                'terms' => $year->slug
              )
            )
          );

          $the_query = new WP_Query($args);
          if (!$the_query->have_posts()) continue;
          $html .= '
<div class="masonry" style="">
  <ul class="grid effect-1" id="grid'.$k.'">
    <li>
        <div class="title-card">
          '.$year->description.'
        </div>
    </li>';
          if ($the_query->have_posts()) {
            $number = 1;
            while ($the_query->have_posts()) {
              $number++;
              $the_query->the_post();

              $cat = '';
              $category_detail = get_the_terms(get_the_ID(), 'inspiration_cat');//$post->ID
              foreach ($category_detail as $cd) {
                $cat .= $cd->name . ', ';
              }
              $cat = rtrim($cat, ', ');
              if ($number == 2) {
                $isize = 'ins-featured3';
              }
              if ($number == 2) {
                $isize = 'ins-featured2';
              } else if ($number == 3) {
                $isize = 'ins-featured3';
              } else if ($number == 4) {
                $isize = 'ins-featured2';
              } else if ($number == 5) {
                $isize = 'ins-featured2';
              } else if ($number == 6) {
                $isize = 'ins-featured2';
              } else if ($number == 7) {
                $isize = 'ins-featured3';
              } else if ($number == 8) {
                $isize = 'ins-featured3';
              } else {
                $isize = 'ins-featured3';
                $number = 1;
              }
              $html .= '<li>
      <a href="' . get_permalink() . '">
        ' . get_the_post_thumbnail(get_the_ID(), $isize) . '
        <div class="inspiration-image-content">
          <h3>' . get_the_title() . '</h3>
        </div>
      </a>
	  <div class="inspiration-image-content for-mobile">
          <h3>' . get_the_title() . '</h3>
        </div>
    </li>';


            }

            /* Restore original Post Data */
            wp_reset_postdata();
          } else {
            // no posts found
          }
          $html .= ' 
    
  </ul>
</div>
<hr class="grid">
  ';
        }

        foreach ($years as $k=>$year){
          $html .= '<script>
                        new AnimOnScroll( document.getElementById( "grid'.$k.'" ), {
                          minDuration : 0.4,
                          maxDuration : 0.7,
                          viewportFactor : 0.2
                        } );
                    </script>';
        }

      }
    }


    return $html;


  }

} // End Element Class

// Element Class Init
new vcInspiration();