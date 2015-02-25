<?php
/*
Author: Michelle McGinnis
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
//require_once( 'library/custom-post-type.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'cover-small', 100 );
add_image_size( 'cover-medium', 250 );
add_image_size( 'cover-large', 600 );
add_image_size( 'widescreen', 1170, 500, true );
add_image_size( 'pagewidth', 780, 333, true );
add_image_size( 'tiny-thumb', 150, 0 );
add_image_size( 'footer-thumb', 162, 0 );
add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'cover-small' => __('Tiny Cover (100px wide)'),
        'tiny-thumb' => __('Tiny Thumb (150px wide)'),
        'cover-medium' => __('Small Cover (250px wide)'),
        'cover-large' => __('Large Cover (600px wide)'),
        'widescreen' => __('Widescreen (1170px x 500px)'),
        'pagewidth' => __('Full Page (780px x 333px)'),
        //'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

  register_sidebar(array(
    'id' => 'header1',
    'name' => __( 'Header Widgets', 'bonestheme' ),
    'description' => __( 'The header widgets.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer1',
    'name' => __( 'Footer Widgets', 'bonestheme' ),
    'description' => __( 'The footer widgets.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer2',
    'name' => __( 'Footer Slider', 'bonestheme' ),
    'description' => __( 'The footer slider.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/************** ADD FILE TYPES TO MEDIA LIBRARY FILTERS ****************/
add_filter( 'post_mime_types', 'custom_mime_types' );
function custom_mime_types( $post_mime_types ) {
        $post_mime_types['application/msword'] = array( __( 'Word Docs' ), __( 'Manage Word Docs' ), _n_noop( 'Word Docs <span class="count">(%s)</span>', 'Word Docs <span class="count">(%s)</span>' ) );
        $post_mime_types['application/vnd.ms-excel'] = array( __( 'Excel Files' ), __( 'Manage Excel Files' ), _n_noop( 'Excel Files <span class="count">(%s)</span>', 'Excel Files <span class="count">(%s)</span>' ) );
        $post_mime_types['application/vnd.ms-powerpoint'] = array( __( 'PowerPoint Files' ), __( 'Manage PowerPoint Files' ), _n_noop( 'PowerPoint Files <span class="count">(%s)</span>', 'PowerPoint Files <span class="count">(%s)</span>' ) );
        $post_mime_types['application/pdf'] = array( __( 'PDFs' ), __( 'Manage PDFs' ), _n_noop( 'PDFs <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );
        $post_mime_types['application/zip'] = array( __( 'ZIPs' ), __( 'Manage ZIPs' ), _n_noop( 'ZIP <span class="count">(%s)</span>', 'ZIPs <span class="count">(%s)</span>' ) );
        
        return $post_mime_types;
}

/************ RESPONSIVE VIDEO ******************/
// remove dimensions from oEmbed videos
add_filter( 'embed_oembed_html', 'tdd_oembed_filter', 10, 4 ) ; 
function tdd_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<figure class="video-container">'.$html.'</figure>';
    return $return;
}

/**************** SHORTCODES ***************/

// ENABLE SHORTCODES IN ALL TEXT WIDGETS
add_filter('widget_text', 'do_shortcode');

/************* ACF ****************/
if( function_exists('acf_add_options_sub_page') )
{
    acf_add_options_sub_page(array(
        'title' => 'Copyright & Address',
        'parent' => 'options-general.php',
        'capability' => 'manage_options'
    ));
}

/**** MENU SOCIAL ICONS ****/
add_filter( 'storm_social_icons_use_latest', '__return_true' );
add_filter( 'storm_social_icons_networks', 'storm_social_icons_networks');
function storm_social_icons_networks( $networks ) {

    $extra_icons = array (
        '/feed' => array(                  // Enable this icon for any URL containing this text
            'name' => 'RSS',               // Default menu item label
            'class' => 'rss',              // Custom class
            'icon' => 'icon-rss',          // FontAwesome class
            'icon-sign' => 'icon-rss-sign' // May not be available. Check FontAwesome.
        ),
    );

    $extra_icons = array_merge( $networks, $extra_icons );
    return $extra_icons;

}

// put WP-SEO panel at bottom of edit screens (low priority)
add_filter('wpseo_metabox_prio' , 'my_wpseo_metabox_prio' );
function my_wpseo_metabox_prio() {
  return 'low' ;                                
}
// FILTER WORDPRESS SEO BY YOAST outputs in the WordPress control panel
// remove WP-SEO columns from edit-list pages in admin
add_filter( 'wpseo_use_page_analysis', '__return_false' );


function stripthis($isbn) {
  $stripped_isbn = preg_replace("[^A-Za-z0-9]", "", $isbn);  
  return $stripped_isbn;
}