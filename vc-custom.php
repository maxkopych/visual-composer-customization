<?php
/**
 * Plugin Name: VC CUSTOM
 * Plugin URI: 
 * Description: VC Custom is a plugin for add diffrents type custom widgets.
 * Version: 1.0.0
 * Author: Meticulosity
 * 	
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die('-1');
} 
else {

	require( plugin_dir_path( __FILE__ ) . 'banner-slider.php'); // Meet the location 
	require( plugin_dir_path( __FILE__ ) . 'footer-call-to-action.php'); // Footer call to action widget
	require( plugin_dir_path( __FILE__ ) . 'footer-request-consultation.php'); // Footer Request consultation widget
	require( plugin_dir_path( __FILE__ ) . 'spaces.php'); // Spaces posts widget
		require( plugin_dir_path( __FILE__ ) . 'spaces-home.php'); // Spaces posts widget
	require( plugin_dir_path( __FILE__ ) . 'inspiration.php'); // Inspiration posts widget
	require( plugin_dir_path( __FILE__ ) . 'single-testimonial.php'); // Single testimonial widget
	require( plugin_dir_path( __FILE__ ) . 'post-filter.php'); // Post filter widget
		require( plugin_dir_path( __FILE__ ) . 'features.php'); // Features posts widget
		require( plugin_dir_path( __FILE__ ) . 'about-banner.php'); // about banner widget
		require( plugin_dir_path( __FILE__ ) . 'about-video-section.php'); // about banner widget
		require( plugin_dir_path( __FILE__ ) . 'about-testimonial.php'); // about banner widget
		require( plugin_dir_path( __FILE__ ) . 'about-news-section.php'); // about banner widget
		require( plugin_dir_path( __FILE__ ) . 'video-galleries.php'); // about banner widget
		require( plugin_dir_path( __FILE__ ) . 'related-post.php'); // about banner widget
		
		require( plugin_dir_path( __FILE__ ) . 'custom-image-gallery.php'); // about banner widget
		require( plugin_dir_path( __FILE__ ) . 'acf-image-gallery-with-caption.php'); // about banner widget
		require( plugin_dir_path( __FILE__ ) . 'acf-featured-image-slider-with-caption.php'); // about 
		require( plugin_dir_path( __FILE__ ) . 'acf-featured-image-slider-with-caption-2.php'); // about 
		require( plugin_dir_path( __FILE__ ) . 'acf-featured-image-slider-with-caption-3.php'); // about 
}

