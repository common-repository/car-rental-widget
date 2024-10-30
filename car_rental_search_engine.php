<?php

/**
 * Plugin Name: Car Rental Search Engine
 * Description: Free worldwide car rental search engine plugin for WordPress
 * Version: 1.0
 * Author: shanetonks, tosagor
 * License: GPLv3
 *
 **/
 
if(!defined('ABSPATH')) die();

/**
 *  Plugin External Libraries
 */
function crs_external_lib() {
    
    // Ajax URL
    wp_localize_script( 'assets', 'assets', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    // Custom StyleSheet CSS
    wp_enqueue_style( 'custom-style', plugins_url( 'assets/style.css' , __FILE__ ));
    // Custom Script JS
    wp_enqueue_script( 'custom-script', plugins_url( 'assets/main.js', __FILE__ ));

 }

add_action( 'wp_enqueue_scripts', 'crs_external_lib' );

/**
 * Adds Car Hire Search Engine Widget
 */
class car_rental_search_engine_widget extends WP_Widget {
    
    /**
     * Register widget with WordPress
    */
    function car_rental_search_engine_widget () {
        $widget_options = array(
            'classname' => 'car_rental_search_engine_widget',
            'description' => 'Displays car rental serch engine'
        );
        
        $this->WP_Widget('mrc_id', 'Car Rental Search Widget', $widget_options);
    }
    
    /**
     * Show widget form in Appearance/Widgets
    */
    function form ($instance) {
        $mrc_title = array('title' => 'Car Hire Search');
        $instance = wp_parse_args($instance, $mrc_title);	        
        $title = esc_attr($instance['title']);	        
        echo '<p><input type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>';
    }
    
    /**
     * Save Widget Content
    */	     
    function update ($new_instance, $old_instance) {
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
         return $instance;         
    }
     
    
    /**
     * Show widget
    */
    function widget ($args, $instance) {
       extract($args);
       $title = apply_filters('widget_title', $instance['title']);
        
       echo $before_widget;
       echo $before_title.$title.$after_title;
	   
	   //$mrc_logo = "<img src='wp-content/plugins/more-rental-cars/assets/imgs/newlogosml.png' id='mrc_logo'>";
	   $mrc_logo = plugins_url( '/assets/imgs/newlogosml.png', __FILE__ );
	   $mrc_be = "<iframe src='https://book.cartrawler.com/?client=845310&tv=FACD0280' id='mrc_iframe'></iframe>";        
       echo $mrc_be;
	   echo "" . '<img src="'.$mrc_logo.'" id="mrc_logo"></a>';	
	     
        
       /**
        * Print widget
        */
       echo $after_widget; 
     }	     
}

/**
* Register Widget
*/
function car_rental_search_engine_init () {
    register_widget('car_rental_search_engine_widget');
}

/**
* Initialize widget
*/
add_action('widgets_init', 'car_rental_search_engine_init'); 
