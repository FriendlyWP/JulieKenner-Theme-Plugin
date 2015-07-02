<?php 
if ( function_exists('get_field') && get_field('display_slider')) {
	$slider = get_field('display_slider');
	
	//var_dump($slider[0]);
	//echo $slider[0]->post_title;
	echo do_shortcode('[slider title="' . $slider[0]->post_title . '"]'); 
}
?>