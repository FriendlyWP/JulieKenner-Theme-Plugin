<?php
/*
Plugin Name: JKenner Custom Types & Taxonomies
Plugin URI: juliekenner.com
Description: Custom Types and taxonomies for JulieKenner.com
Version: 1.0
Author: Michelle McGinnis
Author URI: http://friendlywp.com
License: 
License URI: 
*/

// Register Custom Type
function cpts() {

/****** TAXONOMIES *******/

    // FAQ CATEGORIES
  $labels = array(
    'name'                       => 'FAQ Categories',
    'singular_name'              => 'FAQ Category',
    'menu_name'                  => 'FAQ Categories',
    'all_items'                  => 'All FAQ Categories',
    'parent_item'                => 'Parent FAQ Category',
    'parent_item_colon'          => 'Parent FAQ Category:',
    'new_item_name'              => 'New FAQ Category',
    'add_new_item'               => 'Add New FAQ Category',
    'edit_item'                  => 'Edit FAQ Category',
    'update_item'                => 'Update FAQ Category',
    'separate_items_with_commas' => 'Separate items with commas',
    'search_items'               => 'Search FAQ Categories',
    'add_or_remove_items'        => 'Add or remove FAQ categories',
    'choose_from_most_used'      => 'Choose from the most used FAQ categories',
    'not_found'                  => 'Not Found',
  );
  $rewrite = array(
    'slug'                       => 'faq-category',
    'with_front'                 => true,
    'hierarchical'               => true,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'faq_categories', 'faq', $args );

  // SERIES
  $labels = array(
    'name'                       => 'Series',
    'singular_name'              => 'Series',
    'menu_name'                  => 'Series',
    'all_items'                  => 'All Series',
    'parent_item'                => 'Parent Series',
    'parent_item_colon'          => 'Parent Series:',
    'new_item_name'              => 'New Series',
    'add_new_item'               => 'Add New Series',
    'edit_item'                  => 'Edit Series',
    'update_item'                => 'Update Series',
    'separate_items_with_commas' => 'Separate items with commas',
    'search_items'               => 'Search Series',
    'add_or_remove_items'        => 'Add or remove Series',
    'choose_from_most_used'      => 'Choose from the most used Series',
    'not_found'                  => 'Not Found',
  );
  $rewrite = array(
    'slug'                       => 'books/series',
    'with_front'                 => true,
    'hierarchical'               => true,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'series', 'book', $args );

  // GENRE
  $labels = array(
    'name'                       => 'Genres',
    'singular_name'              => 'Genre',
    'menu_name'                  => 'Genres',
    'all_items'                  => 'All Genres',
    'parent_item'                => 'Parent Genre',
    'parent_item_colon'          => 'Parent Genre:',
    'new_item_name'              => 'New Genre',
    'add_new_item'               => 'Add New Genre',
    'edit_item'                  => 'Edit Genre',
    'update_item'                => 'Update Genre',
    'separate_items_with_commas' => 'Separate items with commas',
    'search_items'               => 'Search Genres',
    'add_or_remove_items'        => 'Add or remove Genres',
    'choose_from_most_used'      => 'Choose from the most used Genres',
    'not_found'                  => 'Not Found',
  );
  $rewrite = array(
    'slug'                       => 'books/genre',
    'with_front'                 => true,
    'hierarchical'               => true,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'genre', 'book', $args );

  // FORMAT
  $labels = array(
    'name'                       => 'Formats',
    'singular_name'              => 'Format',
    'menu_name'                  => 'Formats',
    'all_items'                  => 'All Formats',
    'parent_item'                => 'Parent Format',
    'parent_item_colon'          => 'Parent Format:',
    'new_item_name'              => 'New Format',
    'add_new_item'               => 'Add New Format',
    'edit_item'                  => 'Edit Format',
    'update_item'                => 'Update Format',
    'separate_items_with_commas' => 'Separate items with commas',
    'search_items'               => 'Search Formats',
    'add_or_remove_items'        => 'Add or remove Formats',
    'choose_from_most_used'      => 'Choose from the most used Formats',
    'not_found'                  => 'Not Found',
  );
  $rewrite = array(
    'slug'                       => 'books/format',
    'with_front'                 => true,
    'hierarchical'               => true,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => false,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'format', 'book', $args );

  // PUBLICATION COUNTRIES
  $labels = array(
    'name'                       => 'Publication Countries',
    'singular_name'              => 'Publication Country',
    'menu_name'                  => 'Publication Countries',
    'all_items'                  => 'All Publication Countries',
    'parent_item'                => 'Parent Publication Country',
    'parent_item_colon'          => 'Parent Publication Country:',
    'new_item_name'              => 'New Publication Country',
    'add_new_item'               => 'Add New Publication Country',
    'edit_item'                  => 'Edit Publication Country',
    'update_item'                => 'Update Publication Country',
    'separate_items_with_commas' => 'Separate items with commas',
    'search_items'               => 'Search Publication Countries',
    'add_or_remove_items'        => 'Add or remove Publication Countries',
    'choose_from_most_used'      => 'Choose from the most used Publication Countries',
    'not_found'                  => 'Not Found',
  );
  $rewrite = array(
    'slug'                       => 'books/international-editions',
    'with_front'                 => true,
    'hierarchical'               => true,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => false,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'pub_country', 'book', $args );

   // CHARACTERS
  $labels = array(
    'name'                       => 'Characters',
    'singular_name'              => 'Character',
    'menu_name'                  => 'Characters',
    'all_items'                  => 'All Characters',
    'parent_item'                => 'Parent Character',
    'parent_item_colon'          => 'Parent Character:',
    'new_item_name'              => 'New Character',
    'add_new_item'               => 'Add New Character',
    'edit_item'                  => 'Edit Character',
    'update_item'                => 'Update Character',
    'separate_items_with_commas' => 'Separate items with commas',
    'search_items'               => 'Search characters',
    'add_or_remove_items'        => 'Add or remove Characters',
    'choose_from_most_used'      => 'Choose from the most used characters',
    'not_found'                  => 'Not Found',
  );
  $rewrite = array(
    'slug'                       => 'books/character',
    'with_front'                 => true,
    'hierarchical'               => true,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => false,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'character', 'book', $args );

  /****** CPTS *******/

  // FAQ
  $labels = array(
    'name'                => 'FAQs',
    'singular_name'       => 'FAQ',
    'menu_name'           => 'FAQs',
    'parent_item_colon'   => 'Parent FAQ:',
    'all_items'           => 'All FAQs',
    'view_item'           => 'View FAQ',
    'add_new_item'        => 'Add New FAQ',
    'add_new'             => 'Add New',
    'edit_item'           => 'Edit FAQ',
    'update_item'         => 'Update FAQ',
    'search_items'        => 'Search FAQ',
    'not_found'           => 'Not found',
    'not_found_in_trash'  => 'Not found in Trash',
  );
  $args = array(
    'label'               => 'faq',
    'description'         => 'Individual FAQs',
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'revisions', ),
    'taxonomies'          => array( 'faq_categories' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 20,
    'menu_icon'           => 'dashicons-editor-help',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'faq', $args );

  // BOOK
  $labels = array(
    'name'                => 'Books',
    'singular_name'       => 'Book',
    'menu_name'           => 'Books',
    'parent_item_colon'   => 'Parent Book:',
    'all_items'           => 'All Books',
    'view_item'           => 'View Book',
    'add_new_item'        => 'Add New Book',
    'add_new'             => 'Add New',
    'edit_item'           => 'Edit Book',
    'update_item'         => 'Update Book',
    'search_items'        => 'Search Book',
    'not_found'           => 'Not found',
    'not_found_in_trash'  => 'Not found in Trash',
  );
 $rewrite = array(
        'slug'                => 'book',
        'with_front'          => true,
        'pages'               => true,
        'feeds'               => true,
    );
  $args = array(
    'label'               => 'book',
    'description'         => 'Individual Books',
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'revisions', 'thumbnail', 'page-attributes'),
    'taxonomies'          => array( 'book_categories' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 20,
    'menu_icon'           => 'dashicons-book-alt',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'rewrite'             => $rewrite,
    'capability_type'     => 'page',
  );
  register_post_type( 'book', $args );

  // SLIDER
  $labels = array(
    'name'                => 'Sliders',
    'singular_name'       => 'Slider',
    'menu_name'           => 'Sliders',
    'parent_item_colon'   => 'Parent Slider:',
    'all_items'           => 'All Sliders',
    'view_item'           => 'View Slider',
    'add_new_item'        => 'Add New Slider',
    'add_new'             => 'Add New',
    'edit_item'           => 'Edit Slider',
    'update_item'         => 'Update Slider',
    'search_items'        => 'Search Slider',
    'not_found'           => 'Not found',
    'not_found_in_trash'  => 'Not found in Trash',
  );
 $rewrite = array(
        'slug'                => 'slider',
        'with_front'          => true,
        'pages'               => true,
        'feeds'               => true,
    );
  $args = array(
    'label'               => 'slider',
    'description'         => 'Individual Sliders',
    'labels'              => $labels,
    'supports'            => array( 'title', 'revisions',),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 20,
    'menu_icon'           => 'dashicons-images-alt',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'rewrite'             => $rewrite,
    'capability_type'     => 'page',
  );
  register_post_type( 'slider', $args );
}

// CHANGE TITLE FIELD TEXT FOR CPTs
add_filter( 'enter_title_here', 'hwp_enter_title_here' );
function hwp_enter_title_here( $title ){
    $screen = get_current_screen();
 
    if ( 'book' == $screen->post_type ) {
        $title = 'Enter Story Title Here';
    }

    if ( 'faq' == $screen->post_type ) {
        $title = 'Enter Question Here';
    }

    if ( 'slider' == $screen->post_type ) {
        $title = 'Enter Slider Name Here';
    }
 
    return $title;
}

function mm_flush_rules() {
	cpts();
	flush_rewrite_rules();
}

// Hook into the 'init' action
register_activation_hook( __FILE__, 'mm_flush_rules');
add_action( 'init', 'cpts', 0 );

// create shortcode to display slider
// [slider title="Slider Name Here"]
// NOW USING SLICK INSTEAD OF FLEXSLIDER, SEE https://kenwheeler.github.io/slick/
add_shortcode( 'slider', 'rmcc_post_listing_parameters_shortcode' );
function rmcc_post_listing_parameters_shortcode( $atts ) {
    ob_start();
 
    // define attributes and their defaults
    extract( shortcode_atts( array (
        'title' => 'Home Page Slider',
        'order' => 'asc',
        'orderby' => 'menu_order',
        'posts' => -1,
    ), $atts ) );
 
    // define query parameters based on attributes
    $options = array(
        'post_type' => 'slider',
        'name' => $title,
        'posts_per_page' => 1,
    );
    $output = '';
    $featured_query = new WP_Query( $options );
    // run the loop based on the query
    if ( $featured_query->have_posts() ) { 

    	while ( $featured_query->have_posts() ) { 
         	$featured_query->the_post();

            $fq_id = get_the_ID();

         	if ( function_exists('get_field') && get_field('slider_type') ) {
                $displaytype = get_field('slider_type');
            }

           $output .= wp_enqueue_style( 'slick' );
            
            $output .= wp_enqueue_script( 'slickjs' );
            
            $output .= '<script type="text/javascript" language="javascript">';
            $output .= 'jQuery(document).ready(function($) {';
            $output .= "$('.slick-". $fq_id ."').slick({";
                if ($displaytype == 'bookstrip') {
                    $output .= "speed: 300,";
                    $output .= "slidesToShow: 8,";
                    $output .= "slidesToScroll: 8,";
                    $output .= "infinite:true,";
                    $output .= "autoplay:true,";
                    $output .= "fade:false,";
                    $output .= "autoplaySpeed:4000,";
                    $output .= "responsive: [";
                        $output .= "{";
                          $output .= "breakpoint: 972,";
                          $output .= "settings: {";
                            $output .= "slidesToShow: 6,";
                            $output .= "slidesToScroll: 6,";
                            $output .= "infinite: true,";
                            $output .= "dots: true";
                          $output .= "}";
                        $output .= "},";
                        $output .= "{";
                          $output .= "breakpoint: 810,";
                          $output .= "settings: {";
                            $output .= "slidesToShow: 5,";
                            $output .= "slidesToScroll: 5";
                          $output .= "}";
                        $output .= "},";
                        $output .= "{";
                          $output .= "breakpoint: 648,";
                          $output .= "settings: {";
                            $output .= "slidesToShow: 4,";
                            $output .= "slidesToScroll: 4";
                          $output .= "}";
                        $output .= "},";
                        $output .= "{";
                          $output .= "breakpoint: 486,";
                          $output .= "settings: {";
                            $output .= "slidesToShow: 3,";
                            $output .= "slidesToScroll: 3";
                          $output .= "}";
                        $output .= "}";
                    $output .= "]";
                } elseif ($displaytype == 'regular') {
                    $output .= "speed: 300,";
                    $output .= "infinite:true,";
                    $output .= "autoplay:true,";
                    $output .= "fade:true,";
                    $output .= "autoplaySpeed:4000,";
                } elseif ($displaytype == 'centerfeature') {
                   // $output .= "speed: 300,";
                    $output .= "centerMode: true,";
                    $output .= "adaptiveHeight: true,";
                    $output .= "centerPadding: '0px',";
                    $output .= "slidesToShow: 3,";
                    $output .= "slidesToScroll: 1,";
                    $output .= "infinite:true,";
                    //$output .= "variableWidth:true,";
                    $output .= "autoplay:true,";
                    //$output .= "fade:false,";
                    $output .= "autoplaySpeed:4000,";

                    $output .= "responsive: [";
                    $output .= "{";
                        $output .= "breakpoint: 1024,";
                        $output .= "settings: {";
                        $output .= "slidesToShow: 3,";
                        $output .= "slidesToScroll: 1,";
                        $output .= "infinite: true,";
                        $output .= " dots: false";
                    $output .= "}";
                    $output .= "},";
                    $output .= "{";
                        $output .= "breakpoint: 600,";
                        $output .= "settings: {";
                        $output .= " slidesToShow: 2,";
                         $output .= "slidesToScroll: 1";
                     $output .= "}";
                    $output .= "},";
                    $output .= "{";
                         $output .= "breakpoint: 480,";
                        $output .= "settings: {";
                        $output .= " slidesToShow: 1,";
                        $output .= "slidesToScroll: 1";
                     $output .= "}";
                    $output .= "}";
                    $output .= "]";
                   } 
            $output .= '});';
            $output .= '});';
            $output .= '</script>';

            //$output .= '<div class="slick slick-' . $fq_id . ' ' . $displaytype . '">';
           // $output .= '<ul class="slides">';
            
            // REGULAR SLIDER
            if (function_exists('get_field') && get_field('frames') ) {
                $output .= '<div class="slick slick-' . $fq_id . ' ' . $displaytype . '">';
                while(has_sub_field('frames')) {

                    $overlay_color = get_sub_field('overlay_color');
                    $overlay_heading_text = get_sub_field('overlay_heading_text');
                    $overlay_smaller_text = get_sub_field('overlay_smaller_text');
                    $button_color = 'blue';
                    $button_text = get_sub_field('button_text');
                    $button_destination = get_sub_field('button_destination');
                    $slide_image = get_sub_field('slide_image');  
                    if ( !wp_is_mobile() ) {
                        $image_info =  wp_get_attachment_image_src( $slide_image, 'widescreen' );
                    } else {
                        $image_info =  wp_get_attachment_image_src( $slide_image, 'pagewidth' );
                    }

                    if ($overlay_color == 'red') {
                        $button_color = 'blue';
                    }

                    $output .= '<div>';
                        if ($button_destination) {
                            $output .= '<a href="' . $button_destination . '">';
                        }
                            $output .= '<img alt="' . $overlay_heading_text . '" src="' . $image_info[0] . '" />';
                        if ($button_destination) {
                            $output .= '</a>';
                        }
                    $output .= '<span class="overlay ' . $overlay_color . '"><span>'; 
                        if ($overlay_heading_text) {
                            $output .= '<h3>' . $overlay_heading_text . '</h3>';    
                        }

                        if ($overlay_smaller_text) {
                            $output .= '<p>' . $overlay_smaller_text . '</p>';    
                        }
                        if ($button_destination && $button_text) {
                            $output .= '<a href="' . $button_destination . '" class="button ' . $button_color . '">' . $button_text . '</a>';

                        }
                    $output .= '</span></span></div>';
                    
                } //endwhile frames subfields
            } // regular subfields endif

            // BOOKS SLIDER
            elseif (function_exists('get_field') && get_field('books_slides') ) {
                $output .= '<div class="slick slick-' . $fq_id . ' ' . $displaytype . '">';
                $books = get_field('books_slides');

                foreach ($books as $book) {
                    $attr = array(
                        'class' => 'sliderthumb',
                        'alt' => trim( strip_tags(get_the_title($book->ID))),
                    );
                    $bookthumb = get_the_post_thumbnail($book->ID, 'footer-thumb', $attr);
                    $url = get_permalink( $book->ID);

                    $output .= '<div>';
                        
                            $output .= '<a href="' . $url . '">';
                        
                            //$output .= '<img alt="' . get_the_title($book->ID) . '" src="' . $thumb_url . '" />';
                            $output .= $bookthumb;
                        
                            $output .= '</a>';

                    $output .= '</div>';
                            
                } //endwhile books subfields
            } // books subfields endif

             // FEATURED CONTENT SLIDER
            elseif (function_exists('get_field') && get_field('featured_content') ) {
                $featured_content = get_field('featured_content');
                $row_count = count($featured_content);
                $output .= '<div class="slick slick-' . $fq_id . ' ' . $displaytype . ' count-' . $row_count . '">';
               while ( has_sub_field('featured_content') ) {
               
                        $cover = get_sub_field('featured_image');
                        $headline = get_sub_field('headline');
                        $content = get_sub_field('copy');
                        $link = get_sub_field('link_to');
                        $button_text = get_sub_field('button_text');
                        $display_style = get_sub_field('display_style');

                        $attr = array(
                            'alt' =>  trim(strip_tags( $headline )),
                            );
                        $image = wp_get_attachment_image( $cover, 'thumbnail', $attr );
                        
                        $output .= '<div class="featured_book cf ' . $display_style . '">';
                            //$output .= '<div class="featured_book cf ' . $display_style . '">';
                            $output .= '<a href="' . $link . '">' . $image . '</a>';
                            
                            $output .= '<div class="text"><h3>' . $headline . '</h3>';
                            
                            if ($content) {
                               $output .= $content;
                            }

                            if ($link && $button_text) {
                                $output .= '<br /><a href="' . $link . '" class="button">' . $button_text . '</a>';

                            }
                            $output .= '</div>';
                           // $output .= '</div>';
                        $output .= '</div>';
                   
                    
                } //endwhile featured_content subfields
            } // regular subfields endif
           
          $output .= '</div>';
            
		} // main slider query endwhile

    } // main slider query endif

    
    ob_get_clean();
    wp_reset_postdata();
    return $output;

}


function acf_set_featured_image( $value, $post_id, $field  ){
        
        if( $value != '' ){
            //Add the value which is the image ID to the _thumbnail_id meta data for the current post
            add_post_meta($post_id, '_thumbnail_id', $value);
        }    
    
    return $value;
}
add_filter('acf/update_value/key=field_54823ea024290', 'acf_set_featured_image', 10, 3);

/*function mkm_set_featured() {
   // $featured_key = 'field_5488c07aa4733';
   // $featured = get_field_object($featured_key);
    //if ( $featured['value'] == '1' ) {
        // acf/update_value/name={$field_name} - filter for a specific field based on it's name
        add_filter('acf/update_value/key=field_54823ea024290', 'acf_set_featured_image', 10, 3);
    //}
}
add_action('wp', 'mkm_set_featured');
*/
 

// REMOVE WIDGET TITLE IF IT BEGINS WITH EXCLAMATION POINT
// To use, add a widget and in the Title field put !The title here
// The title will show in the control panel, but not on the site itself
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
    if ( substr ( $widget_title, 0, 1 ) == '!' )
        return;
    else 
        return ( $widget_title );
}

add_shortcode('year', 'year_shortcode');
function year_shortcode() {
  $year = date('Y');
  return $year;
}

// FAQ SHORTCODE
// Usage: [faqs topic=admissions sortbycat=true]
add_shortcode('faqs', 'sf_display_faqs');
function sf_display_faqs( $atts, $content = null) {
    // ENQUEUE THE SCRIPT IN THE FOOTER WHEN THIS SHORTCODE IS PRESENT
    wp_enqueue_script( 'nested-accordion', get_template_directory_uri() . '/library/js/nested-accordion.js', array( 'jquery' ), '', true );

    extract( shortcode_atts( array(
      'sortbycat'      => 'false',
      'cat'           => '', // title or slug of category
      //'hierarchical'    => 'false',
      ), $atts ) );


    // SHOW FAQS SORTED BY All TOPICS
    if($sortbycat == 'true' )  {
        $content .= '<div class="accordion" id="acc1">';
        $content .= '<p class="excol"></p>';

        if ( $cat !== '') {
            $catID = get_term_by( 'slug', $cat, 'faq_categories' );
           // echo 'catID=' . $catID->term_id;
            $args = array(
                //'child_of'      => $catID->term_id,
                // 'child_of'      => $catID->term_id,
                'orderby' => 'menu_order',
            );
        } else {
            $args = array(
                'orderby' => 'menu_order',
            );
        }
         

        $terms = get_terms('faq_categories', $args);
        if(!empty($terms)):
            foreach($terms as $i => $term):
                $content .= '<h2>' . $term->name . '<span class="icon"></span></h2>';
                $content .= '<div>';
                $faqs = get_posts('posts_per_page=-1&post_type=faq&faq_categories=' . $term->slug . '&orderby=menu_order&order=ASC');
                global $post;
                $temp = $post;

                if($faqs) :
                    foreach($faqs as $post) : setup_postdata($post);

                            $content .= '<h3 class="question">';
                            $content .= get_the_title();
                            $content .= '<span class="icon"></span></h3>';

                            $content .= '<div class="answer">';
                                $content .= wpautop( do_shortcode( get_the_content() ) );
                                $content .= '<a href="' . get_permalink() . '" class="permalink faq-link">Link to this FAQ</a>';
                            $content .= '</div>';

                    endforeach;
                endif;
                $post = $temp;
                $content .= '</div>';
            endforeach;
        endif;
        $content .= '</div>'; // .accordion
    // SHOW JUST DESIGNATED TOPIC, NOT SORTED
    } elseif($cat !== '')  {
        $content .= '<div class="accordion" id="acc1">';
        $content .= '<p class="excol"></p>';
            
            $content .= '<div>';
            $faqs = get_posts('posts_per_page=-1&post_type=faq&faq_categories=' . $cat . '&orderby=menu_order&order=ASC');
            //print_r($faqs);
            global $post;
            $temp = $post;

            if($faqs) :
                foreach($faqs as $post) : setup_postdata($post);
                    
                        $content .= '<h3 class="question">';
                        $content .= get_the_title();
                        $content .= '<span class="icon"></span></h3>';

                        $content .= '<div class="answer">';
                            $content .= wpautop( do_shortcode( get_the_content() ) );
                            $content .= '<a href="' . get_permalink() . '" class="permalink faq-link">Link to this FAQ</a>';
                        $content .= '</div>';
                    
                endforeach;
            endif;
            $post = $temp;
            $content .= '</div>';
               
        $content .= '</div>'; // .accordion
    } else {
    // SHOW ALL FAQS LISTED IN MENU ORDER
        $content .= '<div class="accordion" id="acc1">';
        $content .= '<p class="excol"></p>';
            $faqs = get_posts('posts_per_page=-1&post_type=faq&faq_categories=' . $cat . '&orderby=menu_order&order=ASC');
            global $post;
            $temp = $post;

            if($faqs) :
                foreach($faqs as $post) : setup_postdata($post);
                            
                                $content .= '<h3 class="question">';
                                $content .= get_the_title();
                                $content .= '<span class="icon"></span></h3>';

                                $content .= '<div class="answer">';
                                    $content .= wpautop( do_shortcode( get_the_content() ) );
                                    $content .= '<a href="' . get_permalink() . '" class="permalink faq-link">Link to this FAQ</a>';
                                $content .= '</div>';
                            
                        endforeach;
            endif;
            $post = $temp;
        $content .= '</div>'; // .accordion
    }
    // add initShow: ".new", to first args to show questions in each cat on load
     $content .= '<script type="text/javascript" language="javascript">
                            jQuery(document).ready(function($) {
                                
                                $("#main").accordion({
                                  objID: "#acc1", 
                                  obj: "div", 
                                  wrapper: "div", 
                                  el: ".h",
                                  elToWrap: "span,i",
                                  head: "h2, h3", 
                                  next: "div", 
                                  standardExpansible : false,
                                });

                                $("#main .accordion").expandAll({
                                      trigger: ".h", 
                                      ref: ".excol", 
                                      cllpsEl: "div.outer",
                                      speed: 200,
                                      oneSwitch : false,
                                      instantHide: true,
                                      expTxt : "Expand All",
                                      cllpsTxt : "Collapse All",
                                  });
                            });
                        </script>';
    return $content;
}
add_action( 'admin_enqueue_scripts', 'bones_admin_css', 99 );
function bones_admin_css() {
    wp_register_style( 'bones_admin_css', get_template_directory_uri() . '/library/css/admin.css', false );
    wp_enqueue_style( 'bones_admin_css'  );
}

// ADD ORDER PAGE AS CHILD TO BOOK PAGE
//http://wordpress.stackexchange.com/a/85832/16
add_action( 'save_post', 'wpa8582_add_book_children' );
function wpa8582_add_book_children( $post_id ) {  
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !wp_is_post_revision( $post_id )
    && 'book' == get_post_type( $post_id )
    && 'auto-draft' != get_post_status( $post_id ) ) {  
        $book = get_post( $post_id );
        if( 0 == $book->post_parent ){
            //$children =& get_children(
            $children = get_children(
                array(
                    'post_parent' => $post_id,
                    'post_type' => 'book'
                )
            );
            if( empty( $children ) ){
                $child = array(
                    'post_type' => 'book',
                    'post_title' => 'Order',
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_parent' => $post_id,
                    //'post_author' => 1,
                    'page_template' => 'tmpl-order.php'
                    //'tax_input' => array( 'your_tax_name' => array( 'term' ) )
                );
                wp_insert_post( $child );
            }
        }
    }
}

// the flattened taxonomy object
class OutObject {
    public $parentFormat;
    public $childFormat;
    public $otherData;
    public $characterLevel;
    // the rest of the properties are added on the fly 
};

class OutLink {
}

// a helper function to make Print come first in the sort
function parentFormatOrder($parentFormat) {
    $parentFormatOrder = '999';
    switch ($parentFormat) {
        case 'Print' : 
            $parentFormatOrder = '001';
            break;
        case 'Digital' : 
            $parentFormatOrder = '002';
            break;
        case 'Audio' : 
            $parentFormatOrder = '003';
            break;
    }
    return $parentFormatOrder;
}

// BUYBOOK SHORTCODE [showbook title="Book Title" class="alignleft feature" links="false" showtitle="true"][/showbook]
add_shortcode('showbook', 'show_book_block');
function show_book_block( $atts, $content = null ) {
   
    extract(shortcode_atts( array(
        'title' => '',
        'id' => '',
        'class' => 'alignright',
        'showcaption' => 'true', // shows book title and number in series under book cover
        'display' => 'quick', // quick = featured edition w/quick buy links; full = all editions; listpage = just order button
        'links' => 'true',
        'showorder' => 'false',
        'linkto' => 'order',
        ), $atts )
    );
    
    if ( $id !== '' ) {
        $bookid = $id;
    } elseif ($title !== '') {
        $title = get_page_by_title($title, 'object', 'book');
        $bookid = $title->ID;
    }
    $number_in_series = get_field('number_in_series', $bookid);
    $booktitle = get_the_title($bookid);
    $booklink = get_permalink($bookid);
    ob_start(); 

        include ( 'content-buy-book-block.php');

    ob_get_clean();
    return $output; 
   
} 

// used on Character term archive to determine primary vs secondary 
function charactercheck($array, $key, $val) {
    foreach ($array as $item)
        // accessing data in array as object since that's how its http;
        // stored://stackoverflow.com/questions/18535885/why-does-my-php-array-give-me-cannot-use-object-of-type-stdclass-as-array
        if (isset($item->$key) && $item->$key == $val) {
            return true;
        }
    return false;
}

// Add Toolbar Menus
function custom_toolbar() {
    global $wp_admin_bar;

    $args = array(
        'id'     => 'books',
        'title'  => '<span class="ab-icon"></span><span class="ab-label">Books</span>',
        'href'   => '/wp-admin/edit.php?post_type=book',
        'group'  => false,
    );
    $wp_admin_bar->add_menu( $args );

    $args = array(
        'id'     => 'series',
        'parent' => 'books',
        'title'  => 'Series',
        'href'   => '/wp-admin/edit-tags.php?taxonomy=series&post_type=book',
        'group'  => false,
    );
    $wp_admin_bar->add_menu( $args );

    $args = array(
        'id'     => 'genre',
        'parent' => 'books',
        'title'  => 'Genres',
        'href'   => '/wp-admin/edit-tags.php?taxonomy=genre&post_type=book',
        'group'  => false,
    );
    $wp_admin_bar->add_menu( $args );

    $args = array(
        'id'     => 'format',
        'parent' => 'books',
        'title'  => 'Formats',
        'href'   => '/wp-admin/edit-tags.php?taxonomy=format&post_type=book',
        'group'  => false,
    );
    $wp_admin_bar->add_menu( $args );

    $args = array(
        'id'     => 'pub_country',
        'parent' => 'books',
        'title'  => 'Publication Countries',
        'href'   => '/wp-admin/edit-tags.php?taxonomy=pub_country&post_type=book',
        'group'  => false,
    );
    $wp_admin_bar->add_menu( $args );

    $args = array(
        'id'     => 'character',
        'parent' => 'books',
        'title'  => 'Characters',
        'href'   => '/wp-admin/edit-tags.php?taxonomy=character&post_type=book',
        'group'  => false,
    );
    $wp_admin_bar->add_menu( $args );

}

// Hook into the 'wp_before_admin_bar_render' action
add_action( 'wp_before_admin_bar_render', 'custom_toolbar', 999 );

// INSERT SOMETHING AFTER X CHARACTERS (AT END OF PARAGRAPH)
// USAGE: echo prefix_insert_covers($excerpt, $cover, 3000)
function prefix_insert_covers( $content, $cover, $frequency="1000" ) {
    if ( !is_admin() ) {
        return prefix_insert_after_paragraph( $cover, $frequency, $content );
    }
    return $content;
}

// Parent Function that makes the prefix_insert_covers() magic happen
function prefix_insert_after_paragraph( $insertion, $frequency, $content ) {
    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );
    $charactercount = 0;
    $num = count($paragraphs);

    foreach ($paragraphs as $index => $paragraph) {
        if ( trim( $paragraph ) ) {
            $charactercount += strlen($paragraph);
            $paragraphs[$index] .= $closing_p;

            // if the characters are greater than the frequency and number of paragraphs is less than the count by 2
            // ie, right after we hit the frequency / character count but not if it's the last paragraph, spit out the insertion
            // we're using index+2 because there are two extra paragraphs at the end of this content for some reason
            if ( ($charactercount > $frequency) && ($index+2 < $num) ) {
                $paragraphs[$index] .= $insertion;
                $charactercount = 0;
            }  
        }
        // show number of paragraphs for diagnostic purposes
       // $paragraphs[$index] .= '<!-- hello' . $index . '-->';
    }
    
    return implode( '', $paragraphs );
}