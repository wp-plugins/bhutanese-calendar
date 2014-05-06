<?php
//This page is to add Plugin shortcode eg [bhutanese_calendar_month year=false month=true navi=true link]
function bhutanese_calendar_month_function( $atts ) {
	//The shortcode values are set to false if no value is passed
	if($atts['year']=="") $atts['year']="false";
	if($atts['month']=="") $atts['month']="false";
	if($atts['navi']=="") $atts['navi']="false";
	if($atts['link']=="") $atts['link']="link";
	$output=bhutanese_calendar_month($atts['year'], $atts['month'],$atts['navi'],$atts['link']);
	return $output;
}
add_shortcode( 'bhutanese_calendar_month', 'bhutanese_calendar_month_function' );
?>
