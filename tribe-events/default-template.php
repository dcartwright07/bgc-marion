<?php

/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Overriding parent theme file
 *
 * @package TribeEventsCalendar
 *
 * @theme_package 	Charity NGO Child
 * @theme_author		Dominic Cartwright
 * @theme_version 	1.0.1
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();

list( $cmsmasters_layout ) = charity_ngo_theme_page_layout_scheme();

/* #region Content */

if( $cmsmasters_layout == 'r_sidebar' ) {
	echo '<div class="content entry" >' . "\n\t";
} elseif( $cmsmasters_layout == 'l_sidebar' ) {
	echo '<div class="content entry fr" >' . "\n\t";
} else {
	echo '<div class="middle_content entry" >';
}

echo '<div id="tribe-events-pg-template" class="clearfix">' . "\n\t";
	tribe_events_before_html();
	tribe_get_view();
	// tribe_events_after_html();
	echo '<div class="cl"></div>';
echo '</div> <!-- #tribe-events-pg-template -->' . "\n";

/* #endregion */

/* #region Sidebar */

if( $cmsmasters_layout == 'r_sidebar' ) {

	echo "\n" . '<!-- ===== Sidebar ===== -->' . "\n";
	echo '<div class="sidebar" >' . "\n";
		get_sidebar();
	echo "\n" . '</div>' . "\n";
	echo'<!-- ===== Finish Sidebar ===== -->' . "\n";

} elseif( $cmsmasters_layout == 'l_sidebar' ) {

	echo "\n" . '<!-- ===== Start Sidebar ===== -->' . "\n";
	echo '<div class="sidebar fl" >' . "\n";
		get_sidebar();
	echo "\n" . '</div>' . "\n";
	echo'<!-- ===== Finish Sidebar ===== -->' . "\n";

}

/* #endregion */

get_footer();

