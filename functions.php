<?php
/**
 * @package 	WordPress
 * @subpackage 	Charity NGO Child
 * @version		1.0.0
 * 
 * Child Theme Functions File
 * Created by CMSMasters
 * 
 */


function charity_ngo_enqueue_styles() {
    wp_enqueue_style('charity-ngo-child-style', get_stylesheet_uri(), array('charity-ngo-style'), '1.0.0', 'screen, print');
}

add_action('wp_enqueue_scripts', 'charity_ngo_enqueue_styles', 11);
?>